<?php

namespace Ak\PollBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class DefaultController - displayes the homepage
 * @package Ak\PollBundle\Controller
 */
class DefaultController extends Controller
{

    /**
     * @Route("/test")
     * @Template()
     */
    public function testAction()
    {
        return [];
    }

    /**
     * displayes the homepage
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('surveyMarket/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }
}
