<?php

namespace juzz\NotificationsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\StreamedResponse;
use juzz\NotificationsBundle\Entity\Notificaciones AS NotificationEntity;
use JMS\Serializer\EventDispatcher\EventDispatcher;
use JMS\Serializer\EventDispatcher\PreSerializeEvent;

class NotificationsController extends Controller
{
    
    public function pushNotificationAction($user) {

    	$em = $this->getDoctrine()->getManager();

		$serializer = $this->get('jms_serializer');

		$response = new StreamedResponse(function() use ($user,$em,$serializer){

			while (true) {

				try {
					//Obtenemos Notificaciones para el usuario.
					$notifications = $em->getRepository('juzzNotificationsBundle:Notificaciones')->findBy(array(
						'target' => $user
					));

					$response = [
						'success' => true,
						'notifications' => $notifications
					];

				} catch (\Exception $e) {
					$response = [
			            'success' => false,
			            'code'    => $e->getCode(),
			            'message' => $e->getMessage(),
			        ];

				} finally {
				    echo 'data: ' . $serializer->serialize($response, 'json') . "\n\n";
				    ob_flush();
		            flush(); 
				}

		        //sleep for 3 seconds
		        sleep(60);
    		}

		});

	    $response->headers->set('Content-Type', 'text/event-stream');
	    return $response;
	}
}
