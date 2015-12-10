<?php 

namespace juzz\FilesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileImageType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'juzz\FilesBundle\Entity\Imagenes',
            'compound' => true
        ));
    }

    public function getParent()
    {
        return 'file';
    }
   
    public function getName(){
        return 'profile_image';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('file', 'file', array('label' => false));

    }

    /**
     * Pass the image URL to the view
     *
     * @param FormView $view
     * @param FormInterface $form
     * @param array $options
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $parentData = $form->getParent()->getData();

        if (null !== $parentData) {
            $accessor = PropertyAccess::createPropertyAccessor();
            $imageUrl = $accessor->getValue($parentData, 'avatar.webPath');
        } else {
            $imageUrl = null;
        }

        // set an "image_url" variable that will be available when rendering this field
        $view->vars['avatar'] = $imageUrl;
    }
}