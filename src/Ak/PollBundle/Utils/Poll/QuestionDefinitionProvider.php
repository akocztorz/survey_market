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

class QuestionDefinitionProvider
{
    /**
     * @var QuestionDefinitionsProvider
     */
    private $questionDefinitionsProvider;

    /**
     *
     */
    public function __construct(QuestionDefinitionsProvider $questionDefinitionsProvider)
    {
        $this->questionDefinitionsProvider = $questionDefinitionsProvider;
    }

    /**
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