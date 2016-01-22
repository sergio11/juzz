<?php 

namespace juzz\FilesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileBackgroundType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'juzz\FilesBundle\Entity\ProfileBackground',
            'compound' => true,
            'invalid_message' => 'Imagen de Perfil no válida',
            'constraints' => null
        ));
    }

    public function getParent()
    {
        return 'file';
    }
   
    public function getName(){
        return 'profile_background_image';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('file', 'file', array('label' => false));

    }



    
}