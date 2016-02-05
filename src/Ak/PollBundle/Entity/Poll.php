<?php

namespace Ak\PollBundle\Entity;

use Ak\PollBundle\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Metadata\Tests\Driver\Fixture\A\A;

/**
 * Poll - represents poll table in database
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ak\PollBundle\Entity\PollRepository")
 */
class Poll
{
    use TimestampableTrait;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * stores poll definition id
     * @var PollDefinition
     *
     * @ORM\ManyToOne(targetEntity="PollDefinition", inversedBy="polls")
     * @ORM\JoinColumn(name="poll_definition_id", referencedColumnName="id")
     */
    protected $pollDefinition;

    /**
     * stores a collection of answers
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="poll", cascade={"persist"})
     */
    protected $answers;

    /**
     * stores information if all questions of the poll were responded
     * @var bool
     *
     * @ORM\Column(name="completed", type="boolean", nullable=true)
     */
    private $completed;

    /**
     * stores information about a last answered question
     * @var integer;
     *
     * @ORM\Column(name="last_answered_question", type="integer")
     */
    private $lastAnsweredQuestion;

    /**
     * stores deal id
     * @var Deal
     *
     * @ORM\ManyToOne(targetEntity="Deal", inversedBy="polls")
     * @ORM\JoinColumn(name="deal_id", referencedColumnName="id")
     */
    private $deal;

    /**
     *constructor
     * initializes answer collection
     */
    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param Answer $answer
     */
    public function addAnswer(Answer $answer)
    {
        $this->answers->add($answer);
    }

    /**
     * @return boolean
     */
    public function isCompleted()
    {
        return $this->completed;
    }

    /**
     * @param boolean $completed
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;
    }

    /**
     * @return int
     */
    public function getLastAnsweredQuestion()
    {
        return $this->lastAnsweredQuestion;
    }

    /**
     * @param int $lastAnsweredQuestion
     */
    public function setLastAnsweredQuestion($lastAnsweredQuestion)
    {
        $this->lastAnsweredQuestion = $lastAnsweredQuestion;
    }

    /**
     * @return Deal
     */
    public function getDeal()
    {
        return $this->deal;
    }

    /**
     * @param Deal $deal
     */
    public function setDeal($deal)
    {
        $this->deal = $deal;
    }


}

