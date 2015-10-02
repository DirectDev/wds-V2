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

        $policy_en = '<h1>Terms of Use</h1>

<h2>1. Introducing our website</h2>

<p>According to Law No. 2004-2005 of 21 June 2004 on confidence in the digital economy, our web site created by <a href="http://directdev.fr">DirectDev.fr</a>, site owner <a href="http://directdev.fr">DirectDev</a>, provides public information about our company.<br />
Possibly flexible we invite you to consult our disclaimer as often as possible in order to read it frequently<br />
<br />
The site belongs to <a href="http://directdev.fr">DirectDev</a>, whose headquarters are located at the following address: Lille, France.<br />
<br />
<a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a>, The site is hosted by OVH, whose head office is located at the following address:<br />
2 rue Kellermann - 59100 Roubaix - France.</p>

<h2>2. Terms of Use and the services offered.</h2>

<p>Using <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a>, you fully and completely accept the terms and conditions set out in our privacy policy. Accessible to all types of visitors, it is important to note, however, that an interruption for maintenance of the website may be decided by the owner.</p>

<h2>3. Products or services offered by WeDanceSalsa.com</h2>

<p>In keeping with its policy of communication, <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> site aims to inform users about Salsa / Bachata / Kizomba / Tango events. However, inaccuracies or omissions may exist: the company shall in no circumstances be held liable for any error in the <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> site.</p>

<h2>4. Contractual Limitations</h2>

<p>The information input on our website <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> subject to qualitative approaches in order to ensure their reliability. However, we will not incur any responsibility for any technical inaccuracies in our explanations.<br />
If you find an error in the information we have been omitted, please notify us by email at <a href="http://WeDanceSalsa.com/contact">WeDanceSalsa.com/contact</a>.<br />
<br />
The links directly or indirectly linked to our website <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> are not under the control of our company. Therefore, we can not assure us of the correctness of the information on those other websites.<br />
<br />
Using JavaScript technology, <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> site can not be held liable for any damage arising from its use. Furthermore, any other type of consequences resulting from use of the site <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a>, whether direct or indirect (bug, incompatibility, viruses, lost sales, etc.).</p>

<p>&nbsp;</p>

<h2>5. IP and website content</h2>

<p>The editorial content of the web site is owned exclusively <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> to its owner. Any infringement of copyright is punishable under Article 335-2 of the Code of Intellectual Property, with a penalty of two years imprisonment and a fine of &euro; 150,000<br />
<br />
<a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> the site may be affected in the event of offensive, racist, defamatory or pornographic traded in interactive areas. The company also reserves the right to remove any content contrary to the values ​​of the company or the laws applicable in France.<br />
<br />
By browsing <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> site, the user also agrees to install any cookies on their computer.</p>

<p>&nbsp;</p>

<h2>6. Privacy, respect of your privacy and your freedoms</h2>

<p>Any information collected on the website <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> are within the requirements related to the use of our platform, such as the user profile form or the form of Events Suscribe.<br />
<br />
Accordance with the &quot;Data Protection&quot; Act of 6 January 1978 amended in 2004, the user has a right to access and correct information about him, right can be exercised at any time by sending an email via contact page: <a href="http://WeDanceSalsa.com/contact/en">WeDanceSalsa.com/contact</a><br />
<br />
The databases are protected by the provisions of the Law of 1 July 1998 transposing Directive 96/9 of 11 March 1996 on the legal protection of databases.</p>

<p>&nbsp;</p>

<h2>7. Law and relevant laws</h2>

<p>Subject to French law, the web site is <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> regulated by law No. 2004-2005 of 21 June 2004 on confidence in the digital economy, Article 335-2 of the Code of Intellectual Property and law &quot;and Freedoms&quot; of January 6, 1978 amended in 2004.</p>';

        $policy_fr = '<h1>Mentions L&eacute;gales</h1>

<h2>1. Pr&eacute;sentation de notre site web</h2>

