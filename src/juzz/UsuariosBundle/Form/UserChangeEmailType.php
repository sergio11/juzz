<?php

namespace juzz\UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserChangeEmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add('email', 'repeated', array(
                'type' => 'email',
                'invalid_message' => 'The email fields must match.',
                'options' => array('attr' => array('autocomplete' => 'off')),
                'required' => true,
                'first_options'  => array('label' => 'new email'),
                'second_options' => array('label' => 'Repeat new email'),
            ))
            ->add('cambiar', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'juzz\UsuariosBundle\Entity\Usuarios'
        ));
    }

    public function getName()
    {
        return 'chenge_email';
    }
}