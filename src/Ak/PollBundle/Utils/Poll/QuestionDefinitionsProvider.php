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
 * Class QuestionDefinitionsProvider - provides a list of questionDefinitions
 * @package Ak\PollBundle\Utils\Poll
 */
class QuestionDefinitionsProvider
{
    /**
     * stores instance of questionDefinitionRepository class
     * @var QuestionDefinitionRepository
     */
    private $questionDefinitionRepository;


    /**
     * sets $this->questionDefinitionRepository
     * @param QuestionDefinitionRepository $questionDefinitionRepository
     */
    public function __construct(QuestionDefinitionRepository $questionDefinitionRepository)
    {

        $this->questionDefinitionRepository = $questionDefinitionRepository;
    }

    /**
     * returns list of questionDefinitions
     * @param Poll $poll
     * @return array
     */
    public function getQuestionDefinitions(Poll $poll)
    {
        return $this->questionDefinitionRepository->getQuestionDefinitions($poll->getPollDefinition());
    }
}