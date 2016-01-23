import ActionTypes from './action_types';
import Dispatcher from '../../../../../../../app/Resources/public/js/appDispatcher';


export function notificationsReceived(notifications){
    Dispatcher.dispatch({
        type: ActionTypes.NOTIFICATION_RECEIVED,
        notifications: notifications
    })
}

export function toggleNotifications(){
	Dispatcher.dispatch({       
		type: ActionTypes.NOTIFICATIONS_TOGGLE
	});   
}