<p>Conform&eacute;ment &agrave; la loi n&deg; 2004-2005 du 21 juin 2004 pour la confiance dans l&#39;&eacute;conomie num&eacute;rique, notre site web cr&eacute;&eacute; par <a href="http://directdev.fr">DirectDev.fr</a>, propri&eacute;taire du site <a href="http://directdev.fr">DirectDev</a>, met &agrave; disposition du public les informations concernant notre entreprise.<br />
Eventuellement modifiables, nous vous invitons donc &agrave; consulter nos mentions l&eacute;gales le plus souvent possible, de mani&egrave;re &agrave; en prendre connaissance fr&eacute;quemment</p>

<p>Le site <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> appartient &agrave; DirecDev, dont le si&egrave;ge social est situ&eacute; &agrave; l&#39;adresse suivante : Lille, France.</p>

<p><br />
Le site <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> est h&eacute;berg&eacute; par ovh, dont le si&egrave;ge social est localis&eacute; &agrave; l&#39;adresse suivante :<br />
2 rue Kellermann - 59100 Roubaix - France.</p>

<h2>2. Conditions g&eacute;n&eacute;rales d&rsquo;utilisation du site et des services propos&eacute;s.</h2>

<p>En utilisant notre site web <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a>, vous acceptez pleinement et enti&egrave;rement les conditions g&eacute;n&eacute;rales d&#39;utilisation pr&eacute;cis&eacute;es dans nos mentions l&eacute;gales. Accessible &agrave; tout type de visiteurs, il est important de pr&eacute;ciser toutefois qu&#39;une interruption pour maintenance du site web peut-&ecirc;tre d&eacute;cid&eacute;e par son propri&eacute;taire.</p>

<h2>3. Les produits ou services propos&eacute;s par <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a></h2>

<p>En accord avec sa politique de communication, le site <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> a pour vocation d&#39;informer les utilisateurs sur les &eacute;venements Salsa/Bachata/Kizomba/Tango. Cependant, des inexactitudes ou des omissions peuvent exister : la soci&eacute;t&eacute; ne pourra en aucun cas &ecirc;tre tenue pour responsable pour toute erreur pr&eacute;sente sur le site <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a>.</p>

<h2>4. Limitations contractuelles</h2>

<p>Les informations retranscrites sur notre site web <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> font l&rsquo;objet de d&eacute;marches qualitatives, en vue de nous assurer de leur fiabilit&eacute;. Cependant, nous ne pourrons encourir de responsabilit&eacute;s en cas d&rsquo;inexactitudes techniques lors de nos explications.<br />
Si vous constatez une erreur concernant des informations que nous auront pu omettre, n&rsquo;h&eacute;sitez pas &agrave; nous le signaler par mail &agrave; <a href="http://WeDanceSalsa.com/contact">WeDanceSalsa.com/contact</a>.</p>

<p>Les liens reli&eacute;s directement ou indirectement &agrave; notre site web <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> ne sont pas sous le contr&ocirc;le de notre soci&eacute;t&eacute;. Par cons&eacute;quent, nous ne pouvons nous assurer de l&rsquo;exactitude des informations pr&eacute;sentes sur ces autres sites Internet.</p>

<p>Utilisant la technologie JavaScript, le site <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> ne pourra &ecirc;tre tenu pour responsable en cas de dommages mat&eacute;riels li&eacute;s &agrave; son utilisation. Par ailleurs, toute autre type de cons&eacute;quence li&eacute;e &agrave; l&#39;exploitation du site <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a>, qu&#39;elle soit direct ou indirect (bug, incompatibilit&eacute;, virus, perte de march&eacute;, etc.).</p>

<h2>5. Propri&eacute;t&eacute; intellectuelle et contenu du site Internet</h2>

