<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 03.01.16
 * Time: 12:30
 */

namespace Ak\PollBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Class SoftdeleteableTrait - adds inactivated field to the database table
 * @package Ak\PollBundle\Entity\Traits
 *
 * @Gedmo\SoftDeleteable(fieldName="inactivated", timeAware=false)
 */

trait SoftdeleteableTrait
{
    /**
     * stores information whether the record was inactivated
     * @var bool $inactivated
     *
     * @ORM\Column(name="inactivated",  type="boolean" , nullable=true)
     */
    private $inactivated;

    /**
     * @return boolean
     */
    public function isInactivated()
    {
        return $this->inactivated;
    }

    /**
     * @param boolean $inactivated
     */
    public function setInactivated($inactivated)
    {
        $this->inactivated = $inactivated;
    }


}