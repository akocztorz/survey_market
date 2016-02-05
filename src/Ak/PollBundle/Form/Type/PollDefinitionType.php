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
 * Class PollDefinitionType - creates the PollDefinition form
 * @package Ak\PollBundle\Form\Type
 */
class PollDefinitionType extends AbstractType
{
    /**
     * builds a PollDefinition form
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label' => 'Nazwa')
            );
    }

    /**
     * returns a form name
     * @return string
     */
    public function getName()
    {
        return 'pollDefinition';
    }

    /**
     * specifies the base class for the form
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ak\PollBundle\Entity\PollDefinition',
        ));
    }

}