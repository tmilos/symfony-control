<?php

/*
 * This file is part of the Tmilos Symfony-Control package.
 *
 * (c) Milos Tomic <tmilos@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Tmilos\ControlBundle\Tests\Twig;

use Tmilos\ControlBundle\Twig\ControlExtension;
use Tmilos\ControlBundle\Twig\ControlTokenParser;

class ControlExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function test_defines_property_function()
    {
        $extension = new ControlExtension();

        foreach ($extension->getFunctions() as $function) {
            if ($function instanceof \Twig_SimpleFunction) {
                if ('property' == $function->getName()) {
                    return;
                }
            }
        }

        $this->fail('Twig function "property" not defined by extension');
    }

    public function test_defines_has_property_function()
    {
        $extension = new ControlExtension();

        foreach ($extension->getFunctions() as $function) {
            if ($function instanceof \Twig_SimpleFunction) {
                if ('has_property' == $function->getName()) {
                    return;
                }
            }
        }

        $this->fail('Twig function "has_property" not defined by extension');
    }

    public function test_defines_control_token_parser()
    {
        $extension = new ControlExtension();

        foreach ($extension->getTokenParsers() as $tokenParser) {
            if ($tokenParser instanceof ControlTokenParser) {
                return;
            }
        }

        $this->fail('ControlTokenParser not defined by extension');
    }

    public function test_property_function_returns_value_for_existing_property()
    {
        $extension = new ControlExtension();

        $this->assertEquals(2, $extension->propertyFunction($this->getData(), 'bar.a'));
    }

    /**
     * @expectedException \Symfony\Component\PropertyAccess\Exception\NoSuchPropertyException
     */
    public function test_property_function_throws_for_non_existing_property()
    {
        $extension = new ControlExtension();

        $this->assertEquals(2, $extension->propertyFunction($this->getData(), 'bar.x'));
    }

    public function test_has_property_returns_true_for_existing_property()
    {
        $extension = new ControlExtension();

        $this->assertTrue($extension->hasPropertyFunction($this->getData(), 'bar.a'));
    }

    public function test_has_property_returns_false_for_non_existing_property()
    {
        $extension = new ControlExtension();

        $this->assertFalse($extension->hasPropertyFunction($this->getData(), 'bar.x'));
    }

    private function getData()
    {
        return (object) array('foo' => 111, 'bar' => (object) ['a' => 2, 'b' => 3]);
    }
}
