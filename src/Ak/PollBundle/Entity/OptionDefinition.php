<?php

namespace Ak\PollBundle\Entity;

use Ak\PollBundle\Entity\Traits\SoftdeleteableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * OptionDefinition - represents option_definition table in database
 *
 * @ORM\Entity(repositoryClass="Ak\PollBundle\Entity\OptionDefinitionRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="response_type", type="string")
 * @ORM\DiscriminatorMap({
 *   "response_open" = "OptionDefinitionOpen",
 *   "response_choice" = "OptionDefinitionChoice",
 * })
 *
 */
abstract class OptionDefinition
{
    use SoftdeleteableTrait;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * stores a response option
     * @var string
     *
     * @ORM\Column(name="response", type="text")
     */
    private $response;

    /**
     * stores information whether the option should have free text window available
     * @var bool
     *
     * @ORM\Column(name="free_text", type="boolean", nullable=false)
     */
    protected $freeText = false;

    /**
     * stores answers collection
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="optionDefinition")
     */
    protected $answers;

    /**
     * constructor - initializes answer array collection
     */
    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

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
     * Set response
     *
     * @param string $response
     *
     * @return OptionDefinition
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get response
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }


    /**
     * @return boolean
     */
    public function isFreeText()
    {
        return $this->freeText;
    }

    /**
     * @param boolean $freeText
     */
    public function setFreeText($freeText)
    {
        $this->freeText = $freeText;
    }

    /**
     * @return ArrayCollection
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @param ArrayCollection $answers
     */
    public function setAnswers($answers)
    {
        $this->answers = $answers;
    }

    /**
     * @return QuestionDefinition
     */
    abstract public function getQuestionDefinition();


    /**
     * @param $questionDefinition
     */
    abstract public function setQuestionDefinition($questionDefinition);

}