<p>Le contenu r&eacute;dactionnel du site web <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> appartient exclusivement &agrave; son propri&eacute;taire. Toute violation des droits d&rsquo;auteur est sanctionn&eacute;e par l&rsquo;article L.335-2 du Code de la Propri&eacute;t&eacute; Intellectuelle, avec une peine encourue de 2 ans d&rsquo;emprisonnement et de 150 000&euro; d&rsquo;amende</p>

<p>Le site <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> ne pourra &ecirc;tre mis en cause en cas de propos injurieux, &agrave; caract&egrave;re raciste, diffamant ou pornographique, &eacute;chang&eacute;s sur les espaces interactifs. La soci&eacute;t&eacute; se r&eacute;serve &eacute;galement le droit de supprimer tout contenu contraire aux valeurs de l&#39;entreprise ou &agrave; la l&eacute;gislation applicable en France.</p>

<p>En naviguant sur le site <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a>, l&#39;utilisateur accepte &eacute;galement l&#39;installation de cookies &eacute;ventuelle sur son ordinateur.</p>

<h2>6. Donn&eacute;es personnelles, respect de votre vie priv&eacute;e et de vos libert&eacute;s</h2>

<p>Toute informations recueillie sur le site web <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> se font dans le cadre des besoins li&eacute;s &agrave; l&#39;utilisation de notre plateforme, tels que le formulaire de profil utilisateur ou le formulaire d&#39;incription d&#39;&eacute;venements.</p>

<p>Conform&eacute;ment &agrave; la loi &laquo; informatique et libert&eacute;s &raquo; du 6 janvier 1978 modifi&eacute;e en 2004, l&rsquo;utilisateur b&eacute;n&eacute;ficie d&rsquo;un droit d&rsquo;acc&egrave;s et de rectification aux informations le concernant, droit qu&rsquo;il peut exercer &agrave; tout moment en adressant un mail via la page de contact : <a href="http://WeDanceSalsa.com/contact/fr">WeDanceSalsa.com/contact</a><br />
<br />
Les bases de donn&eacute;es sont prot&eacute;g&eacute;es par les dispositions de la loi du 1er juillet 1998 transposant la directive 96/9 du 11 mars 1996 relative &agrave; la protection juridique des bases de donn&eacute;es.</p>

<h2>7. Droit applicable et lois concern&eacute;es</h2>

