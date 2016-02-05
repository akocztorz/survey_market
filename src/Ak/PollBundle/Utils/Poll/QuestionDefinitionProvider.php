<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 10.12.15
 * Time: 11:48
 */

namespace Ak\PollBundle\Utils\Poll;


use Ak\PollBundle\Entity\Poll;
use Ak\PollBundle\Entity\QuestionDefinition;

/**
 * Class QuestionDefinitionProvider - provides a single question definition
 * @package Ak\PollBundle\Utils\Poll
 */
class QuestionDefinitionProvider
{
    /**
     * stores questionDefinitionsProvider object
     * @var QuestionDefinitionsProvider
     */
    private $questionDefinitionsProvider;


    /**
     * constructor sets $this->questionDefinitionsProvider
     * @param QuestionDefinitionsProvider $questionDefinitionsProvider
     */
    public function __construct(QuestionDefinitionsProvider $questionDefinitionsProvider)
    {
        $this->questionDefinitionsProvider = $questionDefinitionsProvider;
    }

    /**
     * returns questionDefinition
     * @param Poll $poll
     * @param $position
     * @return QuestionDefinition
     */
    public function getQuestionDefinition(Poll $poll, $position)
    {
        $questionDefinitions = $this->questionDefinitionsProvider->getQuestionDefinitions($poll);
        return $questionDefinitions[$position];
    }
}