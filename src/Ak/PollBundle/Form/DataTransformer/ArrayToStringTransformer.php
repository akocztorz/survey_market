<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 14.01.16
 * Time: 15:31
 */

namespace Ak\PollBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Class ArrayToStringTransformer
 * @package Ak\PollBundle\Form\DataTransformer
 */
class ArrayToStringTransformer implements DataTransformerInterface
{
    /**
     * @param string $string
     * @return array
     */
    public function ReverseTransform($string)
    {
        $array = [$string];
        return $array;
    }

    /**
     * Transforms an array  to a string.
     * @param array $array
     * @return string
     */
    public function transform($array)
    {
        $string = $array[0];
        return $string;
    }


}