<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 29.10.15
 * Time: 21:05
 */

namespace Ak\PollBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * QuestionDefinitionOpen
 *
 * @ORM\Entity()
 */
class QuestionDefinitionOpen extends QuestionDefinition
{
    /**
     * @var OptionDefinition
     *
     * @ORM\OneToOne(targetEntity="OptionDefinitionOpen", mappedBy="questionDefinitionOpen", cascade={"persist"})
     */
    protected $optionDefinitionOpen;


    /**
     *
     */
    public function __construct(){
        $entity = new OptionDefinitionOpen();
        $entity->setResponse('pytanie otwarte');
        $entity->setQuestionDefinitionOpen($this);
        $this->setOptionDefinitionOpen($entity);
    }

    /**
     * @return OptionDefinition
     */
    public function getOptionDefinitionOpen()
    {
        return $this->optionDefinitionOpen;
    }

    /**
     * @param OptionDefinition $optionDefinitionOpen
     */
    public function setOptionDefinitionOpen($optionDefinitionOpen)
    {
        $this->optionDefinitionOpen = $optionDefinitionOpen;
    }

    /**
     * @return OptionDefinition
     */
    public function getOptionDefinitions()
    {
        return $this->getOptionDefinitionOpen();
    }

}