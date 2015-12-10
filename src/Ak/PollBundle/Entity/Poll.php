<?php

namespace Ak\PollBundle\Entity;

use Ak\PollBundle\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Metadata\Tests\Driver\Fixture\A\A;

/**
 * Poll
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
     * @var PollDefinition
     *
     * @ORM\ManyToOne(targetEntity="pollDefinition", inversedBy="polls")
     * @ORM\JoinColumn(name="poll_definition_id", referencedColumnName="id")
     */
    protected $pollDefinition;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="poll")
     */
    protected $answers;

    /**
     *
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


}

