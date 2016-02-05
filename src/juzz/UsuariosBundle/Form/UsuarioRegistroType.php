<?php

namespace juzz\UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
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
            ->add('email', 'email',  array('label' => 'Correo electrónico', 'attr' => array(
                'placeholder' => 'p.e usuario@servidor',
                'autocomplete' => 'off'
            )))
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'The password fields must match.',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
            ->add('actions', 'form_actions', [
                'buttons' => [
                    'save' => ['type' => 'submit', 'options' => ['label' => 'Registrarme']],
                    'cancel' => ['type' => 'reset', 'options' => ['label' => 'Restablecer']],
                ]
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'juzz\UsuariosBundle\Entity\Usuarios'
        ));
    }
    public function getName()
    {
        return 'singup_usuario';
    }
}