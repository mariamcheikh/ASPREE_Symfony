<?php

namespace EventsBundle\Form;

use blackknight467\StarRatingBundle\Form\RatingType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class eventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomEvent')->add('description', TextareaType::class)->add('dateDebut',DateType::class)->add('dateFin',DateType::class)
            ->add('lieu')->add('prix')->add('rating', RatingType::class, ['label' => 'Rating'])->add('image', FileType::class, array(
                'label' => 'Votre photo : ','data_class' => null))->add('agenda',EntityType::class,array('class'=>'EventsBundle\Entity\agenda',
        'choice_label'=>'description_agenda', 'multiple'=>false));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EventsBundle\Entity\event'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'eventsbundle_event';
    }


}
