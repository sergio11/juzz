import React from 'react'
import NotificationItem from '../notification-item'
import NotificationList from '../notification-list'
import { connectToStores } from '../../../../../../../../app/Resources/public/js/connectToStores';
import NotificationStore from '../../stores/notificationStore';

@connectToStores
class NotificationComponent extends React.Component{

    static getStores() {
        return [NotificationStore];
    }

    static getState() {
        return NotificationStore.getState();
    }

	constructor(props, context) {
        super(props, context);
        
    };
   
    render(){

        return (
            <div>
                <NotificationItem count={this.props.pendings.length} />
                <NotificationList notifications={this.props.pendings} enabled={this.props.enable} target={this.props.target}/>
            </div>
        )
    }


}

export default NotificationComponent;
