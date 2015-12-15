import React from 'react'

class Comment extends React.Component {
	render() {
	    return(
	    	<div className="media">
  				<div className="media-left">
				    <a href="#">
				      <img className="media-object img-circle" width='45' src="http://graph.facebook.com/v2.2/983981571643128/picture" alt="" />
				    </a>
  				</div>
  				<div className="media-body">
    				<h4 className="media-heading">Media heading</h4>
    				<p>{this.props.data.text}</p>
  				</div>
			</div>
	    )
  	}
}

export default Comment