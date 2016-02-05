<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 08.11.15
 * Time: 22:06
 */

namespace Ak\PollBundle\Twig;


use Ak\PollBundle\Entity\QuestionDefinition;
use Ak\PollBundle\Entity\QuestionDefinitionOpen;

/**
 * Class HasEditableOptionsExtension - Twig filter , checks whether the question definition is a question with predefined answers
 * @package Ak\PollBundle\Twig
 */
class HasEditableOptionsExtension extends \Twig_Extension
{
    /**
     * Twig filter
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('hasEditableOptions', array($this, 'hasEditableOptions')),
        );
    }

    /**
     * checks if question has predefined answers
     * @param QuestionDefinition $questionDefinition
     * @return bool
     */
    public function hasEditableOptions(QuestionDefinition $questionDefinition){
        if($questionDefinition instanceof QuestionDefinitionOpen){
            return false;
        }
        else{
            return true;
        }
    }

    /**
     * returns filter name
     * @return string
     */
    public function getName()
    {
        return 'hasEditableOptions_extension';
    }


}