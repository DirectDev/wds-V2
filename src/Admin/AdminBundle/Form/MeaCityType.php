<?php

namespace Admin\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MeaCityType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image')
            ->add('ordre')
            ->add('salsaDiscover')
            ->add('bachataDiscover')
            ->add('kizombaDiscover')
            ->add('salsaLearn')
            ->add('bachataLearn')
            ->add('kizombaLearn')
            ->add('salsaMeet')
            ->add('bachataMeet')
            ->add('kizombaMeet')
            ->add('city')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Front\FrontBundle\Entity\MeaCity'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'admin_adminbundle_meacity';
    }
}
