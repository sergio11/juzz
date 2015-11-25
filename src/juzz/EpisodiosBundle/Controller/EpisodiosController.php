<?php

namespace juzz\EpisodiosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EpisodiosController extends Controller
{
    
    /**
     * Muestra la página con todos los episodios de un programa
     *
     * @param string $channel El slug del canal
     * @param string $program El slug del programa
     */
    public function indexAction($channel,$program)
    {
        return $this->render('juzzEpisodiosBundle:Default:index.html.twig', array('name' => $name));
    }
    
    /**
     * Muestra la página con todos los episodios pertenecientes a una categoría.
     *
     * @param string $category El slug de la categoría
     */
    public function categoriasAction($category) {
        
    }
    
    /**
     * Muestra la página con todos los episodios pertenecientes a un tag.
     *
     * @param string $tag El slug de la etiqueta
     */
    public function tagsAction($tag) {
        
    }
    
     
    /**
     * Muestra la página con todos los episodios pertenecientes a un género.
     *
     * @param string $genero El slug del género
     */
    public function generosAction($genero) {
        
    }
    
    /**
     * Muestra los comentarios de un episodio
     *
     * @param string $channel El slug del canal
     * @param string $program El slug del programa
     * @param int $episode identificador del episodio
     */
    public function comentariosAction($channel,$program,$episode) {

    }


    /**
    * Mustra los últimos episodios subidos por un usuario
    *
    */

    public function lastUploadedEpisodesAction($idUser){

        $episodes = array(
            array(
                'name' => 'MeriPodcast 9x11: Bloodborn & Especial',
                'podcast' => 'Meripodcast',
                'duration' => '01:32:22'
            ),
            array(
                'name' => 'MeriPodcast 9x10: Star Wars Battlefront y Starcraft 2, Legacy of the Void',
                'podcast' => 'Meripodcast',
                'duration' => '01:24:59'
            ),
            array(
                'name' => 'MeriPodcast 9x09: Fallout 4, Rise of the Tomb Raider y Blizzcon 2015',
                'podcast' => 'Meripodcast',
                'duration' => '01:47:43'
            )
        );

    
        return $this->render("juzzEpisodiosBundle:Default:last_uploaded_episodes.html.twig",array(
            'episodes' => $episodes
        ));
    }
}
