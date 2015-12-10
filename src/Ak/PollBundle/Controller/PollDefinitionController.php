<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 31.10.15
 * Time: 13:35
 */

namespace Ak\PollBundle\Controller;
use Ak\PollBundle\Entity\PollDefinition;
use Ak\PollBundle\Form\Type\PollDefinitionType;
use Ak\PollBundle\Form\Type\SearchType;
use Proxies\__CG__\Ak\PollBundle\Entity\Poll;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * Class PollDefinitionController
 * @package Ak\PollBundle\Controller
 */
class PollDefinitionController extends Controller
{

    /**
     * Lists all pollDefinition entities.
     *
     * @Route("/poll-definition", name="pollDefinition")
     *
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(new SearchType(), null, array(
            'method' => 'POST',
        ));

        $form->handleRequest($request);

        $name = "";
        $repository = $this->getDoctrine()->getRepository('AkPollBundle:PollDefinition');
        $queryBuilder = $repository->createQueryBuilder('pd');

        if ($form->isValid() && $form->isSubmitted()) {
            $formData = $form->getData();
            $name = '%' . $formData["name"] . '%';
            if (!empty($name)) {
                $queryBuilder
                    ->where(('pd.name like :name'))
                    ->setParameter('name', $name);
            }
        }

        $entities= $queryBuilder->getQuery()->getResult();
        $html = $this->container->get('templating')->render(
            'pollDefinition/index.html.twig',
            [
                'pollDefinitionList' => $entities,
                'name' => $name,
                'form' => $form->createView(),
            ]
        );

        return new Response(
            $html
        );

    }

    /**
     * Creates a new PollDefinition entity.
     *
     * @Route("/poll-definition/create", name="pollDefinition_create")
     */
    public function createAction(Request $request)
    {
        $entity = new PollDefinition();
        $form = $this->createForm(new PollDefinitionType(), $entity, array(
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Dodaj'));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pollDefinition_success', array('id' => $entity->getId(), 'changeType' => "created")));
        }
//        return $this->render('default/new1.html.twig', array(
//            'form' => $form->createView(),
//        ));

        return $this->render(
            'pollDefinition/form.html.twig',
            array('form' => $form->createView(),)
        );

    }

    /**
     * @Route("/poll-definition/{id}/show", name="pollDefinition_show")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AkPollBundle:PollDefinition')->find($id);

        $html= $this->container->get('templating')->render(
            'pollDefinition/show.html.twig',
            [
                'pollDefinition'=> $entity
            ]
        );

        return new Response(
            $html
        );
    }

    /**
     * @Route("/poll-definition/{id}/edit", name="pollDefinition_edit")
     */
    public function editAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AkPollBundle:PollDefinition')->find($id);


        $form = $this->createForm(new PollDefinitionType(), $entity, array(
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Zmień'));

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pollDefinition_success', array('id' => $id, 'changeType' => "edited")));
        }

        return $this->render(
            'pollDefinition/form.html.twig',
            array('form' => $form->createView(),)
        );

    }
    /**
     * @Route("/poll-definition/success/{changeType}/{id}", name="pollDefinition_success")
     */
    public function successAction($changeType, $id)
    {
        $html = $this->container->get('templating')->render(
            'pollDefinition/success.html.twig',
            [
                'changeType' => $changeType,
                'id' => $id,
            ]
        );

        return new Response(
            $html
        );
    }
}