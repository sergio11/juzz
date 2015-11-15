<?php

namespace juzz\EpisodiosBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use juzz\EpisodiosBundle\Entity\Episodios AS EpisodeEntity;

/*
    Los accesorios de Doctrine2 son clases PHP que pueden crear y persistir objetos a la base de datos.
    Al igual que todas las clases en Symfony2, los accesorios deben vivir dentro de uno de los paquetes de tu aplicación.
*/
class EpisodiosFixture extends AbstractFixture implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
      //Categorías de la Aplicación
      $episodes = array(
         array(
           'titulo' => "9X02 Fallout 4 Análisis",
           'file' => 'audio_00001',
           'descripcion' => 'Hablamos sobre Fallout 4, la última obra maestra de bethesda',
           'poster'=> 'poster_00001',
           'duracion' => new \DateTime(),

         );
      );

      foreach ($episodes as $episode) {
        $episodeEntity = new EpisodeEntity();
        $episodeEntity->setTitulo();
        $manager->persist($episodeEntity);
      }

      $manager->flush();


  }
}
