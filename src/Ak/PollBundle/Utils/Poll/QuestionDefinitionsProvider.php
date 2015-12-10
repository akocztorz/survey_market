<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 10.12.15
 * Time: 10:18
 */

namespace Ak\PollBundle\Utils\Poll;


use Ak\PollBundle\Entity\Poll;
use Ak\PollBundle\Entity\QuestionDefinitionRepository;

/**
 * Class QuestionDefinitionsProvider
 * @package Ak\PollBundle\Utils\Poll
 */
class QuestionDefinitionsProvider
{
    /**
     * @var QuestionDefinitionRepository
     */
    private $questionDefinitionRepository;

    /**
     *
     */
    public function __construct(QuestionDefinitionRepository $questionDefinitionRepository)
    {

        $this->questionDefinitionRepository = $questionDefinitionRepository;
    }

    /**
     * @param Poll $poll
     * @return array
     */
    public function getQuestionDefinitions(Poll $poll)
    {
        return $this->questionDefinitionRepository->getQuestionDefinitions($poll->getPollDefinition());
    }
}