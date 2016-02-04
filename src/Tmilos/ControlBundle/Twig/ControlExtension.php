<?php

/*
 * This file is part of the Tmilos Symfony-Control package.
 *
 * (c) Milos Tomic <tmilos@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Tmilos\ControlBundle\Twig;

use Symfony\Component\PropertyAccess\PropertyAccessor;

class ControlExtension extends \Twig_Extension
{
    /** @var  PropertyAccessor */
    private $accessor;

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('property', [$this, 'propertyFunction']),
            new \Twig_SimpleFunction('has_property', [$this, 'hasPropertyFunction']),
        ];
    }

    public function getTokenParsers()
    {
        return [
            new ControlTokenParser(),
        ];
    }

    /**
     * @param $object
     * @param $path
     *
     * @return mixed
     */
    public function propertyFunction($object, $path)
    {
        if (null == $this->accessor) {
            $this->accessor = new PropertyAccessor();
        }

        return $this->accessor->getValue($object, $path);
    }

    /**
     * @param $object
     * @param $path
     *
     * @return bool
     */
    public function hasPropertyFunction($object, $path)
    {
        if (null == $this->accessor) {
            $this->accessor = new PropertyAccessor();
        }
        static $hasIsReadableMethod = null;
        if (null === $hasIsReadableMethod) {
            $hasIsReadableMethod = method_exists($this->accessor, 'isReadable');
        }
        if ($hasIsReadableMethod) {
            return $this->accessor->isReadable($object, $path);
        } else {
            try {
                $this->accessor->getValue($object, $path);

                return true;
            } catch (\Symfony\Component\PropertyAccess\Exception\NoSuchPropertyException $ex) {
                return false;
            }
        }
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'control';
    }
}
