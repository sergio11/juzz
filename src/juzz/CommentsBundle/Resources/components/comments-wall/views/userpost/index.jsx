import React from 'react'
import Routing from 'routing'

class UserPost extends React.Component {
	render() {
	    return(
	    	<div className='col-lg-12'>
                <div className="media">
                    <div className="media-left">
                        <a href={ Routing.generate('perfil',{'user': this.props.user.nick }) }>
                            <img className="media-object img-circle" width='75' src={this.props.user.avatar.data} alt="" />
                        </a>
                    </div>
                    <div className="media-body">
                        <h4 className="media-heading">
                        	<a href={ Routing.generate('perfil',{'user': this.props.user.nick }) }>
                        		{this.props.user.fullName}
                        	</a>
                        </h4>
                        <div className="form-group">
                            <textarea className="form-control" rows="3" onKeyPress={this.props.onSave} placeholder={ this.props.placeholder ? this.props.placeholder : 'Post Something'}></textarea>
                        </div>
                    </div>
                </div>
            </div>
	    )
  	}
}

export default UserPost