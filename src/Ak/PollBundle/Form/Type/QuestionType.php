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
 * Class QuestionType
 * @package Ak\PollBundle\Form\Type
 */
class QuestionType extends AbstractType
{
    /**
     * {@inheritdoc}
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
     * @return string
     */
    public function getName()
    {
        return 'answer';
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ak\PollBundle\Form\Data\Question',
        ));
    }

}