<?php

namespace Rahi\ApiBundle\Controller;

use AppBundle\Controller\AbstractAppController;

class DefaultController extends AbstractAppController
{
    public function indexAction()
    {
        return $this->render('RahiApiBundle:Default:index.html.twig');
    }
}
