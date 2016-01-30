import React from 'react';
import Waypoint from 'react-waypoint';
import Loader from 'react-loader';
import { connectToStores } from '../../../../../../../../app/Resources/public/js/connectToStores';

@connectToStores
class UsersProfileGrid extends React.Component{
    
    static getStores() {
        return [UserStore];
    }

    static getState() {
        return UserStore.getState();
    }
    
    
    constructor(props){
        super(props);
    }
    
    _onLoadUsers(){
        
    }
    
    renderWaypoint(){
        return (
            <Waypoint
                onEnter={this._onLoadUsers}
            />
        )
    }
   
    
    render(){
        return (
            <div className="panel panel-primary">
               <div className="panel-heading">{this.props.title}</div>
               <div className="panel-body fixed-panel">
                  <Loader loaded={this.props.loaded}>
                      {this.renderWaypoint()}
                  </Loader>
               </div>
            </div>
        );
    }
    
}

export default UsersProfileGrid;