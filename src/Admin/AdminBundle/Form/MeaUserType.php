<?php

namespace Admin\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MeaUserType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('ordre')
                ->add('user')
                ->add('translations', 'a2lix_translations', array(
                    'fields' => array(
                        'description' => array('attr' => array('class' => 'ckeditor form-control'))
                    )
                ))
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
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Front\FrontBundle\Entity\MeaUser'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'admin_adminbundle_meauser';
    }

}
