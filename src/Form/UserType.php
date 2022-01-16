<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\UserLevel;
use App\Entity\UserProfile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class,[
                'label' => 'Nom d\'utilisateur',
                'attr' => [
                    'placeholder' => 'Choisissez un nom d\'utilisateur'
                ] 
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
                'attr' => [
                    'placeholder' => 'Renseignez votre adresse email'
                ]
            ])
            ->add('plainPassword', PasswordType::class,[
                'label' => 'Mot de passe',
                'help' => 'Il doit contenir au minimum 6 caractères dont une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial',
                'attr' => [
                    'placeholder' => 'Renseignez un mot de passe'
                ]
            ])
            ->add('birthdate', BirthdayType::class, [
                'label'=>'Date de naissance',
                'widget' => 'single_text',
                'placeholder' => 'Renseignez votre date de naissance',
                'attr' => [
                    'class' => 'text-field'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'Sélectionnez votre ville'
                ]
            ])
            ->add('profile', EntityType::class, [
                'class' => UserProfile::class,
                'choice_label' => 'name',
                'label'=> 'Profil',
                'by_reference' => 'false',
                'placeholder' => 'Sélectionnez votre profil',
                'help' => 'Facultatif',
                'attr' => [
                    'class' => 'text-field'
                ]
            ])
            ->add('level', EntityType::class, [
                'class' => UserLevel::class,
                'choice_label' => 'name',
                'label' => 'Niveau',
                'placeholder' => 'Sélectionnez votre niveau d\'expérience en tant que joueur (facultatif)',
                'help' => 'Facultatif',
                'attr' => [
                    'class' => 'text-field'
                ]
            ])
            ->add('pictureFile', FileType::class, [
                'mapped' => false,
                'label' => 'Avatar',
                'constraints' => [
                    new Image([
                        'maxSize' => '1M'
                    ]),
                    new NotNull([
                        'message'  => 'Vous devez ajouter une image pour votre avatar'
                    ])
                ]
            ])
            ->add('cgu', CheckboxType::class, [
                'label' => 'J\'accepte les conditions générales d\'utilisation </a>',
                'label_html' => true,
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos CGU'
                    ]),
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'attr' => [
                'novalidate' => 'novalidate',
            ]
        ]);
    }
}
