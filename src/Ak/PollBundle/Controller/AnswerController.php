<?php
/**
 * Created by PhpStorm.
 * User: aga
 * Date: 29.12.15
 * Time: 15:51
 */

namespace Ak\PollBundle\Controller;


use Ak\PollBundle\Entity\Poll;
use Ak\PollBundle\Form\Data\Question;
use Ak\PollBundle\Form\Type\QuestionType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class AnswerController -allows to fill in the poll and view it
 * @package Ak\PollBundle\Controller
 */
class AnswerController extends Controller
{

    /**
     * fills in the poll
     *
     * @param Request $request
     * @param Poll $poll
     * @param $position
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/poll/{poll}/answer/{position}", name="answer")
     * @Security("has_role('ROLE_POLLSTER')")
     *
     */
    public function fillInAction(Request $request, Poll $poll, $position)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $question = new Question($em);
        $question->setPoll($poll);
        $questionDefinition = $this->get('poll.question_definition_provider')->getQuestionDefinition($poll,$position);

        if($questionDefinition==null){
            $poll->setCompleted(true);
            $em->flush();
            return $this->redirect($this->generateUrl('poll_success',
                array('poll' => $poll->getId(),
                ))
            );
        }

        $question->setQuestionDefinition($questionDefinition);

        $form = $this->createForm(new QuestionType(), $question, array(
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Dalej'));

        $form->handleRequest($request);

        if ($form->isValid()) {

            $poll->setLastAnsweredQuestion($position);
            $em->flush();

            return $this->redirect($this->generateUrl('answer',
                array('poll' => $poll->getId() ,
                    'position' => $position+1,

                )));
        }

        return $this->render(
            'answer/form.html.twig',
            array('form' => $form->createView(),
                'poll' => $poll->getId(),
                'questionDefinition' => $questionDefinition,
                )
        );
    }

    /**
     * informs that the poll was completed
     * @param Poll $poll
     * @return Response
     * @throws \Exception
     * @throws \Twig_Error
     * @Route("/poll/{poll}/success" , name="poll_success")
     * @Method("GET")
     * @Security("has_role('ROLE_POLLSTER')")
     */
    public function successAction(Poll $poll)
    {

        $html = $this->container->get('templating')->render(
            'answer/success.html.twig',
            [
                'pollDefinition' => $poll->getPollDefinition(),
            ]
        );

        return new Response(
            $html
        );
    }

    /**
     * allows to view the poll
     * @param Poll $poll
     * @return Response
     * @throws \Exception
     * @throws \Twig_Error
     * @Route("poll/{poll}/show", name="poll_show")
     * @Security("has_role('ROLE_EMPLOYER') or has_role('ROLE_POLLSTER')")
     */
    public function showAction(Poll $poll)
    {

        $html = $this->container->get('templating')->render(
            'answer/show.html.twig',
            [
                'poll' => $poll,
            ]
        );

        return new Response(
            $html
        );


    }

}