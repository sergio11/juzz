<?php

namespace juzz\UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class UserChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('currentpassword', 'password', array('label'=>'change_password.form.current_password.label',
                'mapped' => false,
                'constraints' => new UserPassword(array('message' => 'change_password.form.current_password.message')),
                'required' => true
            ))
        	->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'change_password.form.plain_password.invalid_message',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'first_options'  => array('label' => 'change_password.form.plain_password.first_options'),
                'second_options' => array('label' => 'change_password.form.plain_password.second_options')
            ))
            ->add('actions', 'form_actions', [
                'buttons' => [
                    'save' => ['type' => 'submit', 'options' => ['label' => 'change_password.form.actions.save']],
                    'reset' => ['type' => 'reset', 'options' => ['label' => 'change_password.form.actions.reset']],
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
        return 'change_password';
    }
}