<?php

namespace Admin\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Admin\AdminBundle\Entity\Page;
use Admin\AdminBundle\Entity\PageContent;

class LoadContentPageData extends AbstractFixture implements OrderedFixtureInterface {

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

        $PageContent = new PageContent();
        $PageContent->setPage($this->getReference('page-policy'));
        $PageContent->setPosition(1);
        $PageContent->translate('en')->setContent($policy_en);
        $PageContent->translate('fr')->setContent($policy_fr);
        $manager->persist($PageContent);
        $PageContent->mergeNewTranslations();

        $salsa_h1_en = 'The Salsa';
        $salsa_h1_fr = 'La Salsa';
        $salsa_en = 'Salsa music is a general term referring to a genre that is essentially Cuban and Puerto Rican popular dance music. The term salsa was initially promoted and marketed in New York City during the 1970s. Salsa comprises various musical genres including the Cuban son montuno, guaracha, chachachá, mambo, and to a certain extent bolero. Salsa is the product of genres such as the Puerto Rican bomba and plena. Latin jazz, which was also developed in New York City, has had a significant influence on salsa arrangers, piano guajeos, and instrumental soloists.';
        $salsa_fr = 'La salsa (mot espagnol qui signifie « sauce » et, au sens figuré, charme, piquant) désigne à la fois un genre musical et une danse ayant des racines cubaines. Cette musique de danse au tempo vif est popularisée dans le monde entier.Les instruments utilisés dans la salsa sont le résultat de plusieurs siècles d’innovation et de développement. Comme les cultures autochtones ont été virtuellement détruites par les colonisateurs européens, il reste peu de preuves de leurs contributions musicales. Certains termes et instruments ont cependant survécu.
Un musicien (ou chanteur) ou bien danseur de salsa est appelé salsero (salsera au féminin).';

        $PageContent = new PageContent();
        $PageContent->setPage($this->getReference('page-dance-salsa'));
        $PageContent->setPosition(1);
        $PageContent->translate('en')->setContent($salsa_h1_en);
        $PageContent->translate('fr')->setContent($salsa_h1_fr);
        $manager->persist($PageContent);
        $PageContent->mergeNewTranslations();

        $PageContent = new PageContent();
        $PageContent->setPage($this->getReference('page-dance-salsa'));
        $PageContent->setPosition(2);
        $PageContent->translate('en')->setContent($salsa_en);
        $PageContent->translate('fr')->setContent($salsa_fr);
        $manager->persist($PageContent);
        $PageContent->mergeNewTranslations();

        $salsa_cubana_h1_en = 'The Salsa';
        $salsa_cubana_h1_fr = 'La Salsa';
        $salsa_cubana_en = "In Cuba, a popular dance known as Casino was marketed as Cuban-style salsa or Salsa Cubana abroad to distinguish it from other salsa styles when the name was popularized in the 70's. Casino is popular in many places around the world, including in Europe, Latin America, North America, and even in some countries in the Middle East such as Israel. Dancing Casino is an expression of popular social culture; Cubans consider casino as part of social and cultural activities centering on their popular music. The name Casino is derived from the Spanish term for the dance halls, 'Casinos Deportivos' where a lot of social dancing was done among the better off, white Cubans during the mid-20th century and onward.
Hzstorically, Casino traces its origin as a partner dance from Cuban Son, Cha Cha Cha, Danzon and Guaracha. Traditionally, Casino is danced 'a contratiempo'. This means that, distinct from subsequent forms of salsa, no step is taken on the first and fifth beats in each clave pattern and the fourth and eighth beat are emphasised. In this way, rather than following a beat, the dancers themselves contribute in their movement, to the polyrythmic pattern of the music. At the same time, it is often danced 'a tiempo', although both 'on3' (originally) and 'on1' (nowadays).
What gives the dance its life, however, is not its mechanical technique, but understanding and spontaneous use of the rich Afro-Cuban dance vocabulary within a 'Casino' dance. In the same way that a 'sonero' (lead singer in Son and salsa bands) will 'quote' other, older songs in their own, a 'casino' dancer will frequently improvise references to other dances, integrating movements, gestures and extended passages from the folkloric and popular heritage. This is particularly true of African descended Cubans. Such improvisations might include extracts of rumba, dances for African deities, the older popular dances such as Cha Cha Cha and Danzon as well as anything the dancer may feel.";
        $salsa_cubana_fr = "Le style cubain vient de la danse casino des années 1950, telle que pratiquée dans les chorégraphies du Tropicana, fameux club de La Havane, et prend ses racines dans le son cubain : très africain, « dans le sol », les gestes sont économisés -- on peut le danser dans des endroits bondés --, les passes épurées, il ny a pas de jeux de jambes. Le couple se déplace essentiellement en décrivant des cercles successifs. C'est avant tout une danse de la rue, populaire, sociale. Il se danse normalement sur le temps « 1 », , au contraire du son cubain traditionnel où le « 1 », est suggéré par une mise en suspension du corps.
La rueda de casino, une variante de ce style, consiste en des rondes (rueda) de couples où un meneur (la madre) annonce les passes à venir. Tous les danseurs effectuent ces passes en même temps, de sorte que les danseurs changent fréquemment de partenaire.";

        $PageContent = new PageContent();
        $PageContent->setPage($this->getReference('page-dance-salsa-cubana'));
        $PageContent->setPosition(1);
        $PageContent->translate('en')->setContent($salsa_cubana_h1_en);
        $PageContent->translate('fr')->setContent($salsa_cubana_h1_fr);
        $manager->persist($PageContent);
        $PageContent->mergeNewTranslations();

        $PageContent = new PageContent();
        $PageContent->setPage($this->getReference('page-dance-salsa-cubana'));
        $PageContent->setPosition(2);
        $PageContent->translate('en')->setContent($salsa_cubana_en);
        $PageContent->translate('fr')->setContent($salsa_cubana_fr);
        $manager->persist($PageContent);
        $PageContent->mergeNewTranslations();

        $share_event = " Partagez vos événements<br>
                Pourquoi ?<br>
                vos évenements (soirées, cours, festivals, etc.. apparaitrons dans les recherches <br>
                vous aurrez plus de danseurs présents<br>
                gagner en visibilité<br>
                vous faire connaitre et améliorer votre notoriété<br>

                Comment ?<br>
                méthode 1<br>
                inscrivez-vous /  connectez-vous<br>
                cliquez sur ajouter un évenement<br>
                méthode 2<br>
                connectez-vous avec Facebook<br>
                cliquez sur importez vos événements FB<br>
        ";
        $PageContent = new PageContent();
        $PageContent->setPage($this->getReference('page-landing-share-event'));
        $PageContent->setPosition(1);
        $PageContent->translate('en')->setContent($share_event);
        $PageContent->translate('fr')->setContent($share_event);
        $manager->persist($PageContent);
        $PageContent->mergeNewTranslations();

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 2;
    }

}
