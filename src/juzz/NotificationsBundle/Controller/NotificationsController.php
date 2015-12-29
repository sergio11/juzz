<?php

namespace juzz\NotificationsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\StreamedResponse;

class NotificationsController extends Controller
{
    
    public function pushNotificationAction() {

		$response = new StreamedResponse(function() {
			
			$data = array("name" => "Evento de Prueba");

			while (true) {

		        echo 'data: ' . json_encode($data) . "\n\n";
		        ob_flush();
                flush(); 

		        //sleep for 3 seconds
		        sleep(10);
    		}

		});

	    $response->headers->set('Content-Type', 'text/event-stream');
	    return $response;
	}
}
