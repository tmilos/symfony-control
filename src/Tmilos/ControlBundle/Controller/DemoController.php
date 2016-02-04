<?php

/*
 * This file is part of the Tmilos Symfony-Control package.
 *
 * (c) Milos Tomic <tmilos@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Tmilos\ControlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DemoController extends Controller
{
    public function indexAction()
    {
        $data = [
            ['id' => 1, 'email' => 'js@gmail.com', 'name' => 'John Smith'],
            ['id' => 2, 'email' => 'm.jane@yahoo.com', 'name' => 'Marry Jane'],
            ['id' => 3, 'email' => 'baldy@yahoo.com', 'name' => 'Bald Ysmen'],
            ['id' => 4, 'email' => 'selak@gmail.com', 'name' => 'Anna Selak'],
        ];

        return $this->render('@TmilosControl/Demo/index.html', [
            'data' => $data,
        ]);
    }
}
