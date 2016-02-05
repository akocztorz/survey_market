<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 14.01.16
 * Time: 08:07
 */

namespace Ak\PollBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 * User - represents fos_user table
 *
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * stores collection of deal ids
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Deal", mappedBy="user")
     */
    protected $deals;

    /**
     * stores collection of poll definition ids
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="PollDefinition", mappedBy="user")
     */
    protected $pollDefinitions;

    /**
     * constructor - initializes deals and pollDefinitions ArrayCollections
     */
    public function __construct(){

        $this->deals = new ArrayCollection();
        $this->pollDefinitions = new ArrayCollection();

        parent::__construct();
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

    /**
     * @return ArrayCollection
     */
    public function getPollDefinitions()
    {
        return $this->pollDefinitions;
    }

    /**
     * @param ArrayCollection $pollDefinitions
     */
    public function setPollDefinitions($pollDefinitions)
    {
        $this->pollDefinitions = $pollDefinitions;
    }


}