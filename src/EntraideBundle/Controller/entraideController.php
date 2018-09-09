<?php

namespace EntraideBundle\Controller;

use Datetime;
use EntraideBundle\Entity\entraide;
use EntraideBundle\Repository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File;


/**
 * Entraide controller.
 *
 */
class entraideController extends Controller
{
    /**
     * Lists all entraide entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entraides = $em->getRepository('EntraideBundle:entraide')->findAll();

        $paginator =$this->get('knp_paginator');
        $result=$paginator->paginate(
            $entraides,
            $request->query->getInt('p',1),2
        );
        dump(get_class($paginator));
        return $this->render('entraide/index.html.twig', array(
            'entraides' => $result
        ));
    }

    /**
     * Creates a new entraide entity.
     *
     */
    public function newAction(Request $request)
    {
        $entraide = new Entraide();
        $form = $this->createForm('EntraideBundle\Form\entraideType', $entraide);
        $entraide->setDate(new Datetime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form['image']->getData()->move($entraide->getUploadRootDir(), $form['image']->getData()->getClientOriginalName());
            $entraide->setImage($form['image']->getData()->getClientOriginalName());
            $em = $this->getDoctrine()->getManager();
            $em->persist($entraide);
            $em->flush($entraide);

            return $this->redirectToRoute('entraide_show', array('id' => $entraide->getId()));
        }

        return $this->render('entraide/new.html.twig', array(
            'entraide' => $entraide,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a entraide entity.
     *
     */
    public function showAction(entraide $entraide)
    {
        $deleteForm = $this->createDeleteForm($entraide);

        $em=$this->getDoctrine()->getManager();
        $query=$em->getRepository('EntraideBundle:Entraide')->sumQB($entraide->getId());
        $queryView=$em->getRepository('EntraideBundle:Entraide')->viewQB($entraide->getId());
        $querycreation=$em->getRepository('EntraideBundle:Entraide')->creationDQL($entraide->getId());


        dump($querycreation);
//
//        var_dump($queryView);
//
//        var_dump($query);
        return $this->render('entraide/show.html.twig', array(
            'entraide' => $entraide,
            'delete_form' => $deleteForm->createView(),
            'somme'=>$query,
            'listes'=>$queryView,
            'creator'=> $querycreation
        ));
    }

    /**
     * Displays a form to edit an existing entraide entity.
     *
     */
    public function editAction(Request $request,entraide $entraide)
    {
        $deleteForm = $this->createDeleteForm($entraide);
        $editForm = $this->createForm('EntraideBundle\Form\entraideTypeEdit', $entraide);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $entraide->setDate(new \DateTime);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('entraide_show', array('id' => $entraide->getId()));
        }

        return $this->render('entraide/edit.html.twig', array(
            'entraide' => $entraide,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }



    /**
     * Deletes a entraide entity.
     *
     */
    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $entraide=$em->getRepository("EntraideBundle:entraide")->find($id);
        $em->remove($entraide);
        $em->flush();
        return $this->redirectToRoute('admin_entraide');
    }

    /**
     * Creates a form to delete a entraide entity.
     *
     * @param entraide $entraide The entraide entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(entraide $entraide)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('entraide_delete', array('id' => $entraide->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
    public function entraideAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entraides = $em->getRepository('EntraideBundle:Entraide')->findAll();

//        $query=$em->getRepository('EntraideBundle:Entraide')->sumQB($entraides[i]->getId());

        return $this->render('entraide/entraide.html.twig', array(
            'entraides' => $entraides,
//            'somme'=>$query,
        ));
    }
}
