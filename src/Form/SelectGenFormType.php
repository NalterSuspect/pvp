<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SelectGenFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('select_field', ChoiceType::class, [
                'choices' => [
                    'Gen 1' => 1,
                    'Gen 2' => 2,
                    'Gen 3' => 3,
                    'Gen 4' => 4,
                    'Gen 5' => 5,
                    'Gen 6' => 6,
                    'Gen 7' => 7,
                    'Gen 8' => 8,
                    'Gen 9' => 9,
                ],
                'placeholder' => 'Choose a generation', // Ajoute une valeur vide
                'required' => true, // Le champ est requis par défaut
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
