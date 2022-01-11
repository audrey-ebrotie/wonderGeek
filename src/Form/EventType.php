<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('picture', UrlType::class,[
                'label' => 'Image',
                'help' => 'Url de l\'image'
            ])
            ->add('startAt', null, [
                'label' => 'Date de fin',
                'date_widget' => 'single_text',
                'time_widget' => 'single_text'
            ])
            ->add('endAt')
            ->add('capacity', null, [
                'label' => 'Places disponibles'
            ])
            ->add('gameLevel', ChoiceType::class, [
                'choices'  => [
                    'Tous niveaux' => 'true',
                    'Débutant' => 'true',
                    'Occasionnel' => 'true',
                    'Intermédiaire' => 'true',
                    'Confirmé' => 'true',
                    'Professionnel' => 'true'
            ]])
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
        ]);
    }
}
