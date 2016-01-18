<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 26.11.15
 * Time: 10:47
 */

namespace Ak\PollBundle\Controller;




use Ak\PollBundle\Entity\Deal;
use Ak\PollBundle\Entity\Offer;
use Ak\PollBundle\Entity\User;
use Ak\PollBundle\Form\Type\DealType;
use Ak\PollBundle\Form\Type\OfferType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Ak\PollBundle\Entity\PollDefinition;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class OfferController
 * @package Ak\PollBundle\Controller
 *
 */
class OfferController extends Controller
{
    /**
     * @Route("/offer", name="offer")
     * @Method("GET")
     * @Security("has_role('ROLE_POLLSTER') or has_role('ROLE_EMPLOYER')")
     *
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
     * @Security("has_role('ROLE_EMPLOYER') or has_role('ROLE_POLLSTER')")
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
     * @Route("/offer/create/{pollDefinition}", name="offer_create")
     * @Security("has_role('ROLE_EMPLOYER')")
     *
     */
    public function createAction(Request $request, PollDefinition  $pollDefinition)
    {
        $entity = new Offer();
        $entity->setPollDefinition($pollDefinition);
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
            array('form' => $form->createView(),
            )
        );

    }

    /**
     * @Route("/offer/{id}/show", name="offer_show")
     * @Security("has_role('ROLE_EMPLOYER') or has_role('ROLE_POLLSTER')")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $offer = $em->getRepository('AkPollBundle:Offer')->find($id);
        $deals = $em->getRepository('AkPollBundle:Deal')->findBy( array('offer' => $id));

        $html= $this->container->get('templating')->render(
            'offer/show.html.twig',
            [
                'offer'=> $offer,
                'deals' => $deals,
                'isAccepted' => false,
            ]
        );

        return new Response(
            $html
        );
    }

    /**
     * @Route("/offer/{id}/edit", name="offer_edit")
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function editAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AkPollBundle:Offer')->find($id);


        $form = $this->createForm(new OfferType(), $entity, array(
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Zmień'));

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('offer_show', array('id' => $id)));
        }

        return $this->render(
            'offer/form.html.twig',
            array('form' => $form->createView(),
                'id' => $id,
            ));

    }

    /**
     * @Route("/offer/{offer}/inactivate", name="offer_inactivate")
     * @param Offer $offer
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_EMPLOYER')")
     *
     */
    public function inactivateAction(Offer $offer)
    {
        $em = $this->getDoctrine()->getManager();
        $offer->setInactivated(true);
        $em->flush();

        return $this->redirect($this->generateUrl('offer', array('pollDefinition' => $offer->getPollDefinition()->getId())));

    }

    /**
     * @Route("/offer/{offer}/seal", name="offer_seal")
     * @param Offer $offer
     * @Security("has_role('ROLE_EMPLOYER')")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function sealAction(Offer $offer)
    {
        $em = $this->getDoctrine()->getManager();
        if(count($offer->getPollDefinition()->getQuestionsDefinitions()) > 0){
            $offer->setSealed(true);
            $em->flush();
        }
//        else{
//
//        }
        return $this->redirect($this->generateUrl('offer', array('pollDefinition' => $offer->getPollDefinition()->getId())));

    }

    /**
     * @Route("/offer/{offer}/{user}/accept", name="offer_accept")
     * @param Offer $offer
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_POLLSTER')")
     */
    public function acceptAction(Request $request, Offer $offer, User $user)
    {
        $deal = new Deal();
        $deal->setUser($user);
        $deal->setOffer($offer);
        $em = $this->getDoctrine()->getManager();


        $form = $this->createForm(new DealType, $deal, array(
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Akceptuj'));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $offer->setQuantity($offer->getQuantity() - $deal->getQuantity());
            $em->persist($deal);
            $em->flush();

            return $this->redirect($this->generateUrl('offer_show', array('id' => $offer->getId())));
        }

        return $this->render(
            'offer/deal.html.twig',
            array('form' => $form->createView(),
            )
        );
    }

    }