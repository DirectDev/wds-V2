<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel {

    public function registerBundles() {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            # bundles
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Knp\Bundle\GaufretteBundle\KnpGaufretteBundle(),
            # users bundle
            new FOS\UserBundle\FOSUserBundle(),
            new User\UserBundle\UserUserBundle(),
            new HWI\Bundle\OAuthBundle\HWIOAuthBundle(),
            # translations
            new JMS\I18nRoutingBundle\JMSI18nRoutingBundle(),
            new JMS\TranslationBundle\JMSTranslationBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\AopBundle\JMSAopBundle(),
            new A2lix\TranslationFormBundle\A2lixTranslationFormBundle(),
            new Elao\Bundle\FormTranslationBundle\ElaoFormTranslationBundle(),
            # images
            new PunkAve\FileUploaderBundle\PunkAveFileUploaderBundle(),
            new Liip\ImagineBundle\LiipImagineBundle(),
            # geocode
            new Bazinga\Bundle\GeocoderBundle\BazingaGeocoderBundle(),
            # application bundle
            new Front\FrontBundle\FrontFrontBundle(),
            new Admin\AdminBundle\AdminAdminBundle(),
            new File\FileBundle\FileFileBundle(),
            new Search\SearchBundle\SearchSearchBundle(),
            new Contact\ContactBundle\ContactContactBundle(),
            # Api
            new FOS\RestBundle\FOSRestBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new Api\ApiV1Bundle\ApiApiV1Bundle(),
        );

        if (in_array($this->getEnvironment(), array('dev'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
        }
        if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader) {
        $loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');
    }

}
