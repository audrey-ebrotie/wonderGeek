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
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
                'label' => 'Nom de l\'évènement',
                'attr' => [
                    'placeholder' => 'Exemple: Party Lan Dota 2'
                ]        
            ])
            ->add('description', TextType::class, [
                'attr' => [
                    'rows' => 10,
                    'placeholder' => 'Vous pouvez indiquer une description pour votre évènement (facultatif)'
                ],
            ])
            ->add('startAt', DateTimeType::class, [
                'label' => 'Date de début',
                'date_widget' => 'single_text'
            ])
            ->add('endAt', DateTimeType::class, [
                'label' => 'Date de fin',
                'date_widget' => 'single_text',
                'attr' => [
                    'class' => 'text-field'
                ]
            ])
            ->add('capacity', NumberType::class, [
                'label' => 'Places disponibles',
                'attr' => [
                    'placeholder' => 'Indiquez le nombre de places disponibles. Laissez le champ vide si il n\'y a pas de limite'
                ]
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
                'label' => 'Niveau de jeu requis',
                'placeholder' => 'Sélectionnez le niveau de jeu requis',
                'attr' => [
                    'class' => 'text-field'
                ]
            ])
            ->add('category', EntityType::class, [
                'class' => EventCategory::class,
                'choice_label' => 'name',
                'label' => 'Categorie',
                'placeholder' => 'Sélectionnez une catégorie pour votre évènement',
                'attr' => [
                    'class' => 'text-field'
                ]
            ])
            ->add('place', EntityType::class, [
                'class' => Place::class,
                'choice_label' => 'name',
                'label' => 'Lieu',
                'placeholder' => 'Sélectionnez un lieu. Laissez le champ vide si l\'évènement se déroule en ligne',
                'attr' => [
                    'class' => 'text-field'
                ]
            ])
            ->add('activity', EntityType::class, [
                'class' => EventActivity::class,
                'choice_label' => 'name',
                'label' => 'Activité', 
                'placeholder' => 'Sélectionnez le type d\'activité concerné',
                'attr' => [
                    'class' => 'text-field'
                ]
            ])
            ->add('pictureFile', FileType::class, [
                'mapped' => false,
                'label' => 'Image de l\'évènement'
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
