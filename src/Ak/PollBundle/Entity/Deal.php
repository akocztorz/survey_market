<?php

namespace Ak\PollBundle\Entity;

use Ak\PollBundle\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Ak\PollBundle\Validator\Constraints as AkAssert;

/**
 * Deal - represents the Deal table in database
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ak\PollBundle\Entity\DealRepository")
 * @AkAssert\DealClass
 */
class Deal
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
     * stores id of a user who accepted an offer
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="deals")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * stores accepted offer id
     * @var Offer
     * @ORM\ManyToOne(targetEntity="Offer", inversedBy="deals")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="id")
     */
    private $offer;


    /**
     * stores information about number of polls to be conducted
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * stores ids of polls created for the deal
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Poll", mappedBy="deal")
     *
     */
    protected $polls;

    /**
     * constructor initializes polls ArrayCollection
     */
    public function __construct()
    {
        $this->polls = new ArrayCollection();
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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Deal
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return Offer
     */
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     * @param Offer $offer
     */
    public function setOffer($offer)
    {
        $this->offer = $offer;
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


}

