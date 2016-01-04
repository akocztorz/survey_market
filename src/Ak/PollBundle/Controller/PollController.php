<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 03.12.15
 * Time: 13:00
 */

namespace Ak\PollBundle\Controller;

use Ak\PollBundle\Entity\Poll;
use Ak\PollBundle\Entity\PollDefinition;
use Ak\PollBundle\Form\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class PollController
 * @package Ak\PollBundle\Controller
 */
class PollController extends Controller
{
    /**
     * Lists all Poll entities.
     *
     * @Route("/poll/{pollDefinition}", name="poll")
     *
     */
    public function indexAction(PollDefinition $pollDefinition)
    {
        $entities = $pollDefinition->getPolls();

        $html = $this->container->get('templating')->render(
            'poll/index.html.twig',
            [
                'pollList' => $entities,
                'pollDefinition' => $pollDefinition,
            ]
        );

        return new Response(
            $html
        );

    }

    /**
     * @param Request $request
     * @param PollDefinition $pollDefinition
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/poll/{pollDefinition}/create", name="poll_create")
     */
    public function createAction(Request $request, PollDefinition  $pollDefinition)
    {
        $entity = new Poll();
        $entity->setPollDefinition($pollDefinition);
        $entity->setLastAnsweredQuestion(0);
        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('poll', array('pollDefinition' => $pollDefinition->getId())));

    }



}