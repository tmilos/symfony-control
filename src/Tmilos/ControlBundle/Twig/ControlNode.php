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

class ControlNode extends \Twig_Node
{
    /**
     * @param array                 $name
     * @param \Twig_Node_Expression $value
     * @param int                   $line
     * @param string                $tag
     */
    public function __construct($name, \Twig_Node_Expression $value, $line, $tag = null)
    {
        parent::__construct(array('value' => $value), array('name' => $name), $line, $tag);
    }

    /**
     * @param \Twig_Compiler $compiler
     */
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write('$context[\'control\'] = ')
            ->subcompile($this->getNode('value'))
            ->raw(";\n")

            ->write(sprintf("\$this->displayBlock('%s', \$context, \$blocks);\n", $this->getAttribute('name')))
        ;
    }
}
