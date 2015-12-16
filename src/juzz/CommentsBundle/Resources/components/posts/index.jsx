import React from 'react'
import Comment from '../comment'
import Routing from 'routing'

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

    answer(e) {
        if(e.which == 13) {
            var text = e.target.value.trim();
            if(text != "") {

                $.post(Routing.generate('post_comment'),{
                    data:{
                        content:text,
                        target:this.props.data.target,
                        parent:this.props.data.id,
                        owner:this.props.user,
                    }
                }).done((response) => {
                    response = JSON.parse(response);
                    if(response.success){
                        this.state.comments.push(response.data);
                        this.forceUpdate();
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

    render() {

        var comments,content;

        if(this.state.editMode) {
            content = <textarea onKeyDown={this.saveEditHandler} autofocus>{this.props.value}</textarea>;
        }else{
            content = <p>{ this.props.data.text }</p>;
        }

        comments = this.props.data.comments.map(function(comment){
            return <Post key={comment.id} data={comment} user={this.props.user}/>
        });
    
        return (
            <div className="list-group-item">
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
                            <li>
                                <a href='' onClick={this.editHandler.bind(this)}><span className='fui-new'></span></a>
                            </li>
                            <li>
                                <a href='' onClick={this.props.onDelete}><span className='fui-trash'></span></a>
                            </li>
                        </ul>
                        {content}
                    </div>
                </div>
                
                <h4 className="ui horizontal header divider">
                    Comments
                </h4>
                <div className="field">
                    <textarea placeholder="Reply" className="comment" onKeyDown={this.answer.bind(this)}></textarea>
                </div>
                {comments}
            </div>
        )
    }
}

export default Post

