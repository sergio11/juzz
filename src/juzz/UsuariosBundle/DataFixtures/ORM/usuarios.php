<?php

namespace juzz\EpisodiosBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use juzz\UsuariosBundle\Entity\Usuarios AS UsuarioEntity;

/*
    Los accesorios de Doctrine2 son clases PHP que pueden crear y persistir objetos a la base de datos.
    Al igual que todas las clases en Symfony2, los accesorios deben vivir dentro de uno de los paquetes de tu aplicación.
*/
class Usuarios extends AbstractFixture implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        //Uusarios de Prueba
        $users = array(
            array(
              "nombre" => "Sergio",
              "ape1" => "Sánchez",
              "ape2" => "Sánchez",
              "email" => "sss4esob@gmail.com",
              "password" => "1111",
              "activo" => "1",
              "ingreso" => new \DateTime()
            )
        );

        foreach ($users as $user) {
            $usuarioEntity = new UsuarioEntity();
            $usuarioEntity->setNombre($user['nombre']);
            $usuarioEntity->setApe1($user['ape1']);
            $usuarioEntity->setApe2($user['ape2']);
            $usuarioEntity->setEmail($user['email']);
            $usuarioEntity->setPassword($user['password']);
            $usuarioEntity->setActivo($user['activo']);
            $usuarioEntity->setIngreso($user['ingreso']);
            $manager->persist($usuarioEntity);

        }

        $manager->flush();


    }
}
