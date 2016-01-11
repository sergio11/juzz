import React from 'react'
import Routing from 'routing'
import Post from '../posts'
import UserPost from '../userpost'
import $ from 'jquery'
import * as constants from '../constants.js';

class Wall extends React.Component {

    /*For ES6 classes, getInitialState has been deprecated in favor 
    of declaring an initial state object in the constructor*/
    constructor(props, context) {
        super(props, context);

        this.state = {
            load:false,
            posts: []
        };

    };

    componentDidMount() {

        //generate url
        let url = Routing.generate('comments',{target:this.props.target});
        //Obtenemos los Posts.
        $.getJSON(url).done((response) => {
            if(response.success){
                console.log("POST");
                console.log(response.data);
                this.setState({ posts : response.data });
            }
        }).fail((response) => {
            console.log("Fail!!!");
            console.log(response);
        })
        .always(() => {
            this.setState({ load : true });
        });
    }

    //Borrar Post
    deletePost(post) {
        //Obtenemos índice del post.
        let index = this.state.posts.indexOf(post);
        //Eliminamos el post.
        this.state.posts.splice(index,1);
        //Forzamos actualización de la vista.
        this.forceUpdate();
    }

    //Crear Post
    createPost(e) {

        if(e.charCode == 13) {
            let val = e.target.value;
            if(val && val != "") {
                
                $.post(Routing.generate('post_comment'),{
                    data:{
                        content:val,
                        target:this.props.target,
                        parent:null,
                        owner:this.props.user.id,
                    }
                }).done((response) => {
                    response = JSON.parse(response);
                    if(response.success){
                        this.state.posts.unshift(response.data);
                        this.forceUpdate();
                    }
                    
                }).fail((response) => {
                    console.log("Fail!!!");
                    console.log(response);
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
        if(!this.state.load){
            content = <div className='alert alert-info'>Cargándo</div>
        }else if(this.state.load && !this.state.posts.length){
            content = <div className='alert alert-info'>No hay comentarios, sé el primero.</div>
        }else{
            content = this.state.posts.map((post) => {
                let deletePost = this.deletePost.bind(this, post);
                return <Post key={post.id} data={post} user={this.props.user} onDelete={deletePost}/>
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

export default Wall
