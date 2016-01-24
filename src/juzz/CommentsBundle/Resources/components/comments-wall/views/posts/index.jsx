import React from 'react'
import UserPost from '../userpost'
import LikesDisLikesBar from '../likes_dislikes_bar'
import Routing from 'routing'
import * as constants from '../../constants.js';
import {createPost,changePostMode} from '../../actions/action_creators';

class Post extends React.Component {

    constructor(props) {
        super(props);
    }
    
    saveAnswer(e) {

        if(e.which == 13) {
            var text = e.target.value.trim();
            if(text != "") {
                //Cambiamos el modo del post.
                changePostMode(this.props.data.id,'normal');
                //Creamos Post.
                createPost({
                    content:text,
                    target:this.props.data.target,
                    parent:this.props.data.id,
                    owner:this.props.user.id
                });
                
                e.target.value = "";
                e.preventDefault();
                e.stopPropagation();
            }
        }
    }

    answer(e) {
        e.preventDefault();
        console.log("Sus props");
        console.log(this.props);
        //Cambiamos el modo del post.
        changePostMode(this.props.data.id,'answer');
    }

    cancel(e){
        e.preventDefault();
        //Cambiamos el modo del post.
        changePostMode(this.props.data.id,'normal');
    }

    // Render Assess Bar
    renderAssessBar() {
        let assessbar = null;
        //Si no es el propietario del post, puede valorarlo.
        if(this.props.data.owner.id != this.props.user.id)
            assessbar = <LikesDisLikesBar user={this.props.user.id} comment={this.props.data.id} assess={this.props.data.assess}/>
        return assessbar;
    }
    // Render Comments List
    renderCommentsList() {
        let comments = null;
        //Cargamos listado de comentarios 
        if(this.props.data.comments.length){
            comments = 
            <ul className="list-group">
                {this.props.data.comments.map((comment) => {
                    return <Post key={comment.id} data={comment} user={this.props.user}/>
                })}
            </ul>
        }
        return comments;
    }
    // Render Answer Block.
    renderAnswerBlock() {
        let content;
        //Si no es el propietario del comentario.
        if(this.props.data.owner.id != this.props.user.id){
            //Comprobamos si el modo respuesta está activado.
            if(this.props.data.mode == 'answer') {
                content = 
                    <div className='row'>
                        <UserPost user={this.props.user} onSave={this.saveAnswer.bind(this)} placeholder={ "Contestación para " + this.props.data.owner.fullName  }/>
                        <div className='col-lg-4 col-lg-offset-8 text-right v-padding'>
                            <a href='#' className='btn btn-danger' onClick={ this.cancel.bind(this) }>Cancelar</a>
                        </div>
                    </div>
            }else if(this.props.data.mode == 'revision'){
                content = 
                    <div className='row'>
                        <div className='alert alert-warning'><span className='fa fa-exclamation-triangle'></span>El comentario debe ser revisado, cuando sea publicado recibirás una notificación</div>
                    </div>
            }else{
                content =
                    <div className='row'>
                        <div className='col-lg-4 col-lg-offset-8 text-right v-padding'>
                            <a href='#' className="btn btn-primary" onClick={ this.answer.bind(this) }>Responder</a>
                        </div>
                    </div>
            }

        }
        return content;
    }

    

    render() {

        return (
            <li className="list-group-item">
                <div className="media">
                    <div className="media-left">
                        <a href={ Routing.generate('perfil',{'user': this.props.data.owner.nick }) }>
                          <img className="media-object img-circle" width='70' src={this.props.data.owner.avatar.data} alt="" />
                        </a>
                    </div>
                    <div className="media-body">
                        <ul className="list-inline">
                            <li>
                                <h4 className="media-heading"><a href={ Routing.generate('perfil',{'user': this.props.data.owner.nick }) }>{this.props.data.owner.fullName}</a></h4>
                            </li>
                            <li>
                                { new Date(this.props.data.datetime).toLocaleString() }
                            </li>
                        </ul>
                        {this.renderAssessBar()}
                        <p>{ this.props.data.text }</p>
                        
                    </div>
                </div>
                {this.renderCommentsList()}
                { this.renderAnswerBlock() }
                
            </li>
        )
    }
}

export default Post

