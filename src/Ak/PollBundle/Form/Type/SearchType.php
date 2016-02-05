<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 27.11.15
 * Time: 14:11
 */

namespace Ak\PollBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SearchType - creates the Search form for PollDefinition
 * @package Ak\PollBundle\Form\Type
 */
class SearchType extends AbstractType
{
    /**
     * builds a Search form
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label' => 'Wyszukaj po Nazwie'))
            ->add('search', 'submit', array('label' => 'Szukaj'))
            ;

    }

    /**
     * returns a form name
     * @return string
     */
    public function getName()
    {
        return 'search5';
    }
//
//    /**
//     * @param OptionsResolver $resolver
//     */
//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults(array(
//            'data_class' => 'Ak\PollBundle\Entity\PollDefinition',
//        ));
//    }


}