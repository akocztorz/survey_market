<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 04.11.15
 * Time: 09:41
 */

namespace Ak\PollBundle\Controller;


use Ak\PollBundle\Entity\QuestionDefinitionMultipleChoice;
use Ak\PollBundle\Entity\QuestionDefinitionOpen;
use Ak\PollBundle\Entity\QuestionDefinitionRestrictedChoice;
use Ak\PollBundle\Entity\QuestionDefinitionSingleChoice;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Ak\PollBundle\Entity\QuestionDefinition;
use Ak\PollBundle\Entity\PollDefinition;
use Ak\PollBundle\Form\Type\QuestionDefinitionType;

/**
 * Class QuestionDefinitionController
 * @package Ak\PollBundle\Controller
 */
class QuestionDefinitionController extends Controller
{
    /**
     * @Route("/poll-definition/{pollDefinition}/question-definition", name="questionDefinition")
     * @Method("GET")
     */
    public function indexAction(PollDefinition $pollDefinition)
    {
        //questionDefinitionType hint w indexAction tworzy nowy PollDef i wyciąga dane z bazy poniższy kod nie jest koniczny. Tylko w kontrolerze!
//        $em = $this->getDoctrine()->getManager();
//        $pollDefinition = $em->getRepository("AkPollBundle:PollDefinition")->find($pollDefinition);
        $entities = $pollDefinition->getQuestionsDefinitions();

        $html = $this->container->get('templating')->render(
            'questionDefinition/index.html.twig',
            [
                'questionDefinitionList' => $entities,
                'pollDefinition' => $pollDefinition,
            ]
        );

        return new Response(
            $html
        );

    }


    /**
     * @Route("/poll-definition/{pollDefinition}/question-definition/create/{questionDefinitionType}", name="questionDefinition_create")
     */
    public function createAction(Request $request, PollDefinition $pollDefinition, $questionDefinitionType)
    {
        if($questionDefinitionType == 'open'){
            $entity = new QuestionDefinitionOpen();
        }
        elseif($questionDefinitionType == 'single_choice'){
            $entity = new QuestionDefinitionSingleChoice();
        }
        elseif($questionDefinitionType == 'multiple_choice'){
            $entity = new QuestionDefinitionMultipleChoice();
        }
        elseif($questionDefinitionType == 'restricted_choice'){
            $entity = new QuestionDefinitionRestrictedChoice();
        }

        $entity->setPollDefinition($pollDefinition);

        $form = $this->createForm(new QuestionDefinitionType(), $entity, array(
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Dodaj'));

        $form->handleRequest($request);


        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();



            return $this->redirect($this->generateUrl('questionDefinition_show',
                array('pollDefinition' => $pollDefinition->getID(),
                        'id' => $entity->getId(),
                        'questionDefinitionType' => $questionDefinitionType,
                )));
        }
//        return $this->render('default/new1.html.twig', array(
//            'form' => $form->createView(),
//        ));

        return $this->render(
            'questionDefinition/form.html.twig',
            array('form' => $form->createView(),
                )
        );

    }

    /**
     * @Route("/poll-definition/{pollDefinition}/question-definition/{id}/show", name="questionDefinition_show")
     */
    public function showAction(PollDefinition $pollDefinition, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("AkPollBundle:questionDefinition")->find($id);

        $html= $this->container->get('templating')->render(
            'questionDefinition/show.html.twig',
            [
                'questionDefinition'=> $entity,
                'pollDefinition' => $pollDefinition,
                //'questionDefinitionType' => $questionDefinitionType,
            ]
        );

        return new Response(
            $html
        );
    }

    /**
     * @Route("/poll-definition/{pollDefinition}/question-definition/{id}/edit", name="questionDefinition_edit")
     */
    public function editAction(Request $request,PollDefinition $pollDefinition, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("AkPollBundle:questionDefinition")->find($id);


        $form = $this->createForm(new QuestionDefinitionType(), $entity, array(
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('questionDefinition_show',
                array('pollDefinition' =>$pollDefinition->getId(), 'id' =>$entity->getId() )));
        }

        return $this->render(
            'questionDefinition/form.html.twig',
            array('form' => $form->createView(),)
        );

    }

}