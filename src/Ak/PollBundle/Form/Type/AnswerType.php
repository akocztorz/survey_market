<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 29.12.15
 * Time: 14:12
 */

namespace Ak\PollBundle\Form\Type;


use Ak\PollBundle\Entity\Answer;
use Ak\PollBundle\Entity\OptionDefinitionOpen;
use Ak\PollBundle\Entity\QuestionDefinitionRestrictedChoice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AnswerType
 * @package Ak\PollBundle\Form\Type
 */
class AnswerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder
//            ->add('freeText', null)
//
//        ;


        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            /** @var Answer $answer */
            $answer = $event->getData();
            $form = $event->getForm();

            if($answer->getOptionDefinition() instanceof OptionDefinitionOpen) {
                $form ->add('freeText', null, array('label' => ''));
            }
            else {
                $form ->add('checked', 'checkbox' , array('label' => $answer->getOptionDefinition()->getResponse(),
                    'required' => false, ) );
            }


            if ($answer->getOptionDefinition()->isFreeText()) {
                $form->add('freeText', null, array('label' => 'Dodatkowe uwagi'));
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
            'data_class' => 'Ak\PollBundle\Entity\Answer',
        ));
    }

}