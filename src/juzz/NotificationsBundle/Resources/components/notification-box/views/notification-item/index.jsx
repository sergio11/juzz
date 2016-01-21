import React from 'react'

class NotificationItem extends React.Component{

    render(){

    	return (

    		<a className='dropdown-toggle' href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span className='fa fa-bell'></span>&nbsp;
                <span className='badge badge-danger'>{this.props.count}</span>
            </a>

    	);

    }	

}

export default NotificationItem;