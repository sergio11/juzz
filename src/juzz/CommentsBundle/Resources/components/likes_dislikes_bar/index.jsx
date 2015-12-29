import React from 'react'
import Routing from 'routing'

class LikesDisLikesBar extends React.Component {

    
static get DISLIKE() {
      return 2;
    }
    static get LIKE() {
      return 1;
    }
    

    constructor(props) {
        super(props);
        //estado del post
        this.state = {
            likes:[],
            dislikes:[]
        }
    }

    componentWillMount() {

    	let likes = [],dislikes = [];

    	this.props.assess.forEach((item) => {
    		if(item.assess == 1) 
    			likes.push(item)
    		else
    			dislikes.push(item)
    	});

    	this.setState({
    		likes:likes,
    		dislikes:dislikes
    	});

    }

    assessComment(value) {
        //generate url
        let url = Routing.generate('comment_assess',{target:this.props.comment});

        return $.post(url,{
            data:{
                user:this.props.user,
                comment:this.props.comment,
                value:value
            }
        });

    }


    addLike(e) {
    	e.preventDefault();

    	this.assessComment(LikesDisLikesBar.LIKE).done((response) => {
            response = JSON.parse(response);
            console.log(response);
            if(response.success){
                let likes = this.state.likes.slice();    
                likes.push(response.data);   
                this.setState({likes:likes});
            }
        }).fail((response) => {
            console.log("Fail!!!");
            console.log(response);
        });

    }

    addDislike(e) {
    	e.preventDefault();

        this.assessComment(LikesDisLikesBar.DISLIKE).done((response) => {
            response = JSON.parse(response);
            console.log(response);
            if(response.success){
                let dislikes = this.state.dislikes.slice();    
                dislikes.push(response.data);   
                this.setState({dislikes:dislikes});
            }
        }).fail((response) => {
            console.log("Fail!!!");
            console.log(response);
        });

    }

    render() {

    
    	return (

    		<ul className="list-inline">
                <li>
                    <a href='#' onClick={this.addLike.bind(this)}>
                    	<span className='glyphicon glyphicon-thumbs-up'></span> 
                    	&nbsp;Me gusta <span>({this.state.likes.length})</span>
                    </a>
                </li>
                <li>
                   	<a href='#' onClick={this.addDislike.bind(this)}>
                   		<span className='glyphicon glyphicon-thumbs-down'></span> 
                   		&nbsp;No Me Gusta <span>({this.state.dislikes.length})</span>
                   	</a>
                </li>
            </ul>
    	)

    }

}


export default LikesDisLikesBar