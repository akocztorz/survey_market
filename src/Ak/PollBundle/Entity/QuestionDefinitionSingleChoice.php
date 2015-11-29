<?php

namespace Ak\PollBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuestionDefinition
 *
 * @ORM\Entity()
 */
class QuestionDefinitionSingleChoice extends QuestionDefinitionChoice
{

    public function __construct(){
        $this->maxChoices = 1;
    }

}

