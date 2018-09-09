<?php
/**
 * Created by PhpStorm.
 * User: aymen
 * Date: 07/02/2017
 * Time: 19:33
 */

namespace GPublicationBundle\Controller;

use GPublicationBundle\Entity\Fichier;
use GPublicationBundle\Entity\Publication;
use GPublicationBundle\Entity\Reaction;
use GPublicationBundle\Form\PubType;
use GPublicationBundle\Form\ReactionType;
use GPublicationBundle\Form\Type\AjoutFichier;
use GPublicationBundle\Form\Type\AjoutPForm;
use GPublicationBundle\GPublicationBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;
use GPublicationBundle\Controller\ReactionController;

/**
 * Publication controller.
 *
 * @Route("publication")
 */
class GPublicationController extends Controller
{
    /**
     * Lists all reaction entities.
     *
     * @Method("GET")
     */
    public function newAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $publication = new Publication();
        $reaction = new Reaction();
        $ReactionEdit = new Reaction();
        $fichier = new Fichier();
        $user = $this->getUser();
        $publication->setUser($user);
        $ReactionEdit->setUser($user);
        $reaction->setUser($user);
        $fichier->setPublication($publication);

        $EditComBuilder = $this->createFormBuilder($ReactionEdit);
        $EditComBuilder->add('publication', PubType::class, array('required' => false))
            ->add('id')
            ->add('contenu', TextareaType::class)
            ->add('avis', HiddenType::class)
            ->add('Valider', SubmitType::class)->add('Commenter', SubmitType::class);

        $formBuilder1 = $this->createFormBuilder($reaction);
        $formBuilder1->add('publication', PubType::class)
            ->add('contenu', TextareaType::class, array('required' => false))
            ->add('avis', HiddenType::class)
            ->add('Commenter', SubmitType::class)->add('Valider', SubmitType::class)->add('like', SubmitType::class)->add('dislike', SubmitType::class);

        $formBuilder = $this->createFormBuilder($fichier);
        $formBuilder->add('fichier', FileType::class, array('required' => false))
            ->add('publication', AjoutPForm::class)->add('lien');


        $formEditReaction = $EditComBuilder->getForm();
        $formReaction = $formBuilder1->getForm();


        $fichier->setPublication($publication);
        $form = $formBuilder->getForm();

        $form->handleRequest($request);
        $formReaction->handleRequest($request);
        $formEditReaction->handleRequest($request);

        //ajouterPub
        if ($form->isValid() && $form->isSubmitted()) {
            if ($fichier->getFichier() != null) {
                $file = $fichier->getFichier();
                $fileName = $this->get('app.file_uploader')->upload($file);
                $fichier->setFichier($fileName);
                $em->persist($fichier);
                $em->flush();
            } else {
                $publication = $fichier->getPublication();
                $em->persist($publication, $fichier);
                $em->flush();
            }
            return $this->redirectToRoute('g_publication_Ajout');

        }


        $publications = $em->getRepository('GPublicationBundle:Publication')->findAllD();
        $reactions = $em->getRepository('GPublicationBundle:Reaction')->findAll();

