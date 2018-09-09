<?php

namespace AmicaleBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AmicaleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomAmicale')->add('typeAmicale')->add('montantAmicale')->add('descriptionAmicale')->add('image', FileType::class, array(
            'label' => 'Votre photo : ','data_class' => null,'required'=>false))->add('user',EntityType::class,array('class'=>'UserBundle\Entity\User',
            'choice_label'=>'prenom', 'multiple'=>false));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AmicaleBundle\Entity\Amicale'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'amicalebundle_amicale';
    }


}
