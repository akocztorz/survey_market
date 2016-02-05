<?php

namespace Ak\PollBundle\Entity;

use Ak\PollBundle\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Answer - represents Answer table in a database
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ak\PollBundle\Entity\AnswerRepository")
 *
 */
class Answer
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
     * stores information if option definition was chosen by the respondent
     * @var bool
     *
     * @ORM\Column(name="checked", type="boolean", nullable=true)
     */
    private $checked;

    /**
     * stores the text response for a question
     * @var string
     *
     * @ORM\Column(name="free_text", type="text", nullable=true)
     *
     */
    private $freeText;

    /**
     * stores poll id
     * @var Poll
     *
     * @ORM\ManyToOne(targetEntity="Poll", inversedBy="answers")
     * @ORM\JoinColumn(name="poll_id", referencedColumnName="id")
     *
     */
    protected $poll;

    /**
     * stores option definition id
     * @var OptionDefinition
     *
     * @ORM\ManyToOne(targetEntity="OptionDefinition", inversedBy="answers")
     * @ORM\JoinColumn(name="option_definition_id", referencedColumnName="id")
     *
     */
    protected $optionDefinition;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Poll
     */
    public function getPoll()
    {
        return $this->poll;
    }

    /**
     * @param Poll $poll
     */
    public function setPoll($poll)
    {
        $this->poll = $poll;
    }

    /**
     * @return OptionDefinition
     */
    public function getOptionDefinition()
    {
        return $this->optionDefinition;
    }

    /**
     * @param OptionDefinition $optionDefinition
     */
    public function setOptionDefinition($optionDefinition)
    {
        $this->optionDefinition = $optionDefinition;
    }

    /**
     * @return string
     */
    public function getFreeText()
    {
        return $this->freeText;
    }

    /**
     * @param string $freeText
     */
    public function setFreeText($freeText)
    {
        $this->freeText = $freeText;
    }

    /**
     * @return bool
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * @param bool $checked
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;
    }


}

