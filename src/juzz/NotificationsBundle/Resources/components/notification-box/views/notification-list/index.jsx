import React from 'react'
import $ from 'jquery'
import classNames from 'classnames';
import NotificationItemList from '../notification-item-list';
import {toggleNotifications} from '../../actions/action_creators';
import { connectToEventSource } from '../../hoc/connectToEventSource';


@connectToEventSource
class NotificationList extends React.Component{

	constructor(props, context) {
        super(props, context);
    };

    componentDidMount() {
    	let toggle = this.refs.switch02;
    	$(toggle).bootstrapSwitch().parent().on("click",(e) => {
            e.stopPropagation();
            toggleNotifications();
        });
    }
    
    
    //Compone los elementos de la lista.
    _renderNotificationItems(){
        console.log("Mostrando notificaciones");
        console.log(this.props.notifications.length);
        return this.props.notifications.map((notification) => {
            console.log("Contenido de la Notificacion");
            console.log(notification);
	       return <NotificationItemList key={notification.id} img={notification.data.user.avatar.data} title='Hola' content='prueba' />
	    })

    }
    
    _renderEmptyNotifications(){
        return (
            <li role="list" className="list-group-item list-group-item-info text-left">
              <span className="fa fa-warning fa-lg"></span>&nbsp;
              <span className="list-group-item-text">No tienes notificaciones</span>
            </li>
        )
    }
    
    _renderDeleteAllButton(){
        let btnClass = classNames('btn','btn-embossed','btn-primary','btn-xs',{ disabled: !this.props.notifications.length });
        return <a className={btnClass} href="#" role="button">Borrar Todas</a>;
    }

    render(){
   
    	return (

    		<div className="dropdown-menu text-capitalize notification-box" data-placement="left" role='menu'>
            	<div className="dropdown-header">
            		<span>Notificaciones</span>
            		{this._renderDeleteAllButton()}
            	</div>
            	
	            <ul className="list-group">
	                {this.props.notifications.length ? this._renderNotificationItems() : this._renderEmptyNotifications()}
	            </ul>
	            <div className="row">
	                <div className="col-xs-7">
	                    <span>Aviso Notificaciones</span>
	                </div>
	                <div className="col-xs-3">
	                    <div className="bootstrap-switch-square " >
	                        <input type="checkbox"  defaultChecked={this.props.enabled} data-toggle="switch" name="square-switch" ref="switch02" />
	                    </div>
	                </div>
	            </div>
        	</div>
    	)
    	
    }	

   
}

export default NotificationList;