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
                    'maxlength' => 30
                )
            ))
            ->add('ape1','text',array(
                'label' => 'form.ape1.label',
                'attr' => array(
                    'maxlength' => 30
                )
            ))
            ->add('ape2','text',array(
                'label' => 'form.ape2.label',
                'attr' => array(
                    'maxlength' => 30
                )
            ))
            ->add('genero', 'choice', array(
                'choices'   => array('m' => 'form.gender.man', 'f' => 'form.gender.woman'),
                'required'  => true,
                'expanded' => true,
                'multiple' => false
            ))
            ->add('origen','entity', array(
                'class' => 'juzz\UsuariosBundle\Entity\Paises',
                'required' => true,
                'empty_value' => 'form.source.empty_value',
                'property' => 'nombre'
            ))
            ->add('email', 'email',  array(
                'label' => 'form.email.label', 
                'attr' => array(
                    'placeholder' => 'p.e usuario@servidor',
                    'autocomplete' => 'off'
                )
            ))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'passwords_not_match',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'first_options'  => array('label' => 'form.password.first_options'),
                'second_options' => array('label' => 'form.password.second_options'),
            ))
            ->add('actions', 'form_actions', [
                'buttons' => [
                    'save' => ['type' => 'submit', 'options' => ['label' => 'registration.actions.save']],
                    'cancel' => ['type' => 'reset', 'options' => ['label' => 'registration.actions.reset']],
                ]
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'juzz\UsuariosBundle\Entity\Usuarios',
            'translation_domain' => 'juzzUsuariosBundle'
        ));
    }
    public function getName()
    {
        return 'singup_usuario';
    }
}