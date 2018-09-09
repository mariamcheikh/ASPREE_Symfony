<?php

namespace AmicaleBundle\Controller;

use AmicaleBundle\Entity\Amicale;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Amicale controller.
 *
 */
class AmicaleController extends Controller
{
    /**
     * Afficher la listes de tous les Amicales
     *
     */

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $amicales = $em->getRepository('AmicaleBundle:Amicale')->findAll();

        return $this->render('amicale/index.html.twig', array(
            'amicales' => $amicales,
        ));
    }

    /**
     * Créer un nouveau Amicale
     *
     */
    public function newAction(Request $request)
    {
        $amicale = new Amicale();
        $form = $this->createForm('AmicaleBundle\Form\AmicaleType', $amicale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $form['image']->getData()->move($amicale->getUploadRootDir(), $form['image']->getData()->getClientOriginalName());
            $amicale->setImage($form['image']->getData()->getClientOriginalName());

            $em = $this->getDoctrine()->getManager();
            $em->persist($amicale);
            $em->flush($amicale);

            return $this->redirectToRoute('amicale_show', array('id' => $amicale->getId()));
        }

        return $this->render('amicale/new.html.twig', array(
            'amicale' => $amicale,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a amicale entity.
     *
     */
    public function showAction(Amicale $amicale)
    {
        $deleteForm = $this->createDeleteForm($amicale);
        $user=$this->getUser();
        return $this->render('amicale/show.html.twig', array(
            'amicale' => $amicale,
            'delete_form' => $deleteForm->createView(),'user'=>$user

        ));

    }

    /**
     * Afficher un form  pour modifier  un Amicale
     *
     */
    public function editAction(Request $request, Amicale $amicale)
    {
        $deleteForm = $this->createDeleteForm($amicale);
        $editForm = $this->createForm('AmicaleBundle\Form\AmicaleType', $amicale);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if ($amicale->getImage() != null) {
                $editForm['image']->getData()->move($amicale->getUploadRootDir(), $editForm['image']->getData()->getClientOriginalName());
                $amicale->setImage($editForm['image']->getData()->getClientOriginalName());


                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('amicale_edit', array('id' => $amicale->getId()));}

        }
        return $this->render('amicale/edit.html.twig', array(
            'amicale' => $amicale,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a amicale entity.
     *
     */
    public function deleteAction(Request $request, Amicale $amicale)
    {
        $form = $this->createDeleteForm($amicale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($amicale);
            $em->flush($amicale);
        }

        return $this->redirectToRoute('amicale_index');
    }

    /**
     * Creates a form to delete a amicale entity.
     *
     * @param Amicale $amicale The amicale entity
     *
     * @return \Symfony\Component\Form\Form The form
     */

    private function createDeleteForm(Amicale $amicale)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('amicale_delete', array('id' => $amicale->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function showuserAction(Amicale $amicale)
    {
        $deleteForm = $this->createDeleteForm($amicale);
        $em=$this->getDoctrine()->getManager();
        $amicale->setUser($this->getUser());
        $queryView=$em->getRepository('AmicaleBundle:Amicale')->viewQB($amicale->getUser());
        //var_dump($queryView);
        $user=$this->getUser();
        return $this->render('amicale/showforuseramicale.html.twig', array(
            'amicale' => $amicale,
            'delete_form' => $deleteForm->createView(),'user'=>$user,
            'liste'=>$queryView

        ));


    }



    public function visi1Action(Amicale $amicale)
    {
        $deleteForm = $this->createDeleteForm($amicale);
        $em=$this->getDoctrine()->getManager();
        $queryView=$em->getRepository('AmicaleBundle:Amicale')->view3QB(1);
        var_dump($queryView);
        $user=$this->getUser();
        return $this->render('amicale/visi1.html.twig', array(
            'amicale' => $amicale,
            'delete_form' => $deleteForm->createView(),'user'=>$user,
            'liste'=>$queryView

        ));


    }

    public function visibiliteAction($id)
    {
        $amicale = new Amicale();
        $em = $this  -> get('doctrine')->getManager();
        $amicale=$em->getRepository('AmicaleBundle:Amicale')->find($id);
        $vv = $amicale->getVisi();
        if($vv == 0){
            $amicale->setVisi(1);
        }else{
            $amicale->setVisi(0);
        }
        $em->persist($amicale);
        $em->flush();
        return $this->redirectToRoute('amicale_show', array('id' => $amicale->getId()));
    }






}
