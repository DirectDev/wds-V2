<?php

namespace Admin\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MeaCityType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('city')
                ->add('image')
                ->add('ordre')
                ->add('salsaDiscover', 'checkbox', array(
                    'required' => false,
                ))
                ->add('bachataDiscover', 'checkbox', array(
                    'required' => false,
                ))
                ->add('kizombaDiscover', 'checkbox', array(
                    'required' => false,
                ))
                ->add('salsaLearn', 'checkbox', array(
                    'required' => false,
                ))
                ->add('bachataLearn', 'checkbox', array(
                    'required' => false,
                ))
                ->add('kizombaLearn', 'checkbox', array(
                    'required' => false,
                ))
                ->add('salsaMeet', 'checkbox', array(
                    'required' => false,
                ))
                ->add('bachataMeet', 'checkbox', array(
                    'required' => false,
                ))
                ->add('kizombaMeet', 'checkbox', array(
                    'required' => false,
                ))
                ->add('translations', 'a2lix_translations', array(
                    'fields' => array(
                        'edito' => array('attr' => array()),
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
            'data_class' => 'Front\FrontBundle\Entity\MeaCity'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'admin_adminbundle_meacity';
    }

}
