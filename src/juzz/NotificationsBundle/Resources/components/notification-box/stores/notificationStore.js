import { Store } from 'flux/utils';
import ActionTypes from '../actions/action_types';
import Dispatcher from '../../../../../../../app/Resources/public/js/appDispatcher';

class NotificationStore extends Store {

	constructor(Dispatcher) {
		super(Dispatcher);
        this.state = {};
	    // This is the transient state.
        this.state.pendings = [];
        
        if (localStorage.hasOwnProperty('enabled')) {
            this.state.enable = localStorage.getItem('enabled');
        }else{
            this.state.enable = false;
        }
        
	}

	__onDispatch(action) {
		switch(action.type){
            case ActionTypes.NOTIFICATION_RECEIVED:
                this._onNotificationsReceived(action.notifications);
            break;
            case ActionTypes.NOTIFICATIONS_TOGGLE:
                console.log("Toggle from Store ...");
                this._onToggleNotifications(action.target);
            break;
		}
	}
    
    //commands
    
	_onNotificationsReceived(notifications){
		let pendings = this.state.pendings.concat(notifications);
		this.state.pendings = pendings;
        this.__emitChange();
	}
    
    _onToggleNotifications(){
        this.state.enable = !this.state.enable;
        console.log("New Value for enable");
        console.log(this.state.enable);
        //save current state
        localStorage.setItem('enable',this.state.enable);
        this.__emitChange();
       
    }

	//queries
    
	getState() {
		return this.state;
	}

}

export default new NotificationStore(Dispatcher);