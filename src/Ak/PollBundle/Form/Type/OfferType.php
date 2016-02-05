<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 31.10.15
 * Time: 20:45
 */

namespace Ak\PollBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * Class OfferType - creates the Offer form
 * @package Ak\PollBundle\Form\Type
 */
class OfferType extends AbstractType
{
    /**
     * builds an Offer form
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('offerName', null, array('label' => 'Nazwa Oferty'))
//            ->add('pollDefinition', 'entity', array(
//                'class' => 'AkPollBundle:PollDefinition',
//                'choice_label' => 'name',
//                'label' => 'Definicja Ankiety',))
            ->add('quantity',null, array('label' => 'Ilość Ankiet do Wykonania'))
            ->add('price',null, array('label' => 'Cena Jednostkowa'))
            ->add('minQuantity',null, array('label' => 'Minimalna ilość'))
            ->add('dueDate',null, array('label' => 'Termin Realizacji'))

        ;
    }

    /**
     * returns a form name
     * @return string
     */
    public function getName()
    {
        return 'offer';
    }

    /**
     * specifies the base class for the form
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ak\PollBundle\Entity\Offer',
        ));
    }

}