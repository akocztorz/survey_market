<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 04.01.16
 * Time: 10:41
 */

namespace Ak\PollBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DealClass extends Constraint
{
    public $message0 = 'akceptowana ilość ankiet nie może być mniejsza od minimalnej ilości ani większa od zamawianej ilości określonej w ofercie';
    public $message1 = 'zaakceptowana ilość musi pozwolić następnemu użytkownikowi na zaakceptowanie conajmniej minimalnej ilości';
    public $message2 = 'wszystkie pozostałe ankiety muszą zostać zaakceptowane' ;


    /**
     * Returns whether the constraint can be put onto classes, properties or
     * both.
     *
     * This method should return one or more of the constants
     * Constraint::CLASS_CONSTRAINT and Constraint::PROPERTY_CONSTRAINT.
     *
     * @return string|array One or more constant values
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    /**
     * Returns the name of the class that validates this constraint.
     *
     * By default, this is the fully qualified name of the constraint class
     * suffixed with "Validator". You can override this method to change that
     * behaviour.
     *
     * @return string
     */
    public function validatedBy()
    {
        return 'deal_validator';
    }

}