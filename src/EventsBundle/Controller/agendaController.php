<?php

namespace EventsBundle\Controller;

use EventsBundle\Entity\agenda;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Agenda controller.
 *
 */
class agendaController extends Controller
{
    /**
     * Lists all agenda entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $agendas = $em->getRepository('EventsBundle:agenda')->findAll();

        return $this->render('agenda/index.html.twig', array(
            'agendas' => $agendas,
        ));
    }

    /**
     * Creates a new agenda entity.
     *
     */
    public function newAction(Request $request)
    {
        $agenda = new Agenda();
        $form = $this->createForm('EventsBundle\Form\agendaType', $agenda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($agenda);
            $em->flush($agenda);

            return $this->redirectToRoute('agenda_show', array('id' => $agenda->getId()));
        }

        return $this->render('agenda/new.html.twig', array(
            'agenda' => $agenda,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a agenda entity.
     *
     */
    public function showAction(agenda $agenda)
    {
        $deleteForm = $this->createDeleteForm($agenda);

        return $this->render('agenda/show.html.twig', array(
            'agenda' => $agenda,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing agenda entity.
     *
     */
    public function editAction(Request $request, agenda $agenda)
    {
        $deleteForm = $this->createDeleteForm($agenda);
        $editForm = $this->createForm('EventsBundle\Form\agendaType', $agenda);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('agenda_edit', array('id' => $agenda->getId()));
        }

        return $this->render('agenda/edit.html.twig', array(
            'agenda' => $agenda,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a agenda entity.
     *
     */
    public function deleteAction(Request $request, agenda $agenda)
    {
        $form = $this->createDeleteForm($agenda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($agenda);
            $em->flush($agenda);
        }

        return $this->redirectToRoute('agenda_index');
    }

    /**
     * Creates a form to delete a agenda entity.
     *
     * @param agenda $agenda The agenda entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(agenda $agenda)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agenda_delete', array('id' => $agenda->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
