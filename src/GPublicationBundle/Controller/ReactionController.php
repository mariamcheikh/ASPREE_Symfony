<?php

namespace GPublicationBundle\Controller;

use GPublicationBundle\Entity\Publication;
use GPublicationBundle\Entity\Reaction;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;


class ReactionController extends Controller
{
    /**
     * Lists all reaction entities.
     *
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reactions = $em->getRepository('GPublicationBundle:Reaction')->findAll();

        return $this->render('reaction/index.html.twig', array(
            'reactions' => $reactions,
        ));
    }

    /**
     * Creates a new reaction entity.
     *
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $reaction = new Reaction();
        $formReaction = $this->createForm('GPublicationBundle\Form\ReactionType', $reaction);


        $formReaction->handleRequest($request);

        if ($formReaction->isSubmitted() && $formReaction->isValid()) {
            $reaction->setUser($this->getUser());
            $em->persist($reaction);
            $em->flush();

            return $this->redirectToRoute('g_publication_Ajout');
        }

        return $this->render('GPublicationBundle:Publication:AjoutPub.html.twig', array(
            'reaction' => $reaction,
            'formReaction' => $formReaction->createView()
        ));
    }

    /**
     * Finds and displays a reaction entity.
     *
     * @Route("/{id}", name="reaction_show")
     * @Method("GET")
     */
    public function showAction(Reaction $reaction)
    {
        $deleteForm = $this->createDeleteForm($reaction);

        return $this->render('reaction/show.html.twig', array(
            'reaction' => $reaction,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reaction entity.
     *
     * @Route("/{id}/edit", name="reaction_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Reaction $reaction)
    {
        $deleteForm = $this->createDeleteForm($reaction);
        $editForm = $this->createForm('GPublicationBundle\Form\ReactionType', $reaction);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reaction_index');
        }

        return $this->render('reaction/edit.html.twig', array(
            'reaction' => $reaction,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reaction entity.
     *
     * @Route("/{id}", name="reaction_delete")
     * @Method("DELETE")
     */
    public function deleteAction($id)
    {


            $em = $this->getDoctrine()->getManager();
            $reaction = $em->getRepository("GPublicationBundle:Reaction")->find($id);
            $em->remove($reaction);
            $em->flush($reaction);


        return $this->redirectToRoute('g_publication_Ajout');
    }

    /**
     * Creates a form to delete a reaction entity.
     *
     * @param Reaction $reaction The reaction entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reaction $reaction)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reaction_delete', array('id' => $reaction->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
