<?php

namespace Admin\AdminBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Routing\Router;

class SitemapServices {

    private $em;
    private $container;
    private $router;
    private $locales;
    private $cities;
    private $events;
    private $users;
    private $routes;
    private $url = 'http://wedancesalsa.com/sitemaps/';
    private $max_link = 50000;
    private $max_cities = 10000;
    private $max_events = 1000;
    private $max_users = 1000;
    private $dir;

    function __construct(EntityManager $em, Container $container, Router $router, $locales) {
        $this->em = $em;
        $this->container = $container;
        $this->router = $router;
        $this->locales = $locales;
        $this->dir = __DIR__ . "/../../../../www/sitemaps/";
        $this->routes = array(
            'dance_salsa',
            'dance_salsa_cubana',
            'dance_salsa_on1',
            'dance_salsa_on2',
            'dance_salsa_rueda',
            'dance_bachata',
            'dance_bachata_moderna',
            'dance_bachata_dominicana',
            'dance_bachata_sensual',
            'dance_kizomba',
            'festival_calendar',
            'festival_europe',
            'festival_north_america',
            'festival_central_america',
            'festival_south_america',
            'festival_north_africa',
            'festival_central_africa',
            'festival_south_africa',
            'festival_north_asia',
            'festival_south_asia',
            'festival_india',
            'festival_australia',
            'festival_indonesia',
            'festival_middle_east',
            'landing_dancer',
            'landing_pro',
            'landing-share-event',
            'learn_salsa',
            'learn_bachata',
            'learn_kizomba',
            'front_video',
            'front_move',
            'front_music',
        );
    }

    public function generate() {

        $this->cities = $this->em->getRepository('FrontFrontBundle:City')->findForSitemaps($this->max_cities);
        $this->events = $this->em->getRepository('FrontFrontBundle:Event')->findForSitemaps($this->max_events);
        $this->users = $this->em->getRepository('UserUserBundle:User')->findForSitemaps($this->max_users);

        $rootNode = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

        foreach ($this->locales as $locale) {
            $sitemap_name_locale = 'sitemap_' . $locale . '.xml';
            $itemNode = $rootNode->addChild('url');
            $itemNode->addChild('loc', $this->url . $sitemap_name_locale);
            $this->generateSitemapByLocale($locale, $sitemap_name_locale);
        }

        $xml = $rootNode->asXML();

        $this->writeFile("sitemap.xml", $xml);
    }

    private function writeFile($name, $content) {
        $handle = fopen($this->dir . $name, "w");
        fwrite($handle, $content);
        fclose($handle);
    }

    private function generateSitemapByLocale($locale, $filename) {
        $rootNode = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

        $general_sitemap_name_locale = 'sitemap_general_' . $locale . '.xml';
        $itemNode = $rootNode->addChild('url');
        $itemNode->addChild('loc', $this->url . $general_sitemap_name_locale);
        $this->generateGeneralSitemapByLocale($locale, $general_sitemap_name_locale);

        $city_sitemap_name_locale = 'sitemap_city_' . $locale . '.xml';
        $itemNode = $rootNode->addChild('url');
        $itemNode->addChild('loc', $this->url . $city_sitemap_name_locale);
        $this->generateCitySitemapByLocale($locale, $city_sitemap_name_locale);

        $event_sitemap_name_locale = 'sitemap_events_' . $locale . '.xml';
        $itemNode = $rootNode->addChild('url');
        $itemNode->addChild('loc', $this->url . $event_sitemap_name_locale);
        $this->generateEventSitemapByLocale($locale, $event_sitemap_name_locale);

        $user_sitemap_name_locale = 'sitemap_users_' . $locale . '.xml';
        $itemNode = $rootNode->addChild('url');
        $itemNode->addChild('loc', $this->url . $user_sitemap_name_locale);
        $this->generateUserSitemapByLocale($locale, $user_sitemap_name_locale);

        $xml = $rootNode->asXML();

        $this->writeFile($filename, $xml);
    }

    private function generateCitySitemapByLocale($locale, $filename) {
        $rootNode = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

        $count = 0;
        foreach ($this->cities as $city) {

            if (!$city['name'])
                continue;

            $path = $this->router->generate('city_edito', array('searchcity' => $city['name'], '_locale' => $locale), true);
            $count = $this->addLink($path, $rootNode, $locale, $count);
            $path = $this->router->generate('city_calendar', array('searchcity' => $city['name'], '_locale' => $locale), true);
            $count = $this->addLink($path, $rootNode, $locale, $count);
            $path = $this->router->generate('city_teacher', array('searchcity' => $city['name'], '_locale' => $locale), true);
            $count = $this->addLink($path, $rootNode, $locale, $count);
            $path = $this->router->generate('city_introduction', array('searchcity' => $city['name'], '_locale' => $locale), true);
            $count = $this->addLink($path, $rootNode, $locale, $count);
            $path = $this->router->generate('city_festival', array('searchcity' => $city['name'], '_locale' => $locale), true);
            $count = $this->addLink($path, $rootNode, $locale, $count);
        }


        $xml = $rootNode->asXML();

        $this->writeFile($filename, $xml);
    }

    private function generateEventSitemapByLocale($locale, $filename) {
        $rootNode = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

        $count = 0;
        foreach ($this->events as $event) {
            $path = $this->router->generate('front_event_show', array('uri' => $event->getURI($locale), 'id' => $event->getId(), '_locale' => $locale), true);
            $count = $this->addLink($path, $rootNode, $locale, $count);
        }

        $xml = $rootNode->asXML();

        $this->writeFile($filename, $xml);
    }

    private function generateUserSitemapByLocale($locale, $filename) {
        $rootNode = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

        $count = 0;
        foreach ($this->users as $user) {
            $path = $this->router->generate('front_user_show_public', array('username' => $user['username'], 'id' => $user['id'], '_locale' => $locale), true);
            $count = $this->addLink($path, $rootNode, $locale, $count);
        }

        $xml = $rootNode->asXML();

        $this->writeFile($filename, $xml);
    }

    private function generateGeneralSitemapByLocale($locale, $filename) {
        $rootNode = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

        foreach ($this->routes as $route) {
            $path = $this->router->generate($route, array('_locale' => $locale), true);
            $this->addLink($path, $rootNode, $locale);
        }

        $xml = $rootNode->asXML();

        $this->writeFile($filename, $xml);
    }

    private function addLink($path, $rootNode, $locale, $count = 0) {
        if ($count >= $this->max_link)
            return $count;

        $itemNode = $rootNode->addChild('url');
        $itemNodeLoc = $itemNode->addChild('loc', $path);
//        $itemNodeLoc->addAttribute('rel', 'alternate');
//        $itemNodeLoc->addAttribute('hreflang', $locale);
//        $itemNodeLoc->addAttribute('href', $path);
        return $count++;
    }

}