<p>Soumis au droit fran&ccedil;ais, le site web <a href="http://WeDanceSalsa.com">WeDanceSalsa.com</a> est encadr&eacute; par la loi n&deg; 2004-2005 du 21 juin 2004 pour la confiance dans l&#39;&eacute;conomie num&eacute;rique, l&rsquo;article L.335-2 du Code de la Propri&eacute;t&eacute; Intellectuelle et la loi &laquo; informatique et libert&eacute;s &raquo; du 6 janvier 1978 modifi&eacute;e en 2004.</p>';

        $Page = new Page();
        $Page->setName('home');
        $Page->translate('en')->setTitle('WeDanceSalsa');
        $Page->translate('fr')->setTitle('WeDanceSalsa');
        $Page->translate('en')->setContent(null);
        $Page->translate('fr')->setContent(null);
        $Page->translate('en')->setDescription('Find all Salsa/Bachata/Kizomba/Tango events everywhere, anytime !');
        $Page->translate('fr')->setDescription('Trouvez tous les évenements Salsa/Bachata/Kizomba/Tango près de chez  vous !');
        $manager->persist($Page);
        $this->addReference('page-home', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city');
        $Page->translate('en')->setTitle('Find all salsa/Bachata/Kizomba/Tango events close to');
        $Page->translate('fr')->setTitle('Trouvez tous les événements Salsa/Bachanta/Kizomba/Tango proches de');
        $Page->translate('en')->setContent(null);
        $Page->translate('fr')->setContent(null);
        $Page->translate('en')->setDescription('Find all salsa/Bachata/Kizomba/Tango events close to');
        $Page->translate('fr')->setDescription('Trouvez tous les événements Salsa/Bachanta/Kizomba/Tango close to');
        $manager->persist($Page);
        $this->addReference('page-city', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('policy');
        $Page->translate('en')->setTitle('Privacy policy');
        $Page->translate('fr')->setTitle('Mentions Légales');
        $Page->translate('en')->setContent($policy_en);
        $Page->translate('fr')->setContent($policy_fr);
        $Page->translate('en')->setDescription('Privacy policy');
        $Page->translate('fr')->setDescription('Mentions Légales');
        $manager->persist($Page);
        $this->addReference('page-policy', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_calendar');
        $Page->translate('en')->setTitle('calendar');
        $Page->translate('fr')->setTitle('calendar');
        $Page->translate('en')->setContent(null);
        $Page->translate('fr')->setContent(null);
        $Page->translate('en')->setDescription('calendar');
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-calendar', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_dancers');
        $Page->translate('en')->setTitle('dancers');
        $Page->translate('fr')->setTitle('dancers');
        $Page->translate('en')->setContent(null);
        $Page->translate('fr')->setContent(null);
        $Page->translate('en')->setDescription('dancers');
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-dancers', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_teachers');
        $Page->translate('en')->setTitle('WeDanceSalsa');
        $Page->translate('fr')->setTitle('WeDanceSalsa');
        $Page->translate('en')->setContent(null);
        $Page->translate('fr')->setContent(null);
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-teachers', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_artists');
        $Page->translate('en')->setTitle('WeDanceSalsa');
        $Page->translate('fr')->setTitle('WeDanceSalsa');
        $Page->translate('en')->setContent(null);
        $Page->translate('fr')->setContent(null);
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-artists', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_bars');
        $Page->translate('en')->setTitle('WeDanceSalsa');
        $Page->translate('fr')->setTitle('WeDanceSalsa');
        $Page->translate('en')->setContent(null);
        $Page->translate('fr')->setContent(null);
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-bars', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_introductions');
        $Page->translate('en')->setTitle('WeDanceSalsa');
        $Page->translate('fr')->setTitle('WeDanceSalsa');
        $Page->translate('en')->setContent(null);
        $Page->translate('fr')->setContent(null);
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-introductions', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_shows');
        $Page->translate('en')->setTitle('WeDanceSalsa');
        $Page->translate('fr')->setTitle('WeDanceSalsa');
        $Page->translate('en')->setContent(null);
        $Page->translate('fr')->setContent(null);
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-shows', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_parties');
        $Page->translate('en')->setTitle('WeDanceSalsa');
        $Page->translate('fr')->setTitle('WeDanceSalsa');
        $Page->translate('en')->setContent(null);
        $Page->translate('fr')->setContent(null);
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-parties', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_festivals');
        $Page->translate('en')->setTitle('WeDanceSalsa');
        $Page->translate('fr')->setTitle('WeDanceSalsa');
        $Page->translate('en')->setContent(null);
        $Page->translate('fr')->setContent(null);
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-festivals', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_photos');
        $Page->translate('en')->setTitle('WeDanceSalsa');
        $Page->translate('fr')->setTitle('WeDanceSalsa');
        $Page->translate('en')->setContent(null);
        $Page->translate('fr')->setContent(null);
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-photos', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_musics');
        $Page->translate('en')->setTitle('WeDanceSalsa');
        $Page->translate('fr')->setTitle('WeDanceSalsa');
        $Page->translate('en')->setContent(null);
        $Page->translate('fr')->setContent(null);
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-musics', $Page);
        $Page->mergeNewTranslations();

        $Page = new Page();
        $Page->setName('city_videos');
        $Page->translate('en')->setTitle('WeDanceSalsa');
        $Page->translate('fr')->setTitle('WeDanceSalsa');
        $Page->translate('en')->setContent(null);
        $Page->translate('fr')->setContent(null);
        $Page->translate('en')->setDescription(null);
        $Page->translate('fr')->setDescription(null);
        $manager->persist($Page);
        $this->addReference('page-videos', $Page);
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
