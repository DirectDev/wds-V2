<?php

namespace Front\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Front\FrontBundle\Form\VideoType;

class MoveType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $locales = array('en');
        if (isset($options['attr']['locale']))
            $locales[] = $options['attr']['locale'];

        $builder
                ->add('name')
                ->add('translations', 'a2lix_translations', array(
                    'locales' => $locales,
                    'fields' => array(
                        'title' => array('attr' => array('required' => true)),
                    )
                ))
                ->add('video', new VideoType(), array(
                    'data_class' => 'Front\FrontBundle\Entity\Video')
                )
                ->add('tags', 'entity', array(
                    'class' => 'FrontFrontBundle:Tag',
                    'property' => 'name',
                    'multiple' => true,
                    'expanded' => true,
                    'by_reference' => false,
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Front\FrontBundle\Entity\Move'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'front_frontbundle_move';
    }

}
