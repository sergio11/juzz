<?php

namespace juzz\UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use juzz\FilesBundle\Form\ProfileImageType;
use Doctrine\ORM\EntityRepository;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nick','text',array(
                'label' => 'Nick',
                'attr' => array(
                    'placeholder' => 'p.e sergio11',
                    'maxlength' => 30
                )
            ))
            ->add('nombre')
            ->add('ape1','text',array(
                'label' => 'Primer Apellido',
                'attr' => array(
                    'placeholder' => 'p.e Sánchez',
                    'maxlength' => 30
                )
            ))
            ->add('ape2','text',array(
                'label' => 'Segundo Apellido',
                'attr' => array(
                    'placeholder' => 'p.e Sánchez',
                    'maxlength' => 30
                )
            ))
            ->add('genero', 'choice', array(
                'choices'   => array('m' => 'Hombre', 'f' => 'Mujer'),
                'required'  => true,
                'expanded' => true,
                'multiple' => false
            ))
            ->add('origen','entity', array(
                'class' => 'juzz\UsuariosBundle\Entity\Paises',
                'required' => true,
                'empty_value' => 'Seleccione un pais',
                'property' => 'nombre'
            ))
            ->add('descripcion','textarea', array(
                'label' => 'Descripción Personal'
            ))
            ->add('categoria', 'entity', array(
                'class'     => 'juzz\EpisodiosBundle\Entity\Categorias',
                'expanded'  => false,
                'multiple'  => true,
                'label' => 'Intereses',
                'choice_label' => function ($category) {
                    return $category->getTermino()->getNombre();
                }
            ))
            ->add('avatar','profile_image',array(
                'label' => false,
                'required'  => false
            ))
            ->add('guardar', 'submit')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'juzz\UsuariosBundle\Entity\Usuarios',
            'cascade_validation' => false
        ));
    }


    public function getName()
    {
        return 'edit_user_profile';
    }
}