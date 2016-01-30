import React from 'react'
import ReactDOM from 'react-dom'
import UsersProfileGrid from './users-profile-grid'

var mountPoint = document.getElementById('user-list-mount-point');

ReactDOM.render(
    <UsersProfileGrid title='Seguidores' />,
    mountPoint
);