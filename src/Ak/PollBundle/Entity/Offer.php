<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 30.10.15
 * Time: 09:47
 */

namespace Ak\PollBundle\Entity;

use Ak\PollBundle\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\Timestampable;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Offer
 *
 * @ORM\Entity(repositoryClass="Ak\PollBundle\Entity\OfferRepository")
 */

class Offer
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
     * @var string
     *
     * @ORM\Column(name="offer_name", type="text")
     */
    private $offerName;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;


    /**
     * @var integer
     *
     * @ORM\Column(name="min_quantity", type="integer")
     */
    private $minQuantity;

    /**
     * @var string
     *
     * @ORM\column(name="price", type="decimal", precision=4, scale=2)
     */
    private $price;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="due_date", type="datetime")
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     */
    private $dueDate = null;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sealed", type="boolean")
     */
    private $sealed = false;

    /**
     * @var PollDefinition
     *
     * @ORM\ManyToOne(targetEntity="PollDefinition", inversedBy="offers")
     * @ORM\JoinColumn(name="poll_definition_id", referencedColumnName="id")
     */
    protected $pollDefinition;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getMinQuantity()
    {
        return $this->minQuantity;
    }

    /**
     * @param int $minQuantity
     */
    public function setMinQuantity($minQuantity)
    {
        $this->minQuantity = $minQuantity;
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
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param \DateTime $dueDate
     */
    public function setDueDate(\DateTime $dueDate = null)
    {
        $this->dueDate = $dueDate;
    }

    /**
     * @return boolean
     */
    public function isSealed()
    {
        return $this->sealed;
    }

    /**
     * @param boolean $sealed
     */
    public function setSealed($sealed)
    {
        $this->sealed = $sealed;
    }

    /**
     * @return string
     */
    public function getOfferName()
    {
        return $this->offerName;
    }

    /**
     * @param string $offerName
     */
    public function setOfferName($offerName)
    {
        $this->offerName = $offerName;
    }


}