<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class,[
            'label' => 'Votre nom',
            'attr' => [
                'placeholder' => 'Votre nom'
            ] 
        ])
        ->add('email', EmailType::class, [
            'label' => 'E-mail',
            'attr' => [
                'placeholder' => 'Renseignez votre adresse email'
            ]
        ])
        ->add('message', TextareaType::class,[
            'label' => 'Votre message',
            'attr' => [
                'placeholder' => 'Entrez votre message ici'
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
