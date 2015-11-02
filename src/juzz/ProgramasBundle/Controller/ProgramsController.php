<?php

namespace juzz\ProgramasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProgramsController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('juzzProgramasBundle:Default:index.html.twig', array('name' => $name));
    }
    
    /**
     * Muestra la página de detalle del programa especificado
     *
     * @param string $channel El slug del canal al que pertenece el programa
     * @param string $program El slug del programa que quiere verse en detalle
     */
    public function showAction($channel, $program) {
        echo "<p>Viendo un programa concreto!!!!</p>";
        echo "<p>Canal :$channel </p>";
        echo "<p>Programa : $program</p>";
    }
    
    /**
     * Muestra la página para crear un nuevo programa
     *
     * @param string $channel El slug del canal al que pertenecerá el nuevo programa
     */
    public function createAction($channel) {
        
    }
    
    /**
     * Muestra la página para actualizar la información de un programa
     *
     * @param string $channel El slug del canal al que pertenece el programa
     * @param string $program El slug del programa que se quiere actualizar
     */
    public function updateAction($channel,$program) {
        
    }
    
    /**
     * Muestra la página para la eliminación de un programa
     *
     * @param string $channel El slug del canal al que pertenece el programa
     * @param string $program El slug del programa a borrar
     */
    public function deleteAction($channel,$program) {
        
    }
    
     /**
     * Muestra los subscriptores de un programa
     *
     * @param string $channel El slug del canal al que pertenece el programa
     * @param string $program El slug del programa en cuestión
     */
    
    public function subscriptoresAction($channel,$program) {
        
    }
}
