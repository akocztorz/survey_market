<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 08.11.15
 * Time: 09:29
 */

namespace Ak\PollBundle\Controller;

use Ak\PollBundle\Entity\OptionDefinition;
use Ak\PollBundle\Entity\OptionDefinitionOpen;
use Ak\PollBundle\Entity\OptionDefinitionChoice;
use Ak\PollBundle\Entity\QuestionDefinitionMultipleChoice;
use Ak\PollBundle\Entity\QuestionDefinitionOpen;
use Ak\PollBundle\Entity\QuestionDefinitionRestrictedChoice;
use Ak\PollBundle\Entity\QuestionDefinitionSingleChoice;
use Ak\PollBundle\Form\Type\OptionDefinitionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Ak\PollBundle\Entity\QuestionDefinition;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * Class OptionDefinitionController -allows to view option definitions for specific question, allows to add, view, edit and remove option definition
 * @package Ak\PollBundle\Controller
 */
class OptionDefinitionController extends Controller
{
    /**
     * displayes option definitions for specific question
     * @Route("/question-definition/{questionDefinition}/option-definition", name="optionDefinition")
     * @Method("GET")
     * @Security("has_role('ROLE_EMPLOYER')")
     * @param $questionDefinition
     * @return Response
     * @throws \Exception
     * @throws \Twig_Error
     */
    public function indexAction($questionDefinition)
    {
        $em = $this->getDoctrine()->getManager();
        $questionDefinition = $em->getRepository("AkPollBundle:QuestionDefinition")->find($questionDefinition);
        $entities = $questionDefinition->getOptionDefinitions();

        $html = $this->container->get('templating')->render(
            'optionDefinition/index.html.twig',
            [
                'optionDefinitionList' => $entities,
                'questionDefinition' => $questionDefinition,
                'pollDefinition' => $questionDefinition->getPollDefinition(),
            ]
        );

        return new Response(
            $html
        );
    }

    /**
     * creates new OptionDefinition entity
     * @param Request $request
     * @param QuestionDefinition $questionDefinition
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/question-definition/{questionDefinition}/option-definition/create", name="optionDefinition_create")
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function createAction(Request $request, QuestionDefinition $questionDefinition)
    {
            $entity = new OptionDefinitionChoice();
            $entity->setQuestionDefinitionChoice($questionDefinition);

            $form = $this->createForm(new OptionDefinitionType(), $entity, array(
                'method' => 'POST',
            ));

            $form->add('submit', 'submit', array('label' => 'Dodaj'));

            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();



                return $this->redirect($this->generateUrl('optionDefinition_show',
                    array('questionDefinition' =>$questionDefinition->getId(),
                        'id' => $entity->getId(),
                    )));
            }


            return $this->render(
                'optionDefinition/form.html.twig',
                array('form' => $form->createView())
            );
    }

    /**
     * displayes an option definition
     * @param QuestionDefinition $questionDefinition
     * @param $id
     * @return Response
     * @throws \Exception
     * @throws \Twig_Error
     * @Route("/question-definition/{questionDefinition}/option-definition/{id}/show", name="optionDefinition_show")
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function showAction(QuestionDefinition $questionDefinition, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("AkPollBundle:optionDefinition")->find($id);

        $html= $this->container->get('templating')->render(
            'optionDefinition/show.html.twig',
            [
                'optionDefinition'=> $entity,
                'questionDefinition' => $questionDefinition,
            ]
        );

        return new Response(
            $html
        );
    }

    /**
     * edits an option definition
     * @param Request $request
     * @param QuestionDefinition $questionDefinition
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/question-definition/{questionDefinition}/option-definition/{id}/edit", name="optionDefinition_edit")
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function editAction(Request $request,QuestionDefinition $questionDefinition, $id)
    {
        $entity = new OptionDefinitionChoice();
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("AkPollBundle:optionDefinition")->find($id);


        $form = $this->createForm(new OptionDefinitionType(), $entity, array(
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('optionDefinition_show',
                array('questionDefinition' =>$questionDefinition->getId(), 'id' =>$entity->getId())));
        }

        return $this->render(
            'optionDefinition/form.html.twig',
            array('form' => $form->createView(),
            )
        );

    }

    /**
     * soft deletes of an optionDefinition
     * @param OptionDefinition $optionDefinition
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/question-definition/{questionDefinition}/option-definition/{id}/inactivate", name="optionDefinition_inactivate")
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function inactivateAction(OptionDefinition $optionDefinition)
    {
        $em = $this->getDoctrine()->getManager();
        $optionDefinition->setInactivated(true);
        $em->flush();

        return $this->redirect($this->generateUrl('optionDefinition', array(
            'questionDefinition' => $optionDefinition->getQuestionDefinition()->getId(),
            'id' => $optionDefinition->getId(),))
        );

    }

}