<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom de l\'évènement'
            ])
            ->add('description', null, [
                'attr' => [
                    'rows' => 10,
                ]
            ])
            ->add('pictureUrl', UrlType::class,[
                'label' => 'Image',
                'help' => 'Url de l\'image'
            ])
            ->add('startAt', null, [
                'label' => 'Date de début',
                'date_widget' => 'single_text',
                'time_widget' => 'single_text'
            ])
            ->add('endAt', null, [
                'label' => 'Date de fin',
                'date_widget' => 'single_text',
                'time_widget' => 'single_text'
            ])
            ->add('capacity')
            ->add('category', null, [
                'choice_label' => 'name',
                'label' => 'Categorie',
            ])
            ->add('place', null, [
                'choice_label' => 'name',
                'label' => 'Lieu',
                'placeholder' => 'A distance',
            ])
            ->add('activity', ChoiceType::class, [
                'choices'  => [
                    'Toutes activités' => null,
                    'Jeux de société' => false,
                    'Jeux vidéos' => false,
                    'Manga' => false,
                    'Comic' => false,
            ]])            
            ->add('GameLevel', ChoiceType::class,[
                'choices'  => [
                    'Tous niveaux' => null,
                    'Debutant' => false,
                    'Occasionnel' => false,
                    'Intermediaire' => false,
                    'Confirmé' => false,
                    'Professionnel' => false,
            ]])
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
        ]);
    }
}