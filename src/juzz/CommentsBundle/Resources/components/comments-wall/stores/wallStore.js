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
		}
	}

	_onGetPosts(posts){
		this.state.posts = posts;
		this.state.load = true;
		this.__emitChange();
	}

	_onCreatePost(post){
		this.state.posts.unshift(post);
		this.__emitChange();
	}

	_onDeletePost(post){
		//Obtenemos índice del post.
		let index = this.state.posts.indexOf(post);
		//Eliminamos el post.
		this.state.posts.splice(index,1);
		this.__emitChange();
	}

	_onAssessComment(comment,assess){
		console.log(assess);
		let post = this.state.posts.find((post) => {
			if (post.id == comment) return post;
		});

		if (assess.replace) {
			let index = post.assess.map((item) => { return item.owner.id }).indexOf(assess.assess.owner.id)
			post.assess[index] = assess.assess;
		}else{
			post.assess.push(assess.assess);
		}

		this.__emitChange();
	}

	getState() {
		return this.state;
	}

}

export default new WallStore(Dispatcher);