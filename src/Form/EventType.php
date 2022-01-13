<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Place;
use App\Entity\UserLevel;
use App\Entity\EventActivity;
use App\Entity\EventCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
                'choices' => [
                    'Tous niveaux' => 'Tous niveaux',
                    'Débutant' => 'Débutant',
                    'Occasionnel' => 'Occasionnel',
                    'Intermédiaire' => 'Intermédiaire',
                    'Confirmé' => 'Confirmé', 
                    'Professionnel' => 'Professionnel'
                ],
                'label' => 'Niveau de jeu requis'
            ])
            ->add('category', EntityType::class, [
                'class' => EventCategory::class,
                'choice_label' => 'name',
                'label' => 'Categorie',
            ])
            ->add('place', EntityType::class, [
                'class' => Place::class,
                'choice_label' => 'name',
                'label' => 'Lieu',
                'placeholder' => 'En ligne',
            ])
            ->add('activity', EntityType::class, [
                'class' => EventActivity::class,
                'choice_label' => 'name',
                'label' => 'Activité'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'button btn-primary text-light',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
            'csrf_protection' => false,
            'attr' => [
                'novalidate' => 'novalidate',
            ]
        ]);
    }
}
