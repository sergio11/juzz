import ActionTypes from './action_types';
import Dispatcher from '../../../../../../../app/Resources/public/js/appDispatcher';
import api from '../../../../../../../app/Resources/public/js/lib/api';

export function getUsers(){
	api.getPosts(target)   
	.done(posts => {     
		Dispatcher.dispatch({       
			type: ActionTypes.POSTS_OBTAINED,       
			posts    
		});   
	})   
	.fail(err => {  
		console.log("Error!!!"); 
	}); 
}
