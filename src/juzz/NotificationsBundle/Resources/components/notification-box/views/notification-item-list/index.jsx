import React from 'react'

class NotificationItemList extends React.Component{
    
    
    _renderNotificationImg(){
        return (
             <a href="#">
               <img className="media-object img-circle" width='60px' src={this.props.img} alt="" />
             </a>
        )
    }
    
    _renderNotificationTitle(){
        return <h4 className="media-heading">{this.props.title}</h4>
    }
    
    _renderNotificationContent(){
        return (
            <div>
                <p>{this.props.content}</p>
                <a className="btn btn-embossed btn-primary pull-right" href="#" role="button">ok</a>
            </div>
        )
    }

    render(){

        return (

            <li className="list-group-item">
                <div className="media">
                <div className="media-left media-middle">
                   {this._renderNotificationImg()}
                </div>
                <div className="media-body">
                    {this._renderNotificationTitle()}
                    {this._renderNotificationContent()}
                </div>
                </div>
            </li>

        );

    }

}

export default NotificationItemList;
