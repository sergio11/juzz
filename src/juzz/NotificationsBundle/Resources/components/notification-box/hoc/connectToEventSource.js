import React from "react";
import Routing from 'routing';
import {notificationsReceived} from '../actions/action_creators';

export var connectToEventSource = Component => class extends React.Component {
    
    constructor(props) {
        super(props);
        this.props = props;
        this.stream = null;
    }

    _openStream() {
        //Creamos EventSource para el target especificado.
        this.stream = new EventSource(Routing.generate('push_notifications', { 'user': this.props.target }));

        this.stream.addEventListener('message', (event) => {
            let data = JSON.parse(event.data);
            if (data.success && data.notifications.length) {
                notificationsReceived(data.notifications);
            }
        });

        this.stream.addEventListener('error', (event) => {
            console.log(event);
        });
    }


    _closeStream() {
        if (this.stream) {
            this.stream.close();
            this.stream = null;
        }
    }

    componentDidMount() {
        this.props.enabled && this._openStream();
    };

    componentWillUnmount() {
        this._closeStream();
    }

    componentWillReceiveProps(nextProps) {
        if(this.props.enabled != nextProps.enabled)
            nextProps.enabled  ?  this._openStream() : this._closeStream();
    };

    render() {
        let componentFactory = React.createFactory(Component);
        return componentFactory(this.props);
    }
};
