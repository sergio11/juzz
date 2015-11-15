<?php

namespace juzz\ProgramasBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use juzz\CanalesBundle\Entity\Canales AS CanalEntity;
use juzz\ProgramasBundle\Entity\Programas AS ProgramEntity;
/*
    Los accesorios de Doctrine2 son clases PHP que pueden crear y persistir objetos a la base de datos.
    Al igual que todas las clases en Symfony2, los accesorios deben vivir dentro de uno de los paquetes de tu aplicación.
*/
class ProgramsFixture extends AbstractFixture implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        //Programas de Prueba
        $programs = array(
          array(
            "nombre" => "Meripodcast",
            "descripcion" => "Meripodcast, el podcast de Meristation.",
            "creacion" => new \DateTime(),
            "canal_id" => 2
          )
        );

        foreach ($programs as $program) {
            $programEntity = new ProgramEntity();
            $programEntity->setNombre($program['nombre']);
            $programEntity->setDescripcion($program['descripcion']);
            $programEntity->setCreacion($program['creacion']);
            $repository = $manager->getRepository('juzzCanalesBundle:Canales');
          	$channel = $repository->findOneBy(array('id' => $program["canal_id"]));
            $programEntity->setCanal($channel);
            $manager->persist($programEntity);
        }


        $manager->flush();


    }
}
