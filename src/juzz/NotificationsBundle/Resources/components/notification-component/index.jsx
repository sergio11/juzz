import React from 'react'
import Routing from 'routing'
import $ from 'jquery'
import NotificationItem from '../notification-item'
import NotificationList from '../notification-list'

class NotificationComponent extends React.Component{

	constructor(props, context) {
        super(props, context);

        this.state = {
        	enable:false,
            pendings:[]
        };
    };


    _openStream(){

    }

    _closeStream(){

    }

    componentWillMount() {

        let stream = new EventSource(Routing.generate('push_notifications',{'user' : 2}));

        stream.addEventListener('message',(event) => {
            let data = JSON.parse(event.data);
            if(data.success){
                console.log("Notificaciones recibidas ...");
                console.log(data.notifications);
                let pendings = this.state.pendings.concat(data.notifications);
                this.setState({pendings:pendings});
            }
        });

        stream.addEventListener('error',(event) => {
            console.log(event);
        });
	}

    render(){

        return (
            <div>
                <NotificationItem count={this.state.pendings.length} />
                <NotificationList notifications={this.state.pendings} enabled={this.state.enable}/>
            </div>
        )
    }


}

export default NotificationComponent;