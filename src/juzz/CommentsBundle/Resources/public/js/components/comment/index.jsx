import React from 'react'

class Comment extends React.Component {
	render() {
	    return (
	      	<div className="text-center">
                {this.props.data.text}
            </div>
	    )
  	}
}

export default Comment