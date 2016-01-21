import React from 'react'
import Routing from 'routing'
import $ from 'jquery'
import NotificationItem from '../notification-item'
import NotificationList from '../notification-list'
import { connectToStores } from '../../../../../../../../app/Resources/public/js/connectToStores';
import NotificationStore from '../../stores/notificationStore';
import {notificationsReceived} from '../../actions/action_creators';

class NotificationComponent extends React.Component{

    static getStores() {
        return [NotificationStore];
    }

    static getState() {
        return NotificationStore.getState();
    }

	constructor(props, context) {
        super(props, context);
        console.log("props recibidad :");
        console.log(props);    
    };

    _openStream(){}

    _closeStream(){}

    componentWillMount() {
        console.log("target : " + this.props.target);
        let stream = new EventSource(Routing.generate('push_notifications',{'user' : this.props.target}));

        stream.addEventListener('message',(event) => {
            let data = JSON.parse(event.data);
            console.log("Data Recibida");
            console.log(data);
            if(data.success){
                notificationsReceived(data.notifications);                
            }
        });

        stream.addEventListener('error',(event) => {
            console.log(event);
        });
	}

    render(){

        return (
            <div>
                <NotificationItem count={this.props.pendings.length} />
                <NotificationList notifications={this.props.pendings} enabled={this.props.enable}/>
            </div>
        )
    }


}

export default connectToStores(NotificationComponent);
