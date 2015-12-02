<?php

namespace juzz\UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use juzz\FilesBundle\Form\FileType;
use juzz\UsuariosBundle\Form\ChoiceCountryType;
use Doctrine\ORM\EntityRepository;

class UsuarioRegistroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('nick','text',array(
                'label' => 'Nick',
                'attr' => array(
                    'placeholder' => 'p.e sergio11',
                    'maxlength' => 30
                )
            ))
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
                'required'  => false,
                'expanded' => true,
                'multiple' => false
            ))
            ->add('origen', new ChoiceCountryType())
            ->add('email', 'email',  array('label' => 'Correo electrónico', 'attr' => array(
                'placeholder' => 'p.e usuario@servidor',
                'autocomplete' => 'off'
            )))
            ->add('password','password',array(
                'label' => 'Password',
                'attr' => array(
                    'placeholder' => 'p.g esperanto36'
                )
            ))
            ->add('avatar',new FileType())
            ->add('Guardar', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'juzz\UsuariosBundle\Entity\Usuarios',
            'validation_groups' => array('default', 'registro')
        ));
    }
    public function getName()
    {
        return 'singup_usuario';
    }
}