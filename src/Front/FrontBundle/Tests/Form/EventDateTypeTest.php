<?php

namespace Front\FrontBundle\Tests\Form;

use Front\FrontBundle\Form\EventDateType;
use Front\FrontBundle\Entity\EventDate;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\PreloadedExtension;

/**
 * @IgnoreAnnotation("dataProvider")
 */
class EventDateTypeTest extends TypeTestCase {

    /**
     * @dataProvider getValidTestData
     */
    public function testSubmitValidData($formData) {

        $type = new EventDateType();
        $form = $this->factory->create($type);

        $object = new EventDate();
//        foreach ($formData as $key => $value)
//            $object->{"set" . ucfirst($key)}($value);
        $object->setStartdate($formData['startdate']);
        $object->setStarttime($formData['starttime']);
        $object->setStopdate($formData['stopdate']);
        $object->setStoptime($formData['stoptime']);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
//        $this->assertEquals($object, $form->getData());


        $this->assertEquals($object->getStartdate(), $form->getData()->getStartdate()->format('Y-m-d'));
        $this->assertEquals($object->getStarttime(), $form->getData()->getStarttime());
        if ($form->getData()->getStopdate())
            $this->assertEquals($object->getStopdate(), $form->getData()->getStopdate()->format('Y-m-d'));


        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

    public function getValidTestData() {
        return array(
            array(
                'formData' => array(
                    'startdate' => '2012-12-31',
                    'starttime' => '',
                    'stopdate' => '',
                    'stoptime' => '',
                ),
            ),
            array(
                'formData' => array(
                    'startdate' => '2012-12-31',
                    'starttime' => '',
                    'stopdate' => '2014-12-31',
                    'stoptime' => '',
                ),
            ),
        );
    }

}
