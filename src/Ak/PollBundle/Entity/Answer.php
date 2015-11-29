<?php

namespace Ak\PollBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Answer
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ak\PollBundle\Entity\AnswerRepository")
 */
class Answer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * * @var ArrayCollection
     *
     * @ORM\ManyToOne(targetEntity="Poll", inversedBy="answers")
     * @ORM\JoinColumn(name="poll_id", referencedColumnName="id")
     */
    protected $poll;

    /**
     * * @var OptionDefinition
     *
     * @ORM\ManyToOne(targetEntity="OptionDefinition", inversedBy="answers")
     * @ORM\JoinColumn(name="option_definition_id", referencedColumnName="id")
     */
    protected $optionDefinition;


    /**
     *
     */
    public function __construct()
    {
        $this->poll = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection
     */
    public function getPoll()
    {
        return $this->poll;
    }

    /**
     * @param ArrayCollection $poll
     */
    public function setPoll($poll)
    {
        $this->poll = $poll;
    }

    /**
     * @return OptionDefinition
     */
    public function getOptionDefinition()
    {
        return $this->optionDefinition;
    }

    /**
     * @param OptionDefinition $optionDefinition
     */
    public function setOptionDefinition($optionDefinition)
    {
        $this->optionDefinition = $optionDefinition;
    }


}

