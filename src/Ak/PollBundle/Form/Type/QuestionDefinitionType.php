<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 04.11.15
 * Time: 09:43
 */

namespace Ak\PollBundle\Form\Type;

use Ak\PollBundle\Entity\QuestionDefinitionChoice;
use Ak\PollBundle\Entity\QuestionDefinitionRestrictedChoice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Tests\Fixtures\AnnotatedClasses\AbstractClass;

/**
 * Class QuestionDefinitionType
 * @package Ak\PollBundle\Form\Type
 */
class QuestionDefinitionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question', null, array('label' => 'Pytanie'))
            ->add('position', null, array('label' => 'Numer Pytania'))

        ;


        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $questionDefinition = $event->getData();
            $form = $event->getForm();


            if ($questionDefinition instanceof QuestionDefinitionRestrictedChoice ) {
                $form->add('maxChoices', null, array('label' => 'Maksymalna liczba odpowiedzi' ));
            }

        });
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'questionDefinition';
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ak\PollBundle\Entity\QuestionDefinition',
        ));
    }

}