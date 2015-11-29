<?php

namespace Ak\PollBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * QuestionDefinition
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ak\PollBundle\Entity\QuestionDefinitionRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="definition_type", type="string")
 * @ORM\DiscriminatorMap({
 *   "open" = "QuestionDefinitionOpen",
 *   "single_choice" = "QuestionDefinitionSingleChoice",
 *   "multiple_choice" = "QuestionDefinitionMultipleChoice",
 *   "restricted_choice" = "QuestionDefinitionRestrictedChoice",
 *   "choice" = "QuestionDefinitionChoice"
 * })
 */
abstract class QuestionDefinition
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="text")
     */
    protected $question;

    /**
     * @var PollDefinition
     *
     * @ORM\ManyToOne(targetEntity="PollDefinition", inversedBy="questionsDefinitions")
     * @ORM\JoinColumn(name="poll_definition_id", referencedColumnName="id")
     */
    protected $pollDefinition;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set question
     *
     * @param string $question
     *
     * @return QuestionDefinition
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @return PollDefinition
     */
    public function getPollDefinition()
    {
        return $this->pollDefinition;
    }

    /**
     * @param PollDefinition $pollDefinition
     */
    public function setPollDefinition($pollDefinition)
    {
        $this->pollDefinition = $pollDefinition;
    }

    /**
     * @return ArrayCollection
     */
    abstract public function getOptionDefinitions();

}

