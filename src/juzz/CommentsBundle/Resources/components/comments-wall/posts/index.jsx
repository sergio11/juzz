import React from 'react'
import UserPost from '../userpost'
import LikesDisLikesBar from '../likes_dislikes_bar'
import Routing from 'routing'
import * as constants from '../constants.js';

class Post extends React.Component {

    constructor(props) {
        super(props);
        //estado del post
        this.state = {
            answerMode: false,
            reviseMode: false,
            comments: props.data.comments
        }
    }

    saveAnswer(e) {

        if(e.which == 13) {
            this.setState({
                answerMode : false
            });
            var text = e.target.value.trim();
            if(text != "") {

                $.post(Routing.generate('post_comment'),{
                    data:{
                        content:text,
                        target:this.props.data.target,
                        parent:this.props.data.id,
                        owner:this.props.user.id,
                    }
                }).done((response) => {
                    response = JSON.parse(response);
                    if(response.success){
                        this.state.comments.unshift(response.data);
                        if(this.props.policy.id == constants.NO_POST_COMMENTS_TO_REVISE){
                            this.setState({
                                reviseMode: true
                            })
                        }else{
                            this.forceUpdate();
                        }
                        
                        
                    }
                    
                }).fail((response) => {
                    console.log("Fail!!!");
                    console.log(response);
                });
                e.target.value = "";
                e.preventDefault();
                e.stopPropagation();
            }
        }
    }

    answer(e) {

        e.preventDefault();

        this.setState({
            answerMode : true
        });
        
    }

    cancel(e){
        e.preventDefault();
        this.setState({
            answerMode : false
        });
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
        if(this.state.comments.length){
            comments = 
            <ul className="list-group">
                {this.state.comments.map((comment) => {
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
            if(this.state.answerMode) {
                content = 
                    <div className='row'>
                        <UserPost user={this.props.user} onSave={this.saveAnswer.bind(this)} placeholder={ "Contestación para " + this.props.data.owner.fullName  }/>
                        <div className='col-lg-4 col-lg-offset-8 text-right v-padding'>
                            <a href='#' className='btn btn-danger' onClick={ this.cancel.bind(this) }>Cancelar</a>
                        </div>
                    </div>
            }else if(this.state.reviseMode){
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
