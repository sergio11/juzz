import ActionTypes from './action_types';
import Dispatcher from '../../../../../../../app/Resources/public/js/appDispatcher';

export function notificationsReceived(notifications){
	Dispatcher.dispatch({       
		type: ActionTypes.NOTIFICATIONS_RECEIVED,       
		notifications: notifications    
	});   
}


