<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 04.01.16
 * Time: 10:44
 */

namespace Ak\PollBundle\Validator\Constraints;


use Ak\PollBundle\Entity\Deal;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;




/**
 * Class DealClassValidator
 * @package Ak\PollBundle\Validator\Constraints
 */class DealClassValidator extends ConstraintValidator
{
    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $deal
     * @param Constraint $constraint The constraint for the validation
     * @internal param Question $question
     * @internal param Question $question The value that should be validated
     */
    public function validate($deal, Constraint $constraint)
    {

        if($deal->getQuantity() < $deal->getOffer()->getMinQuantity() || $deal->getQuantity() > $deal->getOffer()->getQuantity()){
            $this->context->buildViolation($constraint->message0)
                ->atPath('offer_accept')
                ->addViolation();
        }

        if($deal->getOffer()->getQuantity() - $deal->getOffer()->getMinQuantity() < $deal->getOffer()->getMinQuantity() ){
            if($deal->getQuantity() < $deal->getOffer()->getQuantity()){
                $this->context->buildViolation($constraint->message2)
                    ->atPath('offer_accept')
                    ->addViolation();
            }
        }
        elseif($deal->getQuantity() > ($deal->getOffer()->getQuantity() - $deal->getOffer()->getMinQuantity())){
            $this->context->buildViolation($constraint->message1)
                ->atPath('offer_accept')
                ->addViolation();
        }


    }



}