        //ajouterReaction
        if ('POST' === $request->getMethod()) {

            if ($request->request->has($formReaction->getName())) {

                if ($formReaction->isSubmitted() && $formReaction->get('Commenter')->isClicked()) {
                    $reaction->setPublication($em->getRepository("GPublicationBundle:Publication")->find($reaction->getIdPublication()));
                    $em->persist($reaction);
                    $em->flush();
                    return $this->redirectToRoute('g_publication_Ajout');

                }
                if ($formReaction->isSubmitted() && $formReaction->get('like')->isClicked()) {
                    $pub = $em->getRepository("GPublicationBundle:Publication")->find($reaction->getIdPublication());
                    $test = 0;

                    foreach ($pub->getReactions() as $r) {
                        if ($this->getUser() == $r->getUser() and $r->getAvis() != null) {
                            if ($r->getAvis() == 1) {
                                $test = 1;
                                $remove = $r;
                            }
                            if ($r->getAvis() == 2) {
                                $test = 2;
                                $remove = $r;
                            }
                        }
                    }
                    if ($test == 0) {
                        $pub->addLike();
                        $reaction->setAvis(1);
                        $reaction->setPublication($pub);
                        $em->persist($reaction);
                        $em->flush();
                    }
                    if ($test == 1) {
                        $pub->deleteLike();
                        $em->remove($remove);
                        $em->flush();
                    }
                    if ($test == 2) {
                        $pub->deleteDislike();
                        $pub->addLike();
                        $reaction->setAvis(1);
                        $reaction->setPublication($pub);
                        $em->persist($reaction);
                        $em->remove($remove);
                        $em->flush();
                    }


                    return $this->redirectToRoute('g_publication_Ajout');
                }
                if ($formReaction->isSubmitted() && $formReaction->get('dislike')->isClicked()) {
                    $pub = $em->getRepository("GPublicationBundle:Publication")->find($reaction->getIdPublication());

                    $test = 0;

                    foreach ($pub->getReactions() as $r) {
                        if ($this->getUser() == $r->getUser() and $r->getAvis() != null) {
                            if ($r->getAvis() == 2) {
                                $test = 1;
                                $remove = $r;
                            }
                            if ($r->getAvis() == 1) {
                                $test = 2;
                                $remove = $r;
                            }
                        }
                    }
                    if ($test == 0) {
                        $pub->addDislike();
                        $reaction->setAvis(2);
                        $reaction->setPublication($pub);
                        $em->persist($reaction);
                        $em->flush();
                    }
                    if ($test == 1) {
                        $pub->deleteDislike();
                        $em->remove($remove);
                        $em->flush();
                    }
                    if ($test == 2) {
                        $pub->deleteLike();
                        $pub->addDislike();
                        $reaction->setAvis(2);
                        $reaction->setPublication($pub);
                        $em->persist($reaction);
                        $em->remove($remove);
                        $em->flush();
                    }

                    return $this->redirectToRoute('g_publication_Ajout');
                }
            }

            if ($request->request->has($formEditReaction->getName())) {

                //ModifierReaction
                if ($formEditReaction->isSubmitted() && $formReaction->get('Valider')->isClicked()) {
                    $id = $ReactionEdit->getId();

                    $test = $em->getRepository("GPublicationBundle:Reaction")->find($id);
                    if (!$test) {
                        throw $this->createNotFoundException(
                            'Pas de reaction pour lid ' . $id
                        );
                    }
                    $test->setContenu($ReactionEdit->getContenu());
                    if ($ReactionEdit->getAvis() != null) {
                        $test->setAvis($ReactionEdit->getAvis());
                    }
                    $em->getRepository('GPublicationBundle:Reaction')->updateReaction($id, $test);
                    return $this->redirectToRoute('g_publication_Ajout');
                }
            }
        }


        foreach ($publications as $p) {
            $show = $formReaction->createView();
            $arrayForms[] = $show;


        }


        foreach ($reactions as $r) {
            $show1 = $formEditReaction->createView();
            $arrayEditForms[] = $show1;


        }


        return $this->render('GPublicationBundle:Publication:AjoutPub.html.twig',
            array('form' => $form->createView(),
                'publications' => $publications,
                'reactions' => $reactions,
                'arrayForms' => $arrayForms,
                'arrayEditForms' => $arrayEditForms,
                'publication' => $publication,
                'fichier' => $fichier,
            ));

    }


    public function updateAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();

        $publication = $em->getRepository("GPublicationBundle:Publication")->find($id);
        $formBuilder = $this->createFormBuilder($publication);
        // On ajoute les champs de l'entité que l'on veut à notre formulaire
        $formBuilder
            ->add('description', TextareaType::class);


        $form = $formBuilder->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em->persist($publication);
            $em->flush();
            return $this->redirectToRoute('g_publication_Ajout');

        }

        return $this->render('GPublicationBundle:Publication:Modifier.html.twig', array('form' => $form->createView(), 'publication' => $publication));

    }

    public function deleteAction(Request $request, $id)
    {
        {

            $em = $this->getDoctrine()->getManager();

            $Publication = $em->getRepository("GPublicationBundle:Publication")->find($id);
            $formBuilder = $this->createFormBuilder($Publication);


            $em->remove($Publication);
            $em->flush();


            // On redirige vers la page de visualisation de l'annonce nouvellement créée
            return $this->redirectToRoute('g_publication_Ajout');


        }
    }

    private function formShow()
    {
        $formBuilder1 = $this->createFormBuilder();
        $show = $formBuilder1->add('publication', PubType::class)->add('contenu', TextareaType::class)->add('avis', HiddenType::class)->add('Commenter', SubmitType::class)->getForm();


        return $show;
    }


}









