<?php

namespace Admin\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MeaFestivalType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('ordre')
                ->add('event')
                ->add('translations', 'a2lix_translations', array(
                    'fields' => array(
                        'description' => array('attr' => array('class' => 'ckeditor form-control'))
                    )
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Front\FrontBundle\Entity\MeaFestival'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'admin_adminbundle_meafestival';
    }

}
