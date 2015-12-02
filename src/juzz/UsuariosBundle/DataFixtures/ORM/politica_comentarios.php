<?php

namespace juzz\EpisodiosBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use juzz\UsuariosBundle\Entity\PoliticaComentarios AS CommentPolicyEntity;

/*
    Los accesorios de Doctrine2 son clases PHP que pueden crear y persistir objetos a la base de datos.
    Al igual que todas las clases en Symfony2, los accesorios deben vivir dentro de uno de los paquetes de tu aplicación.
*/
class CommentsPolicyFixture extends AbstractFixture implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        //Uusarios de Prueba
        $policies = array(
            array("name" => "Permitir comentarios a todos los usuarios"),
            array("name" => "Permitir comentarios sólo a usuarios registrados"),
            array("name" => "Permitir comentarios sólo a usuarios a los que sigo"),
            array("name" => "No publicar los comentarios hasta que los revise"),
            array("name" => "No permitir comentarios")
        );

        foreach ($policies as $policy) {
            $commentPolicyEntity = new CommentPolicyEntity();
            $commentPolicyEntity->setName($policy['name']);
            $manager->persist($commentPolicyEntity);
        }

        $manager->flush();

    }
}
