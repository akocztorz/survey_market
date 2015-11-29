<?php

namespace Ak\PollBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * QuestionDefinition
 *
 * @ORM\Entity()
 */
abstract class QuestionDefinitionChoice extends QuestionDefinition
{
    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="OptionDefinitionChoice", mappedBy="questionDefinitionChoice", cascade={"persist"})
     */
    protected $optionsDefinitionsChoice;

    /**
     * @var int|null
     *
     * @ORM\Column(name="max_choices", type="integer", nullable=true)
     */
    protected $maxChoices = null;


    /**
     *
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

