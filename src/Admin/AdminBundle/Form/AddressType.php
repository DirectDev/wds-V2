<?php

namespace Admin\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name')
                ->add('street')
                ->add('streetComplement')
                ->add('city')
                ->add('postcode')
                ->add('country', 'entity', array(
                    'class' => 'FrontFrontBundle:Country',
                    'property' => 'name',
                    'multiple' => false,
                    'expanded' => false,
                    'by_reference' => true,
                    'required' => true,
                    'empty_value' => '',
                    'empty_data' => null
                ))
                ->add('latitude', 'number', array(
                    'scale' => 13
                ))
                ->add('longitude', 'number', array(
                    'scale' => 13
                ))
                ->add('facebookId')
                ->add('user', 'entity', array(
                    'class' => 'UserUserBundle:User',
                    'property' => 'username',
                    'multiple' => false,
                    'expanded' => false,
                    'by_reference' => true,
                    'required' => false,
                ))
                ->add('event', 'entity', array(
                    'class' => 'FrontFrontBundle:Event',
                    'property' => 'name',
                    'multiple' => false,
                    'expanded' => false,
                    'by_reference' => true,
                    'required' => false,
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Front\FrontBundle\Entity\Address'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'aab_address';
    }

}
