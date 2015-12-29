<?php

namespace juzz\EpisodiosBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use juzz\EpisodiosBundle\Entity\Terminos AS TerminosEntity;
use juzz\EpisodiosBundle\Entity\Categorias AS CategoriasEntity;
use juzz\UsuariosBundle\Entity\Usuarios;

/*
    Los accesorios de Doctrine2 son clases PHP que pueden crear y persistir objetos a la base de datos.
    Al igual que todas las clases en Symfony2, los accesorios deben vivir dentro de uno de los paquetes de tu aplicación.
*/
class Categorias extends AbstractFixture implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        //Categorías de la Aplicación
        $categories = array(
            "CAT_1" => array(
                "nombre" => "Historias y Creencias",
                "slug" => "historias_creencias",
                "description" => "Historias y creencias"
            ),
            "CAT_2" => array(
                "nombre" => "Fe, Filosofía y espiritualidad",
                "slug" => "fe_filosofia_espiritualidad",
                "description" => "Fe, Filosofía y espiritualidad",
                "parent" => "CAT_1"
            ),
            "CAT_3" => array(
                "nombre" => "Deporte",
                "slug" => "deporte",
                "description" => "Deporte"
            ),
            "CAT_4" => array(
                "nombre" => "Fútbol",
                "slug" => "futbol",
                "description" => "Fútbol",
                "parent" => "CAT_3"
            ),
            "CAT_5" => array(
                "nombre" => "Polideportivo",
                "slug" => "polideportivo",
                "description" => "Polideportivo",
                "parent" => "CAT_3"
            ),
            "CAT_6" => array(
                "nombre" => "Ciencia y Cultura",
                "slug" => "ciencia_cultura",
                "description" => "Ciencia y Cultura"
            ),
            "CAT_7" => array(
                "nombre" => "Arte y Literatura",
                "slug" => "arte_literatura",
                "description" => "Arte y Literatura",
                "parent" => "CAT_6"
            ),
            "CAT_8" => array(
                "nombre" => "Ciencia y Naturaleza",
                "slug" => "ciencia_naturaleza",
                "description" => "Ciencia y Naturaleza",
                "parent" => "CAT_6"
            ),
            "CAT_9" => array(
                "nombre" => "Idiomas",
                "slug" => "idiomas",
                "description" => "Idiomas",
                "parent" => "CAT_6"
            ),
            "CAT_10" => array(
                "nombre" => "Viajes y Lugares",
                "slug" => "viajes_lugares",
                "description" => "Viajes y Lugares",
                "parent" => "CAT_6"
            ),
            "CAT_11" => array(
                "nombre" => "Ocio",
                "slug" => "ocio",
                "description" => "Ocio"
            ),
            "CAT_12" => array(
                "nombre" => "Aficiones y Gastronomía",
                "slug" => "aficiones_gastronomia",
                "description" => "Aficiones y Gastronomía",
                "parent" => "CAT_11"
            ),
            "CAT_13" => array(
                "nombre" => "Cine, Tv y Espectáculos",
                "slug" => "cine_tv_espectaculos",
                "description" => "Cine, Tv y Espectáculos",
                "parent" => "CAT_11"
            ),
            "CAT_14" => array(
                "nombre" => "Humor y entretenimiento",
                "slug" => "humor_entretenimiento",
                "description" => "Humor y entretenimiento",
                "parent" => "CAT_11"
            ),
            "CAT_15" => array(
                "nombre" => "Magazine y Variedades",
                "slug" => "magazine_variedades",
                "description" => "Magazine y Variedades",
                "parent" => "CAT_11"
            ),
            "CAT_16" => array(
                "nombre" => "Videojuegos, Rol y Anime",
                "slug" => "videojuegos_rol_anime",
                "description" => "Videojuegos, Rol y Anime",
                "parent" => "CAT_11"
            ),
            "CAT_17" => array(
                "nombre" => "Actualidad y Sociedad",
                "slug" => "actualidad_sociedad",
                "description" => "Actualidad y Sociedad"
            ),
            "CAT_18" => array(
                "nombre" => "Mundo y Sociedad",
                "slug" => "mundo_sociedad",
                "description" => "Mundo y Sociedad",
                "parent" => "CAT_17"
            ),
            "CAT_19" => array(
                "nombre" => "Noticias y Sucesos",
                "slug" => "noticias_sucesos",
                "description" => "Noticias y Sucesos",
                "parent" => "CAT_17"
            ),
            "CAT_20" => array(
                "nombre" => "Política, Economía y Opinión",
                "slug" => "politica_economia_opinion",
                "description" => "Política, Economía y Opinión",
                "parent" => "CAT_17"
            ),
            "CAT_21" => array(
                "nombre" => "Bienestar y Familia",
                "slug" => "bienestar_familia",
                "description" => "Bienestar y Familia"
            ),
            "CAT_22" => array(
                "nombre" => "Hijos y Educación",
                "slug" => "hijos_educacion",
                "description" => "Hijos y Educación",
                "parent" => "CAT_21"
            ),
            "CAT_23" => array(
                "nombre" => "Mente y Psicología",
                "slug" => "mente_psicologia",
                "description" => "Mente y Psicología",
                "parent" => "CAT_21"
            ),
            "CAT_24" => array(
                "nombre" => "Pareja y Relaciones",
                "slug" => "pareja_relaciones",
                "description" => "Pareja y Relaciones",
                "parent" => "CAT_21"
            ),
            "CAT_25" => array(
                "nombre" => "Salud, Hogar y Consumo",
                "slug" => "salud_hogar_consumo",
                "description" => "Salud, Hogar y Consumo",
                "parent" => "CAT_21"
            ),
            "CAT_26" => array(
                "nombre" => "Empresa y Tecnología",
                "slug" => "empresa_tecnologia",
                "description" => "Empresa y Tecnología"
            ),
            "CAT_27" => array(
                "nombre" => "Desarrollo Personal",
                "slug" => "desarrollo_personal",
                "description" => "Desarrollo Personal",
                "parent" => "CAT_26"
            ),
            "CAT_28" => array(
                "nombre" => "Internet y Tecnología",
                "slug" => "internet_tecnologia",
                "description" => "Internet y Tecnología",
                "parent" => "CAT_26"
            ),
            "CAT_29" => array(
                "nombre" => "Marketing y Estrategias",
                "slug" => "marketing_estrategias",
                "description" => "Marketing y Estrategias",
                "parent" => "CAT_26"
            ),
            "CAT_30" => array(
                "nombre" => "Negocios y Sectores",
                "slug" => "negocios_sectores",
                "description" => "Negocios y Sectores",
                "parent" => "CAT_26"
            ),
            "CAT_31" => array(
                "nombre" => "Música",
                "slug" => "musica",
                "description" => "Música"
            ),
            "CAT_32" => array(
                "nombre" => "Alternativa e Indie",
                "slug" => "alternativa_indie",
                "description" => "Alternativa e Indie",
                "parent" => "CAT_31"
            ),
            "CAT_33" => array(
                "nombre" => "BSO y Clásica",
                "slug" => "bso_clasica",
                "description" => "BSO y Clásica",
                "parent" => "CAT_31"
            ),
            "CAT_34" => array(
                "nombre" => "Blues y Juzz",
                "slug" => "blues_juzz",
                "description" => "Blues y Juzz",
                "parent" => "CAT_31"
            ),
            "CAT_35" => array(
                "nombre" => "Electrónica",
                "slug" => "electronica",
                "description" => "Electrónica",
                "parent" => "CAT_31"
            ),
            "CAT_35" => array(
                "nombre" => "Experimental y New Age",
                "slug" => "experimental_new_age",
                "description" => "Experimental y New Age",
                "parent" => "CAT_31"
            ),
            "CAT_36" => array(
                "nombre" => "Hip Hop y Rap",
                "slug" => "hip_hop_rap",
                "description" => "Hip Hop y Rap",
                "parent" => "CAT_31"
            ),
            "CAT_37" => array(
                "nombre" => "Pop y Pop-Rock",
                "slug" => "pop_pop_rock",
                "description" => "Pop y Pop-Rock",
                "parent" => "CAT_31"
            ),
            "CAT_38" => array(
                "nombre" => "Rock y Metal",
                "slug" => "rock_metal",
                "description" => "Rock y Metal",
                "parent" => "CAT_31"
            )
        );

        foreach ($categories as $key => $category) {
            $terminoEntity = new TerminosEntity();
            $terminoEntity->setNombre($category['nombre']);
            $terminoEntity->setSlug($category['slug']);
            $terminoEntity->setDescripcion($category['description']);
            $manager->persist($terminoEntity);
            $manager->flush();
            $categoryEntity = new CategoriasEntity();
            $categoryEntity->setTermino($terminoEntity);

            if (isset($category['parent']) && isset($categories[$category['parent']])) {
                $parent = $categories[$category['parent']]['entity'];
                $categoryEntity->setParent($parent);
            }
            $manager->persist($categoryEntity);
            $categories[$key]['entity'] = $categoryEntity;
        }


        $manager->flush();

        
    }
}