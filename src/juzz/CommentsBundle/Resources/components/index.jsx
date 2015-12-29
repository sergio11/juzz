import React from 'react'
import ReactDOM from 'react-dom'
import Wall from './wall'

var container = document.getElementById('comment_wall_container');
var user = container.dataset['user'] && JSON.parse(container.dataset['user']);
var target = container.dataset['target'];

ReactDOM.render(
    <Wall user={user} target={target}/>,
    document.getElementById('comments-point-mount')
);