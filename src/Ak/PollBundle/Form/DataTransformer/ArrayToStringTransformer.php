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
 * Class ArrayToStringTransformer - data transformer, converts an array into a string, converts a string into an array
 * @package Ak\PollBundle\Form\DataTransformer
 */
class ArrayToStringTransformer implements DataTransformerInterface
{
    /**
     * transforms a string into an array
     * @param string $string
     * @return array
     */
    public function ReverseTransform($string)
    {
        $array = [$string];
        return $array;
    }

    /**
     * transforms an array  to a string.
     * @param array $array
     * @return string
     */
    public function transform($array)
    {
        $string = $array[0];
        return $string;
    }


}