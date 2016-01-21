import { Store } from 'flux/utils';
import ActionTypes from '../actions/action_types';
import Dispatcher from '../../../../../../../app/Resources/public/js/appDispatcher';

class NotificationStore extends Store {

	constructor(Dispatcher) {
		super(Dispatcher);
	    // This is the transient state.
	    this.state = {
        	enable:false,
            pendings:[]
        };
	}

	__onDispatch(action) {
		switch(action.type){
			case ActionTypes.NOTIFICATIONS_RECEIVED:
				this._onNotificationsReceived(action.notifications);
			break;
		}
	}

	_onNotificationsReceived(notifications){
		let pendings = this.state.pendings.concat(notifications);
		this.state.pendings = pendings;
        this.__emitChange();
	}

	
	getState() {
		return this.state;
	}

}

export default new NotificationStore(Dispatcher);