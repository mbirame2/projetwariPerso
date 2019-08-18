<?php

namespace App\Form;

use App\Entity\EnvoiArgent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnvoiArgentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('montantaverser')
            ->add('nomcomplet')
            ->add('telephone')
            ->add('adresse')
            ->add('pieceid')
            ->add('nomcompletReceveur')
            ->add('pieceidReceveur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EnvoiArgent::class,
        ]);
    }
}
