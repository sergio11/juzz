import React from 'react'
import Comment from '../comment'

class Post extends React.Component {

    getInitialState(){
        return {
            editMode: false
        };
    }

    editHandler() {
        this.setState({
            editMode : true
        });
    }

    deleteHandler(e) {
        this.props.onDelete(this.props.data);
    }

    saveEditHandler(e) {
        var elemVal = e.target.value;
        if(e.which == 13 && elemVal.trim() != "") {
            this.props.data.text = elemVal;
            this.setState({
                editMode : false
            });
            e.stopPropagation();
        } else if(e.which == 27) {
            this.setState({
                editMode : false
            });
            e.target.value = "";
            e.stopPropagation();
        }
    }

    addComment(e) {
        var elemVal,
            curId,
            comments = this.props.data.comments;
        if(e.which == 13) {
            elemVal = e.target.value;
            if(elemVal.trim() != "") {
                curId = comments.length ? comments[(comments.length)-1].id : -1;
                comments.push({
                    id: curId+1,
                    text: elemVal
                });
                e.target.value = "";
                this.forceUpdate();
                e.preventDefault();
                e.stopPropagation();
            }
        }
    }

    render() {

        var comments,content;

        if(this.state.editMode) {
            content = <textarea onKeyDown={this.saveEditHandler} autofocus>{this.props.data.text}</textarea>;
        }else{
            content = <h3>{ this.props.data.text }</h3>;
        }

        comments = this.props.data.comments.map(function(comment){
            return <Comment data={comment} key={comment.id}/>;
        });

    
        return (
            <div className="ui raised segment">
                {content}
                <div className="ui button right floated" onClick={this.editHandler}>Edit</div>
                <div className="ui red button right floated" onClick={this.deleteHandler}>Delete</div>
                <h4 className="ui horizontal header divider">
                    Comments
                </h4>
                <div className="field">
                    <textarea placeholder="Reply" className="comment" onKeyDown={this.addComment}></textarea>
                </div>
                {comments}
            </div>
        );
    }
}

export default Post

