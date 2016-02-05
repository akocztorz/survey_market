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
 * QuestionDefinitionOpen - represents question_definition table, represents open questions
 *
 * @ORM\Entity()
 */
class QuestionDefinitionOpen extends QuestionDefinition
{
    /**
     * stores option definition id
     * @var OptionDefinition
     *
     * @ORM\OneToOne(targetEntity="OptionDefinitionOpen", mappedBy="questionDefinitionOpen", cascade={"persist"})
     */
    protected $optionDefinitionOpen;


    /**
     * constructor - initializes new OptionDefinitionOpen entity and sets $this->optionDefinitionOpen with it
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
        return new ArrayCollection(array($this->getOptionDefinitionOpen(),)) ;
    }

}