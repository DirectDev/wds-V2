<?php

namespace Admin\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MusicType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('url')
                ->add('name')
                ->add('user')
                ->add('tags')
                ->add('translations', 'a2lix_translations', array(
                    'fields' => array(
                        'title' => array('attr' => array('class' => 'form-control'))
                    )
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Front\FrontBundle\Entity\Music'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'aab_music';
    }

}
