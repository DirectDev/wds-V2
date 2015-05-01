<?php

namespace Front\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class UserDescriptionType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $locales = array('en');
        if (isset($options['attr']['locale']))
            $locales[] = $options['attr']['locale'];

        $builder->add('translations', 'a2lix_translations', array(
            'locales' => $locales,
            'fields' => array(
                'description_short' => array('attr' => array('class' => 'ckeditor form-control')),
                'description' => array('attr' => array('class' => 'ckeditor form-control')),
                'baseline' => array(),
    )))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'User\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'front_frontbundle_user_description';
    }

}
