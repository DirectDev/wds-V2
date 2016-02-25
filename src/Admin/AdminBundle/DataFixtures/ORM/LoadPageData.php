<?php

namespace Admin\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Admin\AdminBundle\Entity\Page;

class LoadPageData extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {


        $Page = new Page();
        $Page->setName('home');
        $Page->translate('en')->setTitle('WeDanceSalsa');
        $Page->translate('fr')->setTitle('WeDanceSalsa');
        $Page->translate('en')->setDescription('Find all Salsa/Bachata/Kizomba events everywhere, anytime !');
        $Page->translate('fr')->setDescription('Trouvez tous les évenements Salsa/Bachata/Kizomba près de chez  vous !');
        $manager->persist($Page);
        $this->addReference('page-home', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city');
        $Page->translate('en')->setTitle('Find all salsa/Bachata/Kizomba events close to');
        $Page->translate('fr')->setTitle('Trouvez tous les événements Salsa/Bachanta/Kizomba proches de');
        $Page->translate('en')->setDescription('Find all salsa/Bachata/Kizomba events close to');
        $Page->translate('fr')->setDescription('Trouvez tous les événements Salsa/Bachanta/Kizomba close to');
        $manager->persist($Page);
        $this->addReference('page-city', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('policy');
        $Page->translate('en')->setTitle('Privacy policy');
        $Page->translate('fr')->setTitle('Mentions Légales');
        $Page->translate('en')->setDescription('Privacy policy');
        $Page->translate('fr')->setDescription('Mentions Légales');
        $manager->persist($Page);
        $this->addReference('page-policy', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_calendar');
        $Page->translate('en')->setTitle('calendar');
        $Page->translate('fr')->setTitle('calendier');
        $Page->translate('en')->setDescription('calendar');
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-city-calendar', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_dancer');
        $Page->translate('en')->setTitle('dancers');
        $Page->translate('fr')->setTitle('danceurs/danseuses');
        $Page->translate('en')->setDescription('dancers');
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-city-dancers', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_teacher');
        $Page->translate('en')->setTitle('WeDanceSalsa');
        $Page->translate('fr')->setTitle('professeurs');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-city-teachers', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_artist');
        $Page->translate('en')->setTitle('artists');
        $Page->translate('fr')->setTitle('professionnels');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-city-artists', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_bar');
        $Page->translate('en')->setTitle('places');
        $Page->translate('fr')->setTitle('lieux');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-city-bars', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_introduction');
        $Page->translate('en')->setTitle('Introductions');
        $Page->translate('fr')->setTitle('Initiations');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-city-introductions', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_concert');
        $Page->translate('en')->setTitle('concerts');
        $Page->translate('fr')->setTitle('concerts');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-city-concerts', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_workshop');
        $Page->translate('en')->setTitle('workshops');
        $Page->translate('fr')->setTitle('cours');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-city-workshops', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_show');
        $Page->translate('en')->setTitle('shows');
        $Page->translate('fr')->setTitle('shows');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-city-shows', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_party');
        $Page->translate('en')->setTitle('parties');
        $Page->translate('fr')->setTitle('soirées');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-city-parties', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_festival');
        $Page->translate('en')->setTitle('festivals');
        $Page->translate('fr')->setTitle('festivals');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-city-festivals', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_photo');
        $Page->translate('en')->setTitle('photos');
        $Page->translate('fr')->setTitle('photos');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-city-photos', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_music');
        $Page->translate('en')->setTitle('musics');
        $Page->translate('fr')->setTitle('musiques');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-city-musics', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_video');
        $Page->translate('en')->setTitle('videos');
        $Page->translate('fr')->setTitle('videos');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-city-videos', $Page);
        $Page->mergeNewTranslations();


        $Page = new Page();
        $Page->setName('festival_calendar');
        $Page->translate('en')->setTitle('Festivals Calendar');
        $Page->translate('fr')->setTitle('Calendrier des Festivals');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-festival-calendar', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('festival_europe');
        $Page->translate('en')->setTitle('European Festivals');
        $Page->translate('fr')->setTitle('Festivals Européens');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-festival-europe', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('festival_north_america');
        $Page->translate('en')->setTitle('North American Festivals');
        $Page->translate('fr')->setTitle('Festivals Nord Américains');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-festival-north-america', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('festival_central_america');
        $Page->translate('en')->setTitle('Central American Festivals');
        $Page->translate('fr')->setTitle('Festivals Centre Américains');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-festival-centre-america', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('festival_south_america');
        $Page->translate('en')->setTitle('South American Festivals');
        $Page->translate('fr')->setTitle('Festivals Sud Américains');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-festival-south-america', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('festival_north_africa');
        $Page->translate('en')->setTitle('North African Festivals');
        $Page->translate('fr')->setTitle('Festivals Nord Africains');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-festival-north-africa', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('festival_central_africa');
        $Page->translate('en')->setTitle('Central African Festivals');
        $Page->translate('fr')->setTitle('Festivals Centre Africains');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-festival-centre-africa', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('festival_south_africa');
        $Page->translate('en')->setTitle('South African Festivals');
        $Page->translate('fr')->setTitle('Festivals Sud Africains');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-festival-south-africa', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('festival_north_asia');
        $Page->translate('en')->setTitle('North Asian Festivals');
        $Page->translate('fr')->setTitle('Festivals Nord Asie');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-festival-north-asia', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('festival_south_asia');
        $Page->translate('en')->setTitle('South Asian Festivals');
        $Page->translate('fr')->setTitle('Festivals Sud Asie');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-festival-south-asia', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('festival_india');
        $Page->translate('en')->setTitle('Indian Festivals');
        $Page->translate('fr')->setTitle('Festivals Indiens');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-festival-india', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('festival_australia');
        $Page->translate('en')->setTitle('Australian Festivals');
        $Page->translate('fr')->setTitle('Festivals Australiens');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-festival-australia', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('festival_indonesia');
        $Page->translate('en')->setTitle('Indonesian Festivals');
        $Page->translate('fr')->setTitle('Festivals Indonésie');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-festival-indonesia', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('festival_middle_east');
        $Page->translate('en')->setTitle('Middle Eastern Festivals');
        $Page->translate('fr')->setTitle('Festivals Moyen Orient');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-festival-middle-east', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('musics');
        $Page->translate('en')->setTitle('Musics');
        $Page->translate('fr')->setTitle('Musiques');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-musics', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('videos');
        $Page->translate('en')->setTitle('Videos');
        $Page->translate('fr')->setTitle('Vidéos');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-videos', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('moves');
        $Page->translate('en')->setTitle('Moves & Shines');
        $Page->translate('fr')->setTitle('Passes & Shines');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-moves', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('users');
        $Page->translate('en')->setTitle('Dancers');
        $Page->translate('fr')->setTitle('Salseros');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-users', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('dance-salsa');
        $Page->translate('en')->setTitle('Salsa');
        $Page->translate('fr')->setTitle('Salsa');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-dance-salsa', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('dance-salsa-cubana');
        $Page->translate('en')->setTitle('Salsa Cubana');
        $Page->translate('fr')->setTitle('Salsa Cubaine');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-dance-salsa-cubana', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('dance-salsa-on1');
        $Page->translate('en')->setTitle('Salsa On1');
        $Page->translate('fr')->setTitle('Salsa On1');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-dance-salsa-on1', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('dance-salsa-on2');
        $Page->translate('en')->setTitle('Salsa On2');
        $Page->translate('fr')->setTitle('Salsa On2');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-dance-salsa-On2', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('dance-salsa-dominicana');
        $Page->translate('en')->setTitle('Salsa Dominicana');
        $Page->translate('fr')->setTitle('Salsa Dominiquaine');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-dance-salsa-dominicana', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('dance-salsa-rueda');
        $Page->translate('en')->setTitle('Salsa Rueda');
        $Page->translate('fr')->setTitle('Salsa Rueda');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-dance-salsa-rueda', $Page);
        $Page->mergeNewTranslations();


        $Page = new Page();
        $Page->setName('dance-bachata');
        $Page->translate('en')->setTitle('Bachata');
        $Page->translate('fr')->setTitle('Bachata');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-dance-bachata', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('dance-bachata-moderna');
        $Page->translate('en')->setTitle('Bachata Moderna');
        $Page->translate('fr')->setTitle('Bachata Moderne');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-dance-bachata-noderna', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('dance-bachata-sensual');
        $Page->translate('en')->setTitle('Bachata Sensual');
        $Page->translate('fr')->setTitle('Bachata Sensuelle');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-dance-bachata-sensual', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('dance-bachata-dominicana');
        $Page->translate('en')->setTitle('Bachata Dominicana');
        $Page->translate('fr')->setTitle('Bachata Dominiquaine');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-dance-bachata-dominicana', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('dance-kizomba');
        $Page->translate('en')->setTitle('Kizomba');
        $Page->translate('fr')->setTitle('Kizomba');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-dance-kizomba', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('learn-salsa');
        $Page->translate('en')->setTitle('Learn Salsa');
        $Page->translate('fr')->setTitle('Apprendre la Salsa');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-learn-salsa', $Page);
        $Page->mergeNewTranslations();
        
        $Page = new Page();
        $Page->setName('learn-bachata');
        $Page->translate('en')->setTitle('Learn Bachata');
        $Page->translate('fr')->setTitle('Apprendre la Bachata');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-learn-bachata', $Page);
        $Page->mergeNewTranslations();
        
        $Page = new Page();
        $Page->setName('learn-kizomba');
        $Page->translate('en')->setTitle('Learn Kizomba');
        $Page->translate('fr')->setTitle('Apprendre la Kizomba');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-learn-kizomba', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('landing-dancer');
        $Page->translate('en')->setTitle('Landing Page Dancer');
        $Page->translate('fr')->setTitle('Landing Page Dancer');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-landing-dancer', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('landing-pro');
        $Page->translate('en')->setTitle('Landing Page Pro');
        $Page->translate('fr')->setTitle('Landing Page Pro');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-landing-pro', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('landing-pub');
        $Page->translate('en')->setTitle('Landing Page Pub');
        $Page->translate('fr')->setTitle('Landing Page Pub');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-landing-pub', $Page);
        $Page->mergeNewTranslations();
        
        $Page = new Page();
        $Page->setName('landing-share-event');
        $Page->translate('en')->setTitle('Share Event');
        $Page->translate('fr')->setTitle('Partagez vos évenements');
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-landing-share-event', $Page);
        $Page->mergeNewTranslations();

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 1;
    }

}
