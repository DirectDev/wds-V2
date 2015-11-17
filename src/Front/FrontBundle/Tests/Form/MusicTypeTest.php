<?php

namespace Front\FrontBundle\Tests\Form;

use Front\FrontBundle\Form\MusicType;
use Front\FrontBundle\Entity\Music;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\PreloadedExtension;

/**
 * @IgnoreAnnotation("dataProvider")
 */
class MusicTypeTest extends TypeTestCase {

    /**
     * @dataProvider getValidTestData
     */
    public function testSubmitValidData($formData) {

        $type = new MusicType();
        $form = $this->factory->create($type);

        $object = new Music();
//        foreach ($formData as $key => $value)
//            $object->{"set" . ucfirst($key)}($value);
        $object->setUrl($formData['url']);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $form->getData());

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
                    'url' => 'https://open.spotify.com/track/7CsYHK2xk1n71pJr9geL1t',
                ),
            ),
            array(
                'formData' => array(
                    'url' => 'https://soundcloud.com/salsard/roby-peralta-yo-quiero-amarte-salsardcom2015',
                ),
            ),
        );
    }

}
