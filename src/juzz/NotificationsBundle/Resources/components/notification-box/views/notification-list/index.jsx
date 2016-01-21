import React from 'react'
import Routing from 'routing'
import $ from 'jquery'
import NotificationItemList from '../notification-item-list';

class NotificationList extends React.Component{

	constructor(props, context) {
        super(props, context);
    };

    componentDidMount() {
    	let toggle = this.refs.switch02;
    	$(toggle).bootstrapSwitch();
    }

    render(){

    	return (

    		<div className="dropdown-menu text-capitalize notification-box" data-placement="left" role='menu'>
            	<div className="dropdown-header">
            		<span>Notificaciones</span>
            		<a className="btn btn-embossed btn-primary btn-xs pull-right" href="#" role="button">Borrar Todas</a>
            	</div>
            	
	            <ul className="list-group">
	                {
	                	this.props.notifications.map((notification) => {
	                		return <NotificationItemList key={notification.id} data={notification} />
	                	})

	                }
	            </ul>
	            <div className="row">
	                <div className="col-lg-7">
	                    <span>Aviso Notificaciones</span>
	                </div>
	                <div className="col-lg-3">
	                    <div className="bootstrap-switch-square ">
	                  
	                        <input type="checkbox" defaultChecked={this.props.enabled} data-toggle="switch" name="square-switch" ref="switch02" />
	                    
	                    </div>
	                </div>
	            </div>
        	</div>
    	)
    	
    }	

   
}

export default NotificationList;