import React from 'react'

class NotificationItemList extends React.Component{

  render(){

    return (

      <li className="list-group-item">
        <div className="media">
          <div className="media-left media-middle">
            <a href="#">
              <img className="media-object img-circle" width='60px' src={this.props.data.user.avatar.data} alt="" />
            </a>
          </div>
          <div className="media-body">
            <h4 className="media-heading">{this.props.data.type}</h4>
            <p></p>
            <a className="btn btn-embossed btn-primary pull-right" href="#" role="button">ok</a>
          </div>
        </div>
      </li>

    );

  }

}

export default NotificationItemList;
