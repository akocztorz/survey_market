<?php

namespace Ak\PollBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuestionDefinition - represents question_definition table, represents questions with single choice
 *
 * @ORM\Entity()
 */
class QuestionDefinitionSingleChoice extends QuestionDefinitionChoice
{

    /**
     * constructor -  sets maxChoices value to 1
     */
    public function __construct(){
        $this->maxChoices = 1;
    }

}

