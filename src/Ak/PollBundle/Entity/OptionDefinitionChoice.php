<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 29.10.15
 * Time: 21:05
 */

namespace Ak\PollBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\DocBlock\Tag\ReturnTag;
use Symfony\Component\Form\Tests\Extension\Core\Type\RepeatedTypeTest;

/**
 * OptionDefinitionOpen - represents option_definition table in database, represents records for questions with predefined answers
 *
 * @ORM\Entity()
 */
class OptionDefinitionChoice extends OptionDefinition
{
    /**
     * stores question definition id
     * @var QuestionDefinitionChoice
     *
     * @ORM\ManyToOne(targetEntity="QuestionDefinitionChoice", inversedBy="optionsDefinitionsChoice")
     * @ORM\JoinColumn(name="question_definition_choice_id", referencedColumnName="id")
     */
    protected $questionDefinitionChoice;


    /**
     * @return QuestionDefinitionChoice
     */
    public function getQuestionDefinitionChoice()
    {
        return $this->questionDefinitionChoice;
    }

    /**
     * @param QuestionDefinitionChoice $questionDefinitionChoice
     */
    public function setQuestionDefinitionChoice($questionDefinitionChoice)
    {
        $this->questionDefinitionChoice = $questionDefinitionChoice;
    }

    /**
     * @return QuestionDefinition
     */
    public function getQuestionDefinition()
    {
        return $this->getQuestionDefinitionChoice();
    }

    /**
     * @param $questionDefinition
     * @internal param QuestionDefinitionChoice $questionDefinitionChoice
     */
    public function setQuestionDefinition($questionDefinition)
    {
        $this->setQuestionDefinitionChoice($questionDefinition);
    }

}