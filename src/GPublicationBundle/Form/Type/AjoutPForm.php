<?php
/**
 * Created by PhpStorm.
 * User: aymen
 * Date: 07/02/2017
 * Time: 19:51
 */
namespace GPublicationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Button;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use GPublicationBundle\Entity\Publication;
use GPublicationBundle\Entity\Fichier;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AjoutPForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder

            ->add ('description', TextareaType::class)
            ->setMethod('GET')
        ;



    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
        'data_class' => 'GPublicationBundle\Entity\Publication'
    ));

    }


}
