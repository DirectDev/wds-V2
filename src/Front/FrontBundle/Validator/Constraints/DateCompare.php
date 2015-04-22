<?php

namespace Front\FrontBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DateCompare extends Constraint {

    public $message = 'Date Error';

    public function getTargets() {
        return self::CLASS_CONSTRAINT;
    }

    public function validatedBy() {
        return 'datecompare_validator';
    }

}