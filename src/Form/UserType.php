<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Avatar;
use App\Entity\UserLevel;
use App\Entity\UserProfile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
                'label' => 'Nom d\'utilisateur'
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail'
            ])
            ->add('plainPassword', PasswordType::class,[
                'label' => 'Mot de passe'
            ])
            ->add('birthdate', BirthdayType::class, [
                'label'=>'Date de naissance',
                'widget' => 'single_text'
            ])
            ->add('picture', EntityType::class, [
                'class' => Avatar::class,
                'choice_label' => 'picture',
                'label' => 'Votre avatar',
            ])
            ->add('city', TextType::class, [
                'label' => 'Votre ville'
            ])
            ->add('profile', EntityType::class, [
                'class' => UserProfile::class,
                'choice_label' => 'name',
                'label'=> 'Votre profil',
                'by_reference' => 'false'
            ])
            ->add('level', EntityType::class, [
                'class' => UserLevel::class,
                'choice_label' => 'name',
                'label'=> 'Votre niveau d\'expérience'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ->add('cgu', CheckboxType::class, [
                'label' => 'J\'accepte les conditions générales d\'utilisation',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos CGU'
                    ]),
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
