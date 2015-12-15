import React from 'react'
import ReactDOM from 'react-dom'
import Wall from './wall'

var container = document.getElementById('comment_wall_container');
var user = container.dataset['user'] && JSON.parse(container.dataset['user']);

ReactDOM.render(
    <Wall user={user}/>,
    document.getElementById('comments-point-mount')
);