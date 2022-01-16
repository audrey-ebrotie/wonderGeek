<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\UserProfile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('query', SearchType::class, [
            'label' => false,
            'required'   => false,
            'attr' => [
                'placeholder' => 'Nom du joueur',
            ],
        ])
        ->add('profile', EntityType::class, [
            'label' => false,
            'class' => UserProfile::class,
            'choice_label' => 'name',
            'placeholder' => 'Filtrer par catégorie',
        ])
        
        ->add('submit', SubmitType::class, [
            'label' => '<i class="fas fa-search"></i>',
            'label_html' => true,
            'attr' => [
                'class' => 'button',
            ]
        ])
    ;
    $builder->setMethod('GET');
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
        ]);
    }
}
