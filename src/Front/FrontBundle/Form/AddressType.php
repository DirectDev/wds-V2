<?php

namespace Front\FrontBundle\Form;

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
        ));

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
        return 'ffa';
    }

}
