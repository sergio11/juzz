import React from 'react'
import Comment from '../comment'

class Post extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            editMode: false
        }
    }

    editHandler(e) {
        e.preventDefault();
        this.setState({
            editMode : true
        });
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
        if(e.which == 13) {
            var text = e.target.value.trim();
            if(text != "") {
                var comments = this.props.data.comments;
                var currentId = comments.length ? comments[(comments.length)-1].id : -1;
                comments.push({
                    id: currentId+1,
                    text: text
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
            content = <textarea onKeyDown={this.saveEditHandler} autofocus>{this.props.value}</textarea>;
        }else{
            content = <h4>{ this.props.data.text }</h4>;
        }

        comments = this.props.data.comments.map(function(comment){
            return <Comment data={comment} key={comment.id}/>;
        });

    
        return (
            <div className="list-group-item">
                {content}
                <a href='' onClick={this.editHandler.bind(this)}><span className='fui-new'></span></a>
                <a href='' onClick={this.props.onDelete}><span className='fui-trash'></span></a>
                <h4 className="ui horizontal header divider">
                    Comments
                </h4>
                <div className="field">
                    <textarea placeholder="Reply" className="comment" onKeyDown={this.addComment.bind(this)}></textarea>
                </div>
                {comments}
            </div>
        )
    }
}

export default Post

