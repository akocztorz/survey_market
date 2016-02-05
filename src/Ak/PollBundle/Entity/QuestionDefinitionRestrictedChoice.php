<?php

namespace Ak\PollBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuestionDefinition - represents question_definition table, represents questions with multiple choice with a restriction
 *
 * @ORM\Entity()
 */
class QuestionDefinitionRestrictedChoice extends QuestionDefinitionChoice
{

}

