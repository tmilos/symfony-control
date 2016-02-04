<?php

/*
 * This file is part of the Tmilos Symfony-Control package.
 *
 * (c) Milos Tomic <tmilos@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Tmilos\ControlBundle\Tests\DependencyInjection;

use Tmilos\ControlBundle\DependencyInjection\TmilosControlExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

class TmilosControlExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadsExtensionWithNoConfig()
    {
        $extension = new TmilosControlExtension();
        $containerBuilder = new ContainerBuilder(new ParameterBag());
        $extension->load([], $containerBuilder);

        $this->assertTrue($containerBuilder->hasDefinition('tmilos_control.twig.control_extension'));

        $definition = $containerBuilder->getDefinition('tmilos_control.twig.control_extension');
        $definition->hasTag('twig.extension');
    }
}
