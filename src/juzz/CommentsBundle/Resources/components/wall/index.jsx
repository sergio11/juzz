import React from 'react'
import Comment from '../comment'
import Post from '../posts'

class Wall extends React.Component {
    /*For ES6 classes, getInitialState has been deprecated in favor 
    of declaring an initial state object in the constructor*/
    constructor(props, context) {
        super(props, context);

        this.state = {
            posts: [{
                id: 0,
                text: "Hello World",
                comments: [{
                    id: 1,
                    text: 'plzz no'
                }]
            },{
                id: 1,
                text: "Adi learning React",
                comments: []
            },{
                id: 2,
                text: "This is awesome",
                comments: [{
                    id: 1,
                    text: "Yes. it Rocks"
                }]
            }]
        };
    };


    deletePost(post) {
        //Eliminamos post.
        console.log("Post ...");
        console.log(post);
        console.log(this);
        var index = this.state.posts.indexOf(post);
        this.state.posts.splice(index,1);
        //Forzamos actualización de la vista.
        this.forceUpdate();
    }

    createPost(e) {
        if(e.charCode == 13) {
            var val = e.target.value;
            if(val && val != "") {
                var posts = this.state.posts,
                    currentId = posts.length ? posts[(posts.length)-1].id : -1;

                this.state.posts.push({
                    id: currentId + 1,
                    text: val,
                    comments: []
                });
                e.target.value = "";
                this.forceUpdate();
                e.preventDefault();
            }
        }
    }

    render() {

        console.log("Estos son los posts ....");
        console.log(this.state.posts);
        //Posts
        var posts = this.state.posts.reverse().map(function(post) {
            console.log(this);
            return <Post key={post.id} data={post} onDelete={this.deletePost}/>;
        }.bind(this));

        return (
            <div>
                <textarea placeholder="Post Something" onKeyPress={this.createPost}></textarea>
                <ul className="list-group">
                    { posts }
                </ul>
            </div>
        )
    }


}

export default Wall
