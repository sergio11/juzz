import React from 'react'
import ReactDOM from 'react-dom'
import Wall from './wall'

var container = document.getElementById('comment_wall_container');
var user = container.dataset['user'] && JSON.parse(container.dataset['user']);
var target = container.dataset['target'];
var policy = container.dataset['policy'] && JSON.parse(container.dataset['policy']);

ReactDOM.render(
    <Wall user={user} target={target} policy={policy}/>,
    document.getElementById('comments-point-mount')
);