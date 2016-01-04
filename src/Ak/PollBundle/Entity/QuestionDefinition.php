<?php

namespace Ak\PollBundle\Entity;

use Ak\PollBundle\Entity\Traits\SoftdeleteableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

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
    use SoftdeleteableTrait;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    protected $position;

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
     * @Gedmo\SortableGroup
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

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }



}

