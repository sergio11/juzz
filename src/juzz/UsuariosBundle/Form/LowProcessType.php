<?php

namespace juzz\UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;


class LowProcessType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add('password', 'password', array(
        		'label'=>'low_process.form.password.label',
                'constraints' => new UserPassword(
                	array(
                		'message' => 'low_process.form.password.invalid'
                	)
                ),
                'required' => true
            ))
            ->add('reason', 'textarea', array(
        		'label'=>'low_process.form.reason.label',
                'trim' => true,
                'required' => false
            ))
            ->add('actions', 'form_actions', [
                'buttons' => [
                    'delete' => ['type' => 'submit', 'options' => ['label' => 'low_process.form.submit']],
                    'reset' => ['type' => 'reset', 'options' => ['label' => 'low_process.form.reset']],
                ]
            ]);

    }

	public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'juzzUsuariosBundle'
        ));
    }


    public function getName()
    {
        return 'low_process';
    }

}