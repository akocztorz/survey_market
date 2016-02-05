<?php

namespace Ak\PollBundle\Entity;

use Ak\PollBundle\Entity\Traits\SoftdeleteableTrait;
use Ak\PollBundle\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * pollDefinition - represents poll_definition table in database
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ak\PollBundle\Entity\PollDefinitionRepository")
 */
class PollDefinition
{
    use SoftdeleteableTrait;
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
     * stores a poll definition name
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * stores a questionDefinitions collection
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="QuestionDefinition", mappedBy="pollDefinition")
     */
    private $questionsDefinitions;

    /**
     * stores polls collection
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Poll", mappedBy="pollDefinition")
     */
    protected $polls;

    /**
     * stores offer collection
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Offer", mappedBy="pollDefinition")
     */
    protected $offers;

    /**
     * stores id of a user who created the poll definition
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="pollDefinitions")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


    /**
     *constructor -initializes questionDefinitions, polls and offers collections
     */
    public function __construct()
    {
        $this->questionDefinition = new ArrayCollection();
        $this->polls = new ArrayCollection();
        $this->offers = new ArrayCollection();
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
    public function getQuestionsDefinitions()
    {
        return $this->questionsDefinitions;
    }

    /**
     * @param ArrayCollection $questionsDefinitions
     */
    public function setQuestionsDefinitions($questionsDefinitions)
    {
        $this->questionsDefinitions = $questionsDefinitions;
    }

    /**
     * @return ArrayCollection
     */
    public function getOffers()
    {
        return $this->offers;
    }

    /**
     * @param ArrayCollection $offers
     */
    public function setOffers($offers)
    {
        $this->offers = $offers;
    }

    /**
     * @return ArrayCollection
     */
    public function getPolls()
    {
        return $this->polls;
    }

    /**
     * @param ArrayCollection $polls
     */
    public function setPolls($polls)
    {
        $this->polls = $polls;
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
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


}

