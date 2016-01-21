import { Store } from 'flux/utils';
import ActionTypes from '../actions/action_types';
import Dispatcher from '../../../../../../../app/Resources/public/js/appDispatcher';

class WallStore extends Store {

	constructor(Dispatcher) {
		super(Dispatcher);
	    // This is the transient state.
	    this.state = {
	    	load: false,
	    	posts: []
	    }
	}

	__onDispatch(action) {
		switch(action.type){
			case ActionTypes.POSTS_OBTAINED:
				this._onGetPosts(action.posts);
			break;
			case ActionTypes.CREATE_POST:
				this._onCreatePost(action.post);
			break;
			case ActionTypes.DELETE_POST:
				this._onDeletePost(action.post);
			break;
			case ActionTypes.ASSESS_COMMENT:
				this._onAssessComment(action.comment,action.assess);
			break;
			case ActionTypes.POST_CHANGE_MODE:
				this._onChangeModePost(action.post,action.mode);
			break;
		}
	}

	_searchPost(needle,haystack){
		let result = null;
		for (var i = 0; i < haystack.length; i++) {
			if (haystack[i].id == needle){
				result = haystack[i];
				break;
			}else{
				result = haystack[i].comments && this._searchPost(needle,haystack[i].comments)
			} 
				
		};
		return result;
	}

	_onGetPosts(posts){
		this.state.posts = posts;
		this.state.load = true;
		this.__emitChange();
	}

	_onCreatePost(post){
		if(post.parent){
			let target = this._searchPost(post.parent.id,this.state.posts);
			target.comments.unshift(post);
		}else{
			this.state.posts.unshift(post);
		}
		this.__emitChange();
	}

	_onDeletePost(post){
		//Obtenemos índice del post.
		let index = this.state.posts.indexOf(post);
		//Eliminamos el post.
		this.state.posts.splice(index,1);
		this.__emitChange();
	}

	_onAssessComment(id,assess){
		let post = this._searchPost(id,this.state.posts);
		if(post){
			if (assess.replace) {
				let index = post.assess.map((item) => { return item.owner.id }).indexOf(assess.assess.owner.id)
				post.assess[index] = assess.assess;
			}else{
				post.assess.push(assess.assess);
			}
			this.__emitChange();
		}
	}

	_onChangeModePost(id,mode){
		let post = this._searchPost(id,this.state.posts);
		if (post) {
			post.mode = mode;
			this.__emitChange();
		};
		
	}

	getState() {
		return this.state;
	}

}

export default new WallStore(Dispatcher);