<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'évènement'
            ])
            ->add('description', TextType::class, [
                'attr' => [
                    'rows' => 10,
                ]
            ])
            ->add('picture', UrlType::class,[
                'label' => 'Image',
                'help' => 'Url de l\'image'
            ])
            ->add('startAt', DateTimeType::class, [
                'label' => 'Date de début',
                'date_widget' => 'single_text'
            ])
            ->add('endAt', DateTimeType::class, [
                'label' => 'Date de fin',
                'date_widget' => 'single_text'
            ])
            ->add('capacity', NumberType::class, [
                'label' => 'Places disponibles'
            ])
            ->add('gameLevel', ChoiceType::class, [
                'choices'  => [
                    'Tous niveaux' => 'Tous niveaux',
                    'Débutant' => 'Débutant',
                    'Occasionnel' => 'Occasionnel',
                    'Intermédiaire' => 'Intermédiaire',
                    'Confirmé' => 'Confirmé',
                    'Professionnel' => 'Professionnel'
                ],
                'label' => 'Niveau de jeu requis'
            ])
            ->add('category', null, [
                'choice_label' => 'name',
                'label' => 'Categorie',
            ])
            ->add('place', null, [
                'choice_label' => 'name',
                'label' => 'Lieu',
                'placeholder' => 'En ligne',
            ])
            ->add('activity', null, [
                'choice_label' => 'name',
                'label' => 'Activité'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'button',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
            'attr' => [
                'novalidate' => 'novalidate',
            ]
        ]);
    }
}
