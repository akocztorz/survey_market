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

class HasEditableOptionsExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('hasEditableOptions', array($this, 'hasEditableOptions')),
        );
    }

    /**
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
     * @return string
     */
    public function getName()
    {
        return 'hasEditableOptions_extension';
    }


}