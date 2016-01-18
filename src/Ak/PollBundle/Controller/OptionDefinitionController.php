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
 * Class OptionDefinitionController
 * @package Ak\PollBundle\Controller
 */
class OptionDefinitionController extends Controller
{
    /**
     * @Route("/question-definition/{questionDefinition}/option-definition", name="optionDefinition")
     * @Method("GET")
     * @Security("has_role('ROLE_EMPLOYER')")
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

}