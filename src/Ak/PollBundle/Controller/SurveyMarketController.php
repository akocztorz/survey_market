<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 14.01.16
 * Time: 09:24
 */

namespace Ak\PollBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class MainPageController - displays the main page
 * @package Ak\PollBundle\Controller
 */
class SurveyMarketController extends Controller
{
    /**
     * displays the main page
     * @Route("/surveyMarket", name="surveyMarket")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function indexAction()
    {
        return $this->render(
            'surveyMarket/index.html.twig',[]
        );
    }

}