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

/**
 * OptionDefinitionOpen
 *
 * @ORM\Entity()
 */
class OptionDefinitionOpen extends OptionDefinition
{
    /**
     * @var QuestionDefinition
     *
     * @ORM\OneToOne(targetEntity="QuestionDefinitionOpen", inversedBy="optionDefinitionOpen")
     * @ORM\JoinColumn(name="question_definition_open_id", referencedColumnName="id")
     */
    protected $questionDefinitionOpen;

    /**
     * @return QuestionDefinition
     */
    public function getQuestionDefinitionOpen()
    {
        return $this->questionDefinitionOpen;
    }

    /**
     * @param QuestionDefinition $questionDefinitionOpen
     */
    public function setQuestionDefinitionOpen($questionDefinitionOpen)
    {
        $this->questionDefinitionOpen = $questionDefinitionOpen;
    }

    /**
     * @return QuestionDefinition
     */
    public function getQuestionDefinition()
    {
        return $this->getQuestionDefinitionOpen();
    }

    /**
     * @param $questionDefinition
     * @internal param QuestionDefinition $questionDefinitionOpen
     */
    public function setQuestionDefinition($questionDefinition)
    {
        $this->setQuestionDefinitionOpen($questionDefinition);
    }


}