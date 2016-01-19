import React from 'react'
import {assessComment} from '../../actions/action_creators';

class LikesDisLikesBar extends React.Component {

    
    static get DISLIKE() {
      return 2;
    }
    static get LIKE() {
      return 1;
    }
    

    constructor(props) {
        super(props);
    }

    addLike(e) {
    	e.preventDefault();
        assessComment({
            user:this.props.user,
            comment:this.props.comment,
            value:LikesDisLikesBar.LIKE
        });

    }

    addDislike(e) {
    	e.preventDefault();
        assessComment({
            user:this.props.user,
            comment:this.props.comment,
            value:LikesDisLikesBar.DISLIKE
        })

    }

    render() {

        let likes = [],dislikes = [];
        console.log("assess");
        console.log(this.props.assess);

        this.props.assess.forEach((item) => {
            if(item.assess == 1) 
                likes.push(item)
            else
                dislikes.push(item)
        });
    
    	return (

    		<ul className="list-inline">
                <li>
                    <a href='#' onClick={this.addLike.bind(this)}>
                    	<span className='fa fa-thumbs-o-up'></span> 
                    	&nbsp;Me gusta <span>({likes.length})</span>
                    </a>
                </li>
                <li>
                   	<a href='#' onClick={this.addDislike.bind(this)}>
                   		<span className='fa fa-thumbs-o-down'></span> 
                   		&nbsp;No Me Gusta <span>({dislikes.length})</span>
                   	</a>
                </li>
            </ul>
    	)

    }

}


export default LikesDisLikesBar