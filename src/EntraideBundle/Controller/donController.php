<?php

namespace EntraideBundle\Controller;

use EntraideBundle\Entity\don;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Don controller.
 *
 */
class donController extends Controller
{
    /**
     * Lists all don entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dons = $em->getRepository('EntraideBundle:don')->findAll();

        return $this->render('don/index.html.twig', array(
            'dons' => $dons,
        ));
    }

    /**
     * Creates a new don entity.
     *
     */
    public function newAction(Request $request,$id)
    {
        $don = new Don();
        $form = $this->createForm('EntraideBundle\Form\donType', $don);
        $don->setDate(new \Datetime);

        $don->setUser($this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entraide = $em->getRepository("EntraideBundle:entraide")->find($id);
            $don->setEntraide($entraide);
            $em->persist($don);
            $em->flush($don);

            return $this->redirectToRoute('don_show', array('id' => $don->getId()));
        }

        return $this->render('don/new.html.twig', array(
            'don' => $don,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a don entity.
     *
     */
    public function showAction(don $don)
    {
        $deleteForm = $this->createDeleteForm($don);

        return $this->render('don/show.html.twig', array(
            'don' => $don,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing don entity.
     *
     */
    public function editAction(Request $request, don $don)
    {
        $deleteForm = $this->createDeleteForm($don);
        $editForm = $this->createForm('EntraideBundle\Form\donType', $don);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $don->setDate(new \DateTime);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('don_edit', array('id' => $don->getId()));
        }

        return $this->render('don/edit.html.twig', array(
            'don' => $don,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a don entity.
     *
     */
    public function deleteAction(Request $request, don $don)
    {
        $form = $this->createDeleteForm($don);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($don);
            $em->flush($don);
        }

        return $this->redirectToRoute('don_index');
    }

    /**
     * Creates a form to delete a don entity.
     *
     * @param don $don The don entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(don $don)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('don_delete', array('id' => $don->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
