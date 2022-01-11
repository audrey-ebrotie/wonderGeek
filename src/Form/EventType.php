<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom de l\'évènement'
            ])
            ->add('activity', null, [
                'choice_label' => 'name',
                'label' => 'Activité'
            ])
            ->add('category', null, [
                'choice_label' => 'name',
                'label' => 'Catégorie'
            ])
            ->add('gameLevel', TextType::class, [
                // 'choice_label' => 'name',
                'label' => 'Niveau de jeu requis'
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
            ->add('place', null, [
                'choice_label' => 'name',
                'label' => 'Lieu',
                'placeholder' => 'En ligne'
            ])
            ->add('capacity', null, [
                'label' => 'Nombre de places'
            ])
            ->add('description', null, [
                'attr' => [
                    'rows' => 10,
                ]
            ])
            ->add('picture', UrlType::class, [
                'label' => 'Image',
                'help' => 'Url de l\'image'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer'
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
