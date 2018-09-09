<?php

namespace EventsBundle\Controller;

use Doctrine\ORM\Events;
use EventsBundle\Entity\event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Event controller.
 *
 */
class eventController extends Controller
{
    /**
     * Lists all event entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('EventsBundle:event')->findAll();

        return $this->render('event/index.html.twig', array(
            'events' => $events,
        ));
    }
    public function index1Action()
    {
        $name='name';
        return $this->render('EventsBundle:Default:index.html.twig',array('name'=>$name));
    }

    /**
     * Creates a new event entity.
     *
     */
    public function newAction(Request $request)
    {
        $event = new Event();
        $form = $this->createForm('EventsBundle\Form\eventType', $event);
        $event->setUser($this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form['image']->getData()->move($event->getUploadRootDir(), $form['image']->getData()->getClientOriginalName());
            $event->setImage($form['image']->getData()->getClientOriginalName());
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush($event);

            return $this->redirectToRoute('event_show', array('id' => $event->getId()));
        }
        else var_dump("foooooo");

        return $this->render('event/new.html.twig', array(
            'event' => $event,
            'form' => $form->createView(),
        ));
    }

    public function visibiliteAction($id)
    {
        $event = new Event();
        $em = $this -> get('doctrine')->getEntityManager();
        $event=$em->getRepository('EventsBundle:event')->find($id);
        $vv = $event->getVisibilite();
        if($vv == 0){
            $event->setVisibilite(1);
        }else{
            $event->setVisibilite(0);
        }
        $em->persist($event);
        $em->flush();
        return $this->redirectToRoute('event_show', array('id' => $event->getId()));
    }

    /**
     * Finds and displays a event entity.
     *
     */
    public function showAction(event $event)
    {
        $deleteForm = $this->createDeleteForm($event);

        return $this->render('event/show.html.twig', array(
            'event' => $event,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing event entity.
     *
     */
    public function editAction(Request $request, event $event)
    {
        $deleteForm = $this->createDeleteForm($event);
        $editForm = $this->createForm('EventsBundle\Form\eventType', $event);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('event_show', array('id' => $event->getId()));

        }
            return $this->render('event/edit.html.twig', array(
                'event' => $event,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));

    }
    /**
     * Deletes a event entity.
     *
     */
    public function deleteAction(Request $request, event $event)
    {
        $form = $this->createDeleteForm($event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush($event);
        }

        return $this->redirectToRoute('event_new');
    }

    /**
     * Creates a form to delete a event entity.
     *
     * @param event $event The event entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(event $event)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('event_delete', array('id' => $event->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


}
