<?php

namespace Rahi\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RahiApiBundle:Default:index.html.twig');
    }
}
