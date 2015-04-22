<?php
namespace Front\FrontBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


class DateCompareValidator extends ConstraintValidator {

    public function validate($entity, Constraint $constraint) {

        if ($entity->getStopDate() !== null) {
            if ($entity->getStartDate() > $entity->getStopDate()) {
                $this->context->addViolation($constraint->message);
                return false;
            }
        }
        return true;
    }

}
