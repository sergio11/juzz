import React from 'react'
import ReactDOM from 'react-dom'
import NotificationComponent from './notification-component'

var mountPoint = document.getElementById('notificacion-component-mount-point');

ReactDOM.render(
    <NotificationComponent target={mountPoint.dataset.target}/>,
    mountPoint
);