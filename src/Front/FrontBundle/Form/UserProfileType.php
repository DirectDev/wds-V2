<?php

namespace Front\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class UserProfileType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('username', 'text', array(
                'required' => true,
                'trim' => true
            ))
            ->add('firstname')
            ->add('lastname')
            ->add('show_last_firstname')
            ->add('published')
            ->add('userTypes',
                'entity',
                array(
                'class' => 'UserUserBundle:UserType',
                'property' => 'title',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => true,
            ))
            ->add('musicTypes',
                'entity',
                array(
                'class' => 'FrontFrontBundle:MusicType',
                'property' => 'title',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => true,
            ))
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
        return 'ffup';
    }
}