<?php

namespace Front\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Front\FrontBundle\Entity\Address;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\SecurityContext;

class EventType extends AbstractType {

    private $securityContext;

    public function __construct(SecurityContext $securityContext) {
        $this->securityContext = $securityContext;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *  
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $locales = array('en');
        if (isset($options['attr']['locale']))
            $locales[] = $options['attr']['locale'];

        $User = $this->securityContext->getToken()->getUser();

        $builder
                ->add('eventTypes', 'entity', array(
                    'class' => 'FrontFrontBundle:EventType',
                    'property' => 'name',
                    'multiple' => true,
                    'expanded' => true,
                    'by_reference' => true,
                ))
                ->add('musicTypes', 'entity', array(
                    'class' => 'FrontFrontBundle:MusicType',
                    'property' => 'name',
                    'multiple' => true,
                    'expanded' => true,
                    'by_reference' => true,
                ))
                ->add('translations', 'a2lix_translations', array(
                    'locales' => $locales,
                    'fields' => array(
                        'title' => array('attr' => array('required' => true)),
                        'description' => array('attr' => array('class' => 'ckeditor form-control'))
                    )
                ))
                ->add('published', 'checkbox', array(
                    'required' => false,
                ))
        ;
        if ($User)
            $builder->add('organizedBy', 'entity', array(
                'class' => 'UserUserBundle:User',
                'required' => false,
                'property' => 'username',
                'multiple' => false,
                'expanded' => false,
                'by_reference' => true,
                'query_builder' => function (EntityRepository $er) use ($User) {
                    return $er->createQueryBuilder('u')
                                    ->where('u.id = :user')
                                    ->setParameter('user', $User->getId());
                },
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Front\FrontBundle\Entity\Event'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'front_frontbundle_event';
    }

}
