<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 31.10.15
 * Time: 13:35
 */

namespace Ak\PollBundle\Controller;
use Ak\PollBundle\Entity\PollDefinition;
use Ak\PollBundle\Entity\User;
use Ak\PollBundle\Form\Type\PollDefinitionType;
use Ak\PollBundle\Form\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * Class PollDefinitionController - allows to view all poll definitions, specific poll definition, allows to add, edit and remove poll definition
 * @package Ak\PollBundle\Controller
 */
class PollDefinitionController extends Controller
{

    /**
     * lists all pollDefinition entities.
     * @param Request $request
     * @return Response
     * @throws \Exception
     * @throws \Twig_Error
     * @Route("/poll-definition", name="pollDefinition")
     * @Security("has_role('ROLE_EMPLOYER')")
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
     * creates a new PollDefinition entity.
     * @param Request $request
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/poll-definition/create/{user}", name="pollDefinition_create")
     * @Security("has_role('ROLE_EMPLOYER')")
     * creating new poll definition
     */
    public function createAction(Request $request, User $user)
    {
        $entity = new PollDefinition();
        $form = $this->createForm(new PollDefinitionType(), $entity, array(
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Dodaj'));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setUser($user);
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
     * views all poll definitions
     * @param $id
     * @return Response
     * @throws \Exception
     * @throws \Twig_Error
     * @Route("/poll-definition/{id}/show", name="pollDefinition_show")
     * @Security("has_role('ROLE_EMPLOYER')")
     * viewing poll definition
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
     * edits poll definition
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/poll-definition/{id}/edit", name="pollDefinition_edit")
     * @Security("has_role('ROLE_EMPLOYER')")
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
     * informs that completed operation was successful
     * @Route("/poll-definition/success/{changeType}/{id}", name="pollDefinition_success")
     * @Security("has_role('ROLE_EMPLOYER')")
     * @param $changeType
     * @param $id
     * @return Response
     * @throws \Exception
     * @throws \Twig_Error
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

    /**
     * soft deletes poll definition
     * @Route("/poll-definition/{pollDefinition}/inactivate", name="pollDefinition_inactivate")
     * @Security("has_role('ROLE_EMPLOYER')")
     * @param PollDefinition $pollDefinition
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function inactivateAction(PollDefinition $pollDefinition)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AkPollBundle:PollDefinition')->find($pollDefinition->getId());
        $entity->setInactivated(true);
        $em->flush();

        return $this->redirect($this->generateUrl('pollDefinition'));
    }
}