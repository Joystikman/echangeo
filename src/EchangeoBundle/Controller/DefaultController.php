<?php

namespace EchangeoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('EchangeoBundle:Default:index.html.twig');
    }

    /**
     * @Route("/test")
     */
    public function testAction()
    {
        return $this->render('EchangeoBundle:Default:test.html.twig');
    }
}
