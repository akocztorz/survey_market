<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 15.01.16
 * Time: 11:54
 */

namespace Ak\PollBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class DealType - creates the Deal form
 * @package Ak\PollBundle\Form\Type
 */
class DealType extends AbstractType
{
    /**
     * builds a Deal form
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', null, array('label' => 'Ilość ankiet'))
        ;
    }

    /**
     * returns a form name
     * @return string
     */
    public function getName()
    {
        return 'deal';
    }

    /**
     * specifies the base class for the form
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ak\PollBundle\Entity\Deal',
        ));
    }

}