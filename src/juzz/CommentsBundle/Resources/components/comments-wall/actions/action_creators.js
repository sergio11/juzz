import ActionTypes from './action_types';
import Dispatcher from '../../../../../../../app/Resources/public/js/appDispatcher';
import api from '../../../../../../../app/Resources/public/js/lib/api';

export function getPosts(target){
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

export function deletePost(post){
	Dispatcher.dispatch({
		type: ActionTypes.DELETE_POST,
		post:post
	});
}

export function createPost(data){
	api.createPost(data).done(post => {
		Dispatcher.dispatch({       
			type: ActionTypes.CREATE_POST,       
			post:post    
		});
	}).fail(err => {
		console.log("Error!!!");
	})
}

export function assessComment(data){
	api.assessComment(data).done(assess => {
        Dispatcher.dispatch({
        	type: ActionTypes.ASSESS_COMMENT,
        	assess: assess,
        	comment: data.comment

        });
	});
}

export function changePostMode(post,mode){
	Dispatcher.dispatch({
		type: ActionTypes.POST_CHANGE_MODE,
		post: post,
		mode: mode
	});
}
