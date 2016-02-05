<?php

namespace Ak\PollBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * QuestionDefinition - represents question_definition table for questions with predefined answers
 *
 * @ORM\Entity()
 *
 */
abstract class QuestionDefinitionChoice extends QuestionDefinition
{
    /**
     * stores option definition ids
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="OptionDefinitionChoice", mappedBy="questionDefinitionChoice", cascade={"persist"})
     */
    protected $optionsDefinitionsChoice;

    /**
     * stores information about maximum number of choices the respondent can choose
     * @var int|null
     *
     * @ORM\Column(name="max_choices", type="integer", nullable=true)
     */
    protected $maxChoices = null;


    /**
     * constructor - initializes optionDefinitionChoice collection
     */
    public function __construct()
    {
        $this->optionsDefinitionsChoice = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getOptionsDefinitionsChoice()
    {
        return $this->optionsDefinitionsChoice;
    }

    /**
     * @param ArrayCollection $optionsDefinitionsChoice
     */
    public function setOptionsDefinitionsChoice($optionsDefinitionsChoice)
    {
        $this->optionsDefinitionsChoice = $optionsDefinitionsChoice;
    }

    /**
     * @return int|null
     */
    public function getMaxChoices()
    {
        return $this->maxChoices;
    }

    /**
     * @param int|null $maxChoices
     */
    public function setMaxChoices($maxChoices = null)
    {
        $this->maxChoices = $maxChoices;
    }

    /**
     * @return ArrayCollection
     */
    public function getOptionDefinitions()
    {
        return $this->getOptionsDefinitionsChoice();
    }

}

