<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 26.11.15
 * Time: 10:47
 */

namespace Ak\PollBundle\Controller;




use Ak\PollBundle\Entity\Offer;
use Ak\PollBundle\Form\Type\OfferType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Ak\PollBundle\Entity\PollDefinition;

/**
 * Class OfferController
 * @package Ak\PollBundle\Controller
 */
class OfferController extends Controller
{
    /**
     * @Route("/offer", name="offer")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository("AkPollBundle:Offer")->findAll();

        $html = $this->container->get('templating')->render(
            'offer/index.html.twig',
            [
                'offerList' => $entities,
            ]
        );

        return new Response(
            $html
        );
    }

    /**
     * @Route("/{pollDefinition}/offer", name="show_for_pollDefinition_offer")
     * @Method("GET")
     */
    public function showForPollDefinitionAction(PollDefinition $pollDefinition)
    {
        $em = $this->getDoctrine()->getManager();
        $pollDefinition = $em->getRepository("AkPollBundle:PollDefinition")->find($pollDefinition);
        $entities = $pollDefinition->getOffers();

        $html = $this->container->get('templating')->render(
            'offer/showForPollDefinition.html.twig',
            [
                'offerList' => $entities,
                'pollDefinition' => $pollDefinition,
            ]
        );

        return new Response(
            $html
        );
    }


    /**
     * Creates a new Offer entity.
     *
     * @Route("/offer/create", name="offer_create")
     */
    public function createAction(Request $request)
    {
        $entity = new Offer();
        $form = $this->createForm(new OfferType(), $entity, array(
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Dodaj'));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('offer_show', array('id' => $entity->getId())));
        }

        return $this->render(
            'offer/form.html.twig',
            array('form' => $form->createView(),)
        );

    }

    /**
     * @Route("/offer/{id}/show", name="offer_show")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AkPollBundle:Offer')->find($id);

        $html= $this->container->get('templating')->render(
            'offer/show.html.twig',
            [
                'offer'=> $entity
            ]
        );

        return new Response(
            $html
        );
    }

    /**
     * @Route("/offer/{id}/edit", name="offer_edit")
     */
    public function editAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AkPollBundle:Offer')->find($id);


        $form = $this->createForm(new OfferType(), $entity, array(
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('offer_show', array('id' => $id)));
        }

        return $this->render(
            'offer/form.html.twig',
            array('form' => $form->createView(),)
        );

    }

    }