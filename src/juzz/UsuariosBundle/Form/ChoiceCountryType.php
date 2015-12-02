<?php 

namespace juzz\UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ChoiceCountryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('origen','entity', array(
                'class' => 'juzz\UsuariosBundle\Entity\Paises',
                'required' => false,
                'mapped' => false,
                'empty_value' => 'Seleccione un pais',
                'property' => 'nombre',
                'query_builder' => function(EntityRepository $repository) {
                    return $repository->createQueryBuilder('f')->select();
                }
            ));;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'juzz\UsuariosBundle\Entity\Paises'
        ));
    }

    public function getName()
    {
        return 'choice_country';
    }
}