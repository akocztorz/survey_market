<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 08.11.15
 * Time: 11:26
 */

namespace Ak\PollBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Tests\Fixtures\AnnotatedClasses\AbstractClass;

/**
 * Class OptionDefinitionType
 * @package Ak\PollBundle\Form\Type
 */
class OptionDefinitionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('response', null, array('label'=> 'odpowiedź'));

    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'optionDefinition';
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ak\PollBundle\Entity\OptionDefinition',
        ));
    }


}