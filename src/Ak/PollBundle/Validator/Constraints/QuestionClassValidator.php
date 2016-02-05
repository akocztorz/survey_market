<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 04.01.16
 * Time: 10:44
 */

namespace Ak\PollBundle\Validator\Constraints;


use Ak\PollBundle\Entity\Answer;
use Ak\PollBundle\Entity\OptionDefinition;
use Ak\PollBundle\Entity\OptionDefinitionChoice;
use Ak\PollBundle\Entity\QuestionDefinitionChoice;
use Ak\PollBundle\Entity\QuestionDefinitionMultipleChoice;
use Ak\PollBundle\Entity\QuestionDefinitionOpen;
use Ak\PollBundle\Entity\QuestionDefinitionSingleChoice;
use Ak\PollBundle\Form\Data\Question;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


/**
 * validates the data coming from the Question form
 * Class QuestionClassValidator
 * @package Ak\PollBundle\Validator\Constraints
 */
class QuestionClassValidator extends ConstraintValidator
{
    /**
     * Checks if the passed value is valid.
     *
     * @param Question $question
     * @param Constraint $constraint The constraint for the validation
     * @internal param Question $question The value that should be validated
     */
    public function validate($question, Constraint $constraint)
    {
//        if(!$this->freeTextNotEmpty($question)) {
//            $this->context->buildViolation($constraint->message)
//                ->atPath('answer')
//                ->addViolation();
//        }

        if(!$this->freeTextNotEmpty($question) || !$this->correctAnswersNumber($question) ) {
            $this->context->buildViolation($constraint->message)
                ->atPath('answer')
                ->addViolation();
        }

    }

    /**
     * checks if the freeText field is not empty
     * @param Question $question
     * @return bool
     */
    public function freeTextNotEmpty($question)
    {
        $optionDefinitions = $question->getQuestionDefinition()->getOptionDefinitions();
        $answers = $question->getPoll()->getAnswers();

        if($question->getQuestionDefinition() instanceof QuestionDefinitionOpen )
        {
            foreach($optionDefinitions as $optionDefinition) {
                /** @var Answer $answer */
                foreach($answers as $answer) {
                    if($answer->getOptionDefinition()->getId() == $optionDefinition->getId() && $answer->getFreeText() == null ) {
                        return false;
                    }
                }
            }
        }
        else {
            /** @var OptionDefinitionChoice $optionDefinition */
            foreach($optionDefinitions as $optionDefinition) {
                /** @var Answer $answer */
                foreach($answers as $answer) {
                    if($answer->getOptionDefinition()->getId() == $optionDefinition->getId()
                        && $answer->getChecked()
                        && $optionDefinition->isFreeText()
                        && $answer->getFreeText() == null ) {
                        return false;
                    }
                }
            }
        }
        return true;
    }

    /**
     * checks if correct number of options has been checked
     * @param Question $question
     * @return bool
     */
    public function correctAnswersNumber($question)
    {
        $answersCount = $this->countAnswers($question);

        if($question->getQuestionDefinition() instanceof QuestionDefinitionChoice) {
            if($answersCount < 1) {
                return false;
            }

            if($question->getQuestionDefinition() instanceof QuestionDefinitionSingleChoice) {
                if($answersCount > 1) {
                    return false;
                }
            }
            elseif($question->getQuestionDefinition() instanceof QuestionDefinitionMultipleChoice) {
                $optionDefinitionsCount = $question->getQuestionDefinition()->getOptionDefinitions()->count();
                if($answersCount > $optionDefinitionsCount) {
                    return false;
                }
            }
            else {
                $maxChoices = $question->getQuestionDefinition()->getMaxChoices();
                if($answersCount > $maxChoices){
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * returns answers count given in the form
     * @param Question $question
     * @return int
     */
    public function countAnswers($question)
    {
        $optionDefinitions = $question->getQuestionDefinition()->getOptionDefinitions();
        $answers = $question->getPoll()->getAnswers();
        $answersCount = 0;

            foreach($optionDefinitions as $optionDefinition) {
                /** @var Answer $answer */
                foreach ($answers as $answer) {
                    if ($answer->getOptionDefinition()->getId() == $optionDefinition->getId() && $answer->getChecked()) {
                        $answersCount+=1;
                    }
                }
            }

        return $answersCount;
    }

}