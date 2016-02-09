<?php

namespace juzz\UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;


class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('avatarFile','file',array(
                'label' => false,
                'required' => false
            ))
            ->add('nick','text',array(
                'label' => 'form.nick.label',
                'attr' => array(
                    'maxlength' => 30,
                    'data-toggle' => 'popover',
                    'data-trigger' => 'focus',
                    'data-content' => 'form.nick.popover',
                    'data-placement' => 'left'
                )
            ))
            ->add('nombre','text',array(
                'label' => 'form.name.label',
                'attr' => array(
                    'help_text' => 'form.name.help_text',
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
                'multiple' => false,
                'attr' => array('align_with_widget' => true)
            ))
            ->add('origen','entity', array(
                'class' => 'juzz\UsuariosBundle\Entity\Paises',
                'required' => true,
                'empty_value' => 'form.source.empty_value',
                'property' => 'nombre'
            ))
            ->add('descripcion','textarea', array(
                'label' => 'form.description.label'
            ))
            ->add('categoria', 'entity', array(
                'class'     => 'juzz\EpisodiosBundle\Entity\Categorias',
                'expanded'  => false,
                'multiple'  => true,
                'required' => false,
                'label' => 'form.category.label',
                'choice_label' => function ($category) {
                    return $category->getTermino()->getNombre();
                }
                
            ))
            ->add('politicaComentarios', 'entity', array(
                'class' => 'juzz\CommentsBundle\Entity\PoliticaComentarios',
                'label' => 'form.comments_policy.label',
                'required' => true,
                'property' => 'name'
            ))
            ->add('profileBgFile','file',array(
                'label' => false,
                'required' => false
            ))
            ->add('actions', 'form_actions', [
                'buttons' => [
                    'save' => ['type' => 'submit', 'options' => ['label' => 'edit.actions.save']],
                    'reset' => ['type' => 'reset', 'options' => ['label' => 'edit.actions.reset']],
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'juzz\UsuariosBundle\Entity\Usuarios',
            'cascade_validation' => false,
            'translation_domain' => 'juzzUsuariosBundle'
        ));
    }


    public function getName()
    {
        return 'edit_user_profile';
    }
}