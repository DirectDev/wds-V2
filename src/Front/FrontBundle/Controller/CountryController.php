<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Front\FrontBundle\Entity\Country;
use Front\FrontBundle\Form\CountryType;

/**
 * Country controller.
 *
 */
class CountryController extends Controller
{

//    /**
//     * Lists all Country entities.
//     *
//     */
//    public function indexAction()
//    {
//        $em = $this->getDoctrine()->getManager();
//        
//        $list = 'AF|Afghanistan;;
//AL|Albania;;
//DZ|Algeria;;
//AS|American Samoa;;
//AD|Andorra;;
//AO|Angola;;
//AI|Anguilla;;
//AQ|Antarctica;;
//AG|Antigua And Barbuda;;
//AR|Argentina;;
//AM|Armenia;;
//AW|Aruba;;
//AU|Australia;;
//AT|Austria;;
//AZ|Azerbaijan;;
//BS|Bahamas;;
//BH|Bahrain;;
//BD|Bangladesh;;
//BB|Barbados;;
//BY|Belarus;;
//BE|Belgium;;
//BZ|Belize;;
//BJ|Benin;;
//BM|Bermuda;;
//BT|Bhutan;;
//BO|Bolivia;;
//BA|Bosnia And Herzegovina;;
//BW|Botswana;;
//BV|Bouvet Island;;
//BR|Brazil;;
//IO|British Indian Ocean Territory;;
//BN|Brunei Darussalam;;
//BG|Bulgaria;;
//BF|Burkina Faso;;
//BI|Burundi;;
//KH|Cambodia;;
//CM|Cameroon;;
//CA|Canada;;
//CV|Cape Verde;;
//KY|Cayman Islands;;
//CF|Central African Republic;;
//TD|Chad;;
//CL|Chile;;
//CN|China;;
//CX|Christmas Island;;
//CC|Cocos (keeling) Islands;;
//CO|Colombia;;
//KM|Comoros;;
//CG|Congo;;
//CD|Congo, The Democratic Republic Of The;;
//CK|Cook Islands;;
//CR|Costa Rica;;
//CI|Cote D\'ivoire;;
//HR|Croatia;;
//CU|Cuba;;
//CY|Cyprus;;
//CZ|Czech Republic;;
//DK|Denmark;;
//DJ|Djibouti;;
//DM|Dominica;;
//DO|Dominican Republic;;
//TP|East Timor;;
//EC|Ecuador;;
//EG|Egypt;;
//SV|El Salvador;;
//GQ|Equatorial Guinea;;
//ER|Eritrea;;
//EE|Estonia;;
//ET|Ethiopia;;
//FK|Falkland Islands (malvinas);;
//FO|Faroe Islands;;
//FJ|Fiji;;
//FI|Finland;;
//FR|France;;
//GF|French Guiana;;
//PF|French Polynesia;;
//TF|French Southern Territories;;
//GA|Gabon;;
//GM|Gambia;;
//GE|Georgia;;
//DE|Germany;;
//GH|Ghana;;
//GI|Gibraltar;;
//GR|Greece;;
//GL|Greenland;;
//GD|Grenada;;
//GP|Guadeloupe;;
//GU|Guam;;
//GT|Guatemala;;
//GN|Guinea;;
//GW|Guinea-bissau;;
//GY|Guyana;;
//HT|Haiti;;
//HM|Heard Island And Mcdonald Islands;;
//VA|Holy See (vatican City State);;
//HN|Honduras;;
//HK|Hong Kong;;
//HU|Hungary;;
//IS|Iceland;;
//IN|India;;
//ID|Indonesia;;
//IR|Iran, Islamic Republic Of;;
//IQ|Iraq;;
//IE|Ireland;;
//IL|Israel;;
//IT|Italy;;
//JM|Jamaica;;
//JP|Japan;;
//JO|Jordan;;
//KZ|Kazakstan;;
//KE|Kenya;;
//KI|Kiribati;;
//KP|Korea, Democratic People\'s Republic Of;;
//KR|Korea, Republic Of;;
//KV|Kosovo;;
//KW|Kuwait;;
//KG|Kyrgyzstan;;
//LA|Lao People\'s Democratic Republic;;
//LV|Latvia;;
//LB|Lebanon;;
//LS|Lesotho;;
//LR|Liberia;;
//LY|Libyan Arab Jamahiriya;;
//LI|Liechtenstein;;
//LT|Lithuania;;
//LU|Luxembourg;;
//MO|Macau;;
//MK|Macedonia, The Former Yugoslav Republic Of;;
//MG|Madagascar;;
//MW|Malawi;;
//MY|Malaysia;;
//MV|Maldives;;
//ML|Mali;;
//MT|Malta;;
//MH|Marshall Islands;;
//MQ|Martinique;;
//MR|Mauritania;;
//MU|Mauritius;;
//YT|Mayotte;;
//MX|Mexico;;
//FM|Micronesia, Federated States Of;;
//MD|Moldova, Republic Of;;
//MC|Monaco;;
//MN|Mongolia;;
//MS|Montserrat;;
//ME|Montenegro;;
//MA|Morocco;;
//MZ|Mozambique;;
//MM|Myanmar;;
//NA|Namibia;;
//NR|Nauru;;
//NP|Nepal;;
//NL|Netherlands;;
//AN|Netherlands Antilles;;
//NC|New Caledonia;;
//NZ|New Zealand;;
//NI|Nicaragua;;
//NE|Niger;;
//NG|Nigeria;;
//NU|Niue;;
//NF|Norfolk Island;;
//MP|Northern Mariana Islands;;
//NO|Norway;;
//OM|Oman;;
//PK|Pakistan;;
//PW|Palau;;
//PS|Palestinian Territory, Occupied;;
//PA|Panama;;
//PG|Papua New Guinea;;
//PY|Paraguay;;
//PE|Peru;;
//PH|Philippines;;
//PN|Pitcairn;;
//PL|Poland;;
//PT|Portugal;;
//PR|Puerto Rico;;
//QA|Qatar;;
//RE|Reunion;;
//RO|Romania;;
//RU|Russian Federation;;
//RW|Rwanda;;
//SH|Saint Helena;;
//KN|Saint Kitts And Nevis;;
//LC|Saint Lucia;;
//PM|Saint Pierre And Miquelon;;
//VC|Saint Vincent And The Grenadines;;
//WS|Samoa;;
//SM|San Marino;;
//ST|Sao Tome And Principe;;
//SA|Saudi Arabia;;
//SN|Senegal;;
//RS|Serbia;;
//SC|Seychelles;;
//SL|Sierra Leone;;
//SG|Singapore;;
//SK|Slovakia;;
//SI|Slovenia;;
//SB|Solomon Islands;;
//SO|Somalia;;
//ZA|South Africa;;
//GS|South Georgia And The South Sandwich Islands;;
//ES|Spain;;
//LK|Sri Lanka;;
//SD|Sudan;;
//SR|Suriname;;
//SJ|Svalbard And Jan Mayen;;
//SZ|Swaziland;;
//SE|Sweden;;
//CH|Switzerland;;
//SY|Syrian Arab Republic;;
//TW|Taiwan, Province Of China;;
//TJ|Tajikistan;;
//TZ|Tanzania, United Republic Of;;
//TH|Thailand;;
//TG|Togo;;
//TK|Tokelau;;
//TO|Tonga;;
//TT|Trinidad And Tobago;;
//TN|Tunisia;;
//TR|Turkey;;
//TM|Turkmenistan;;
//TC|Turks And Caicos Islands;;
//TV|Tuvalu;;
//UG|Uganda;;
//UA|Ukraine;;
//AE|United Arab Emirates;;
//GB|United Kingdom;;
//US|United States;;
//UM|United States Minor Outlying Islands;;
//UY|Uruguay;;
//UZ|Uzbekistan;;
//VU|Vanuatu;;
//VE|Venezuela;;
//VN|Viet Nam;;
//VG|Virgin Islands, British;;
//VI|Virgin Islands, U.s.;;
//WF|Wallis And Futuna;;
//EH|Western Sahara;;
//YE|Yemen;;
//ZM|Zambia;;
//ZW|Zimbabwe';
//echo '<pre>';
//$list = explode(";;",$list);
//var_dump(count($list));
//foreach($list as $list2){
//    $array = explode('|',$list2);
//    var_dump($array[1]);
//    var_dump(strtolower(trim($array[0])));
////    $country = new Country();
////    $country->setName($array[1])
////            ->setIso2(strtolower(trim($array[0])));
////   $country->translate('fr')->setTitle($array[1]);
////   $country->translate('en')->setTitle($array[1]);
////            $em->persist($country);
//
//    $country->mergeNewTranslations();
//}
////print_r($list3,false);
//$em->flush();
//
//        $entities = $em->getRepository('FrontFrontBundle:Country')->findAll();
//
//        return $this->render('FrontFrontBundle:Country:index.html.twig', array(
//            'entities' => $entities,
//        ));
//    }
//    /**
//     * Creates a new Country entity.
//     *
//     */
//    public function createAction(Request $request)
//    {
//        $entity = new Country();
//        $form = $this->createCreateForm($entity);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($entity);
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('front_country_show', array('id' => $entity->getId())));
//        }
//
//        return $this->render('FrontFrontBundle:Country:new.html.twig', array(
//            'entity' => $entity,
//            'form'   => $form->createView(),
//        ));
//    }
//
//    /**
//     * Creates a form to create a Country entity.
//     *
//     * @param Country $entity The entity
//     *
//     * @return \Symfony\Component\Form\Form The form
//     */
//    private function createCreateForm(Country $entity)
//    {
//        $form = $this->createForm(new CountryType(), $entity, array(
//            'action' => $this->generateUrl('front_country_create'),
//            'method' => 'POST',
//        ));
//
//        $form->add('submit', 'submit', array('label' => 'Create'));
//
//        return $form;
//    }
//
//    /**
//     * Displays a form to create a new Country entity.
//     *
//     */
//    public function newAction()
//    {
//        $entity = new Country();
//        $form   = $this->createCreateForm($entity);
//
//        return $this->render('FrontFrontBundle:Country:new.html.twig', array(
//            'entity' => $entity,
//            'form'   => $form->createView(),
//        ));
//    }
//
//    /**
//     * Finds and displays a Country entity.
//     *
//     */
//    public function showAction($id)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('FrontFrontBundle:Country')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Country entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('FrontFrontBundle:Country:show.html.twig', array(
//            'entity'      => $entity,
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }
//
//    /**
//     * Displays a form to edit an existing Country entity.
//     *
//     */
//    public function editAction($id)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('FrontFrontBundle:Country')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Country entity.');
//        }
//
//        $editForm = $this->createEditForm($entity);
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('FrontFrontBundle:Country:edit.html.twig', array(
//            'entity'      => $entity,
//            'edit_form'   => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }
//
//    /**
//    * Creates a form to edit a Country entity.
//    *
//    * @param Country $entity The entity
//    *
//    * @return \Symfony\Component\Form\Form The form
//    */
//    private function createEditForm(Country $entity)
//    {
//        $form = $this->createForm(new CountryType(), $entity, array(
//            'action' => $this->generateUrl('front_country_update', array('id' => $entity->getId())),
//            'method' => 'PUT',
//        ));
//
//        $form->add('submit', 'submit', array('label' => 'Update'));
//
//        return $form;
//    }
//    /**
//     * Edits an existing Country entity.
//     *
//     */
//    public function updateAction(Request $request, $id)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('FrontFrontBundle:Country')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Country entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//        $editForm = $this->createEditForm($entity);
//        $editForm->handleRequest($request);
//
//        if ($editForm->isValid()) {
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('front_country_edit', array('id' => $id)));
//        }
//
//        return $this->render('FrontFrontBundle:Country:edit.html.twig', array(
//            'entity'      => $entity,
//            'edit_form'   => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }
//    /**
//     * Deletes a Country entity.
//     *
//     */
//    public function deleteAction(Request $request, $id)
//    {
//        $form = $this->createDeleteForm($id);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $entity = $em->getRepository('FrontFrontBundle:Country')->find($id);
//
//            if (!$entity) {
//                throw $this->createNotFoundException('Unable to find Country entity.');
//            }
//
//            $em->remove($entity);
//            $em->flush();
//        }
//
//        return $this->redirect($this->generateUrl('front_country'));
//    }
//
//    /**
//     * Creates a form to delete a Country entity by id.
//     *
//     * @param mixed $id The entity id
//     *
//     * @return \Symfony\Component\Form\Form The form
//     */
//    private function createDeleteForm($id)
//    {
//        return $this->createFormBuilder()
//            ->setAction($this->generateUrl('front_country_delete', array('id' => $id)))
//            ->setMethod('DELETE')
//            ->add('submit', 'submit', array('label' => 'Delete'))
//            ->getForm()
//        ;
//    }
}
