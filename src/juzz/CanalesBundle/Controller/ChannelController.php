<?php

namespace juzz\CanalesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ChannelController extends Controller {
    
    public function indexAction() {
        return $this->render('juzzCanalesBundle:Default:index.html.twig', array('name' => "Hello"));
    }
    
    /**
     * Muestra la página del canal.
     * @param string $channel El slug del canal a mostrar
     */
    public function showAction($channel) {
        
    }
    /**
     * Muestra la página para crear un nuevo canal.
     */
    public function createAction() {
        
    }
    /**
     * Muestra la página para actualizar un canal.
     * @param string $channel El slug del canal a actualizar
     */
    public function updateAction($channel) {
        
    }
    /**
     * Muestra la página para borrar un canal.
     * @param string $channel El slug del canal a borrar
     */
    public function deleteAction($channel) {
        
    }

}
