import React from 'react'
import Routing from 'routing'
import Comment from '../comment'
import Post from '../posts'
import $ from 'jquery'


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

    componentWillMount() {
        //generate url
        let url = Routing.generate('comments',{target:this.props.user.id});
        //Obtenemos los Posts.
        $.getJSON(url).done((response) => {
            if(response.success){
                this.setState({ posts : response.data });
            }
        }).fail((response) => {
            console.log(response);
        })
        .always(() => {
            this.setState({ load : true });
        });
    }

    //Borrar Post
    deletePost(post) {
        //Obtenemos índice del post.
        var index = this.state.posts.indexOf(post);
        //Eliminamos el post.
        this.state.posts.splice(index,1);
        //Forzamos actualización de la vista.
        this.forceUpdate();
    }

    //Crear Post
    createPost(e) {

        if(e.charCode == 13) {
            var val = e.target.value;
            if(val && val != "") {
                
                $.post(Routing.generate('post_comment'),{
                    data:{
                        contenido:val
                    }
                }).done((response) => {
                    console.log("Respuesta!!!");
                    console.log(response);
                    if(response.success){
                        //this.state.posts.push(response.post)
                    }
                    //this.forceUpdate();
                }).fail((response) => {
                    console.log("Fail!!!");
                    console.log(response);
                });

                e.target.value = "";
                
                e.preventDefault();
            }
        }
    }

    render() {

        let content;
        if(!this.state.load){
            content = <div className='alert alert-info'>Cargándo</div>
        }else if(this.state.load && !this.state.posts.length){
            content = <div className='alert alert-info'>No hay comentarios, sé el primero.</div>
        }else{
            content = this.state.posts.reverse().map((post) => {
                let deletePost = this.deletePost.bind(this, post);
                return <Post key={post.id} data={post} onDelete={deletePost}/>
            })
        }

        return (
            <div className='container'>
                <div className='row v-padding'> 
                    <div className='col-lg-12'>
                        <div className="media">
                            <div className="media-left">
                                <a href="#">
                                  <img className="media-object img-circle" width='75' src={this.props.user.avatar} alt="" />
                                </a>
                            </div>
                            <div className="media-body">
                                <h4 className="media-heading">{this.props.user.fullName}</h4>
                                <div className="form-group">
                                    <textarea className="form-control" rows="3" onKeyPress={this.createPost.bind(this)} placeholder="Post Something"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul className="list-group">
                    {content}
                </ul>
            </div>
        )

    }


}

export default Wall
