<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 29.12.15
 * Time: 22:42
 */

namespace Ak\PollBundle\Form\Data;
use Ak\PollBundle\Entity\Answer;
use Ak\PollBundle\Entity\Poll;
use Ak\PollBundle\Entity\QuestionDefinition;
use Doctrine\ORM\EntityManager;
use Ak\PollBundle\Entity\OptionDefinition;
use Symfony\Component\Validator\Constraints as Assert;
use Ak\PollBundle\Validator\Constraints as AkAssert;


/**
 * Class Question
 * @package Ak\PollBundle\Entity
 *
 * @AkAssert\QuestionClass
 */
class Question
{
    /**
     * @var Poll
     */
    private $poll;

    /**
     * @var QuestionDefinition
     */
    private $questionDefinition;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
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
    public function setPoll(Poll $poll)
    {
        $this->poll = $poll;
    }

    /**
     * @return QuestionDefinition
     */
    public function getQuestionDefinition()
    {
        return $this->questionDefinition;
    }

    /**
     * @param QuestionDefinition $questionDefinition
     */
    public function setQuestionDefinition($questionDefinition)
    {
        $this->questionDefinition = $questionDefinition;
    }

    /**
     * @param $aID
     * @return Answer
     * @throws \Exception
     */
    public function __get($aID)
    {
        $id = str_replace("a","",$aID);

        $optionDefinitions = $this->questionDefinition->getOptionDefinitions();
        $answers = $this->poll->getAnswers();


        foreach($optionDefinitions as $optionDefinition){
            if($optionDefinition->getId() == $id){
                if($answers->isEmpty()){
                    $answer= new Answer();
                    $answer->setPoll($this->poll);
                    $answer->setOptionDefinition($optionDefinition);
                    return $answer;
                }
                else{

                    $contains = false;
                    $foundAnswer = null;

                    foreach($answers as $an){
                        if($an->getOptionDefinition()->getId() == $id ) {
                            $contains = true;
                            $foundAnswer = $an;
                        }
                    }

                    if($contains) {
                        return $foundAnswer;
                    }
                    else {
                        $answer= new Answer();
                        $answer->setPoll($this->poll);
                        $answer->setOptionDefinition($optionDefinition);
                        return $answer;
                    }
//                    foreach($answers as $an){
//                        if($an->getOptionDefinition()->getId() != $id ) {
//                            $answer= new Answer();
//                            $answer->setPoll($this->poll);
//                            $answer->setOptionDefinition($optionDefinition);
//                        }
//                        else{
//                            $answer = $an;
//                        }
//                        return $answer;
//                    }
                }
            }
        }

        throw new \Exception("invalid id");
    }

    /**
     * @param $aID
     * @param Answer $answer
     */
    public function __set($aID, Answer $answer)
    {
        $entities = $this->poll->getAnswers();

        $contains = false;

        foreach($entities as $entity) {
            if($entity->getOptionDefinition()->getID() == $answer->getOptionDefinition()->getId()) {
                $contains = true;
                $entity->setFreeText($answer->getFreeText());
                $entity->setChecked($answer->getChecked());
            }
        }

        if(!$contains){
            $this->poll->addAnswer($answer);
        }

    }

    /**
     * @return EntityManager
     */
    public function getEm()
    {
        return $this->em;
    }

    /**
     * @param EntityManager $em
     */
    public function setEm($em)
    {
        $this->em = $em;
    }


}