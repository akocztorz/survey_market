<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 08.11.15
 * Time: 21:02
 */

namespace Ak\PollBundle\Twig;
use Ak\PollBundle\Entity\QuestionDefinition;
use Ak\PollBundle\Entity\QuestionDefinitionMultipleChoice;
use Ak\PollBundle\Entity\QuestionDefinitionOpen;
use Ak\PollBundle\Entity\QuestionDefinitionSingleChoice;


/**
 * Class QuestionDefinitionTypeExtension
 * @package Ak\PollBundle\Twig
 */
class QuestionDefinitionTypeExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('questionDefinitionType', array($this, 'getQuestionDefinitionType')),
        );
    }


    /**
     * @param QuestionDefinition $questionDefinition
     * @return string
     */
    public function getQuestionDefinitionType(QuestionDefinition $questionDefinition)
    {
        if($questionDefinition instanceof QuestionDefinitionOpen){
            $questionDefinitionType = 'open';
        }
        elseif($questionDefinition instanceof QuestionDefinitionSingleChoice){
            $questionDefinitionType = 'single_choice';
        }
        elseif($questionDefinition instanceof QuestionDefinitionMultipleChoice){
            $questionDefinitionType = 'multiple_choice';
        }
        else{
            $questionDefinitionType = 'restricted_choice';
        }

        return $questionDefinitionType;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'questionDefinitionType_extension';
    }


}