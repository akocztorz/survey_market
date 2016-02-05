<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 14.01.16
 * Time: 14:27
 */

namespace Ak\PollBundle\Form\Type;


use Ak\PollBundle\Form\DataTransformer\ArrayToStringTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class RegistrationType - creates the Registration form
 * @package Ak\PollBundle\Form\Type
 */
class RegistrationType extends AbstractType
{

    /**
     * builds a Registration form
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('roles', 'choice', array(
                'choices' => array('ankieter' => 'ROLE_POLLSTER', 'zleceniodawca' => 'ROLE_EMPLOYER'),
                'choices_as_values' => true,
                'multiple' => false,
                'label' => 'Rola',
            )
        );

        $builder->get('roles')->addModelTransformer(new ArrayToStringTransformer());
    }

    /**
     * returns a form name
     * @return string
     */
    public function getParent()
    {
        return 'fos_user_registration';
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

}