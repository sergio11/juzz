import { Store } from 'flux/utils';
import ActionTypes from '../actions/action_types';
import Dispatcher from '../../../../../../../app/Resources/public/js/appDispatcher';

class UserStore extends Store {

	constructor(Dispatcher) {
		super(Dispatcher);
	    // This is the transient state.
	    this.state = {
	    	loaded: false,
	    	users: []
	    }
	}

	__onDispatch(action) {
		switch(action.type){
			case ActionTypes.POSTS_OBTAINED:
				this._onGetPosts(action.posts);
			break;
			
		}
	}
    
}

export default new UserStore(Dispatcher);