<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 04.01.16
 * Time: 10:41
 */

namespace Ak\PollBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/** Deal Validation Class
 * @Annotation
 */
class DealClass extends Constraint
{
    /**
     * error message
     * @var string
     */
    public $message0 = 'akceptowana ilość ankiet nie może być mniejsza od minimalnej ilości ani większa od zamawianej ilości określonej w ofercie';
    /**
     * error message
     * @var string
     */
    public $message1 = 'zaakceptowana ilość musi pozwolić następnemu użytkownikowi na zaakceptowanie conajmniej minimalnej ilości';
    /**
     * error message
     * @var string
     */
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