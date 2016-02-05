<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 29.12.15
 * Time: 16:01
 */

namespace Ak\PollBundle\Form\Type;


use Ak\PollBundle\Entity\QuestionDefinition;
use Ak\PollBundle\Form\Data\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class QuestionType - creates the Question form
 * @package Ak\PollBundle\Form\Type
 */
class QuestionType extends AbstractType
{

    /**
     * builds a QuestionType form
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            /** @var Question $question  */
            $question= $event->getData();
            $form = $event->getForm();

            foreach($question->getQuestionDefinition()->getOptionDefinitions() as $optionDefinition ){
                $form->add('a' . $optionDefinition->getId(), "answer" , array('label' => false , 'by_reference' => false ) );
            }
        });
    }


    /**
     * returns a form name
     * @return string
     */
    public function getName()
    {
        return 'answer';
    }

    /**
     * specifies the base class for the form
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ak\PollBundle\Form\Data\Question',
        ));
    }

}