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
 * Class DealType
 * @package Ak\PollBundle\Form\Type
 */
class DealType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', null, array('label' => 'Ilość ankiet'))
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'deal';
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ak\PollBundle\Entity\Deal',
        ));
    }

}