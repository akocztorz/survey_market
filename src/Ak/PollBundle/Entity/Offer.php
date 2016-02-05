<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 30.10.15
 * Time: 09:47
 */

namespace Ak\PollBundle\Entity;

use Ak\PollBundle\Entity\Traits\TimestampableTrait;
use Ak\PollBundle\Entity\Traits\SoftdeleteableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Offer - represents the Offer table in database
 *
 * @ORM\Entity(repositoryClass="Ak\PollBundle\Entity\OfferRepository")
 */

class Offer
{
    use TimestampableTrait;
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
     * stores offer name
     * @var string
     *
     * @ORM\Column(name="offer_name", type="text")
     */
    private $offerName;

    /**
     * stores polls quantity employer needs to be conducted
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;


    /**
     * stores minimum polls quantity single pollster can accept
     * @var integer
     *
     * @ORM\Column(name="min_quantity", type="integer")
     */
    private $minQuantity;

    /**
     * stores a price per poll conducted
     * @var string
     *
     * @ORM\column(name="price", type="decimal", precision=4, scale=2)
     */
    private $price;


    /**
     * stores information about a due date
     * @var \DateTime
     *
     * @ORM\Column(name="due_date", type="datetime")
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     */
    private $dueDate = null;

    /**
     * stores information whether the offer was sealed by it's creator
     * @var boolean
     *
     * @ORM\Column(name="sealed", type="boolean")
     */
    private $sealed = false;


    /**
     * stores poll definition number
     * @var PollDefinition
     *
     * @ORM\ManyToOne(targetEntity="PollDefinition", inversedBy="offers")
     * @ORM\JoinColumn(name="poll_definition_id", referencedColumnName="id")
     */
    protected $pollDefinition;

    /**
     * stores collection of deals created for the offer
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Deal", mappedBy="offer")
     */
    protected $deals;

    /**
     * constructor -initializes pollDefinition ArrayCollection
     */
    public function __construct(){
        $this->pollDefinition = new ArrayCollection();
    }


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

    /**
     * @return ArrayCollection
     */
    public function getDeals()
    {
        return $this->deals;
    }

    /**
     * @param ArrayCollection $deals
     */
    public function setDeals($deals)
    {
        $this->deals = $deals;
    }


}