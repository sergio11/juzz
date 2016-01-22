import React from 'react'
import Post from '../posts'
import UserPost from '../userpost'
import $ from 'jquery'
import * as constants from '../../constants.js';
import { connectToStores } from '../../../../../../../../app/Resources/public/js/connectToStores';
import WallStore from '../../stores/wallStore';
import {getPosts,deletePost,createPost} from '../../actions/action_creators';

class Wall extends React.Component {

    static getStores() {
        return [WallStore];
    }

    static getState() {
        return WallStore.getState();
    }

    /*For ES6 classes, getInitialState has been deprecated in favor 
    of declaring an initial state object in the constructor*/
    constructor(props, context) {
        super(props, context);
        this.props = props;
    };


    componentDidMount() {
        //Obtenemos todos los posts para el target especificado.
        getPosts(this.props.target)
    }

    //Borrar Post
    deletePost(post) {
        //Eliminamos el Post Especificado.
        deletePost(post);
    }

    //Crear Post
    createPost(e) {
        if(e.charCode == 13) {
            let val = e.target.value;
            if(val && val != "") {
                //Creamos el posts
                createPost({
                    content:val,
                    target:this.props.target,
                    parent:null,
                    owner:this.props.user.id,
                });
                e.target.value = "";
                e.preventDefault();
            }
        }
    }

    renderHeader(){

        let header;
        if (this.props.policy.id == constants.NO_COMMENTS_ALLOWED) {
            header = <div className='alert alert-danger'>El usuario no permite comentarios</div>
        }else{
            header = <UserPost user={this.props.user} onSave={this.createPost.bind(this)}/>
        }

        return header;

    }

    renderContent(){

        let content;
        if(!this.props.load){
            content = <div className='alert alert-info'>Cargándo</div>
        }else if(this.props.load && !this.props.posts.length && this.props.policy.id != constants.NO_COMMENTS_ALLOWED){
            content = <div className='alert alert-info'>No hay comentarios, sé el primero.</div>
        }else{
            content = this.props.posts.map((post) => {
                let deletePost = this.deletePost.bind(this, post);
                return <Post key={post.id} data={post} user={this.props.user} policy={this.props.policy} onDelete={deletePost}/>
            })
        }

        return content;
    }

    render() {

        return (
            <div className='container-fluid'>
                <div className='row v-padding'> 
                    {this.renderHeader()}
                </div>
                <ul className="list-group list-group-root">
                    {this.renderContent()}
                </ul>
            </div>
        )

    }


}


export default connectToStores(Wall);
