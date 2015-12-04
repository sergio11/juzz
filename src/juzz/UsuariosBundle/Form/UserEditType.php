<?php

namespace juzz\UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use juzz\FilesBundle\Form\FileType;
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
            ->add('email', 'email',  array('label' => 'Correo electrónico', 'attr' => array(
                'placeholder' => 'p.e usuario@servidor',
                'autocomplete' => 'off'
            )))
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
            ->add('avatar',new FileType())
            ->add('guardar', 'submit')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'juzz\UsuariosBundle\Entity\Usuarios'
        ));
    }

    public function getName()
    {
        return 'edit_user_profile';
    }
}