<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Service\UploaderHelper;
use Gedmo\Sluggable\Util\Urlizer;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/user', name: 'user_')]
class UserController extends AbstractController
{
    private $em;
    private $userRepository;
    private $hasher;

    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $hasher, UserRepository $userRepository)
    {
        $this->em = $em;
        $this->userRepository = $userRepository;
        $this->hasher = $hasher;
    }
    
    #[Route('/register', name: 'register')]
    public function register(Request $request, UploaderHelper $uploaderHelper): Response
    {
        if($this->getUser()){
            return $this->disallowAccess;
        }

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $uploadedFile = $form['pictureFile']->getData();

            $newFilename = $uploaderHelper->uploadUserAvatar($uploadedFile);
            $user->setPicture($newFilename);

            $hashed = $this->hasher->hashPassword($user, $user->getPlainPassword());
            $user->setPassword($hashed);
            
            $this->em->persist($user);
            $this->em->flush();

            $this->addFlash('notice', 'Votre compte a bien été créé, vous pouvez vous connecter');
            return $this->redirectToRoute('user_login');
        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView(), 
        ]);
    }

    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if($this->getUser()){
            return $this->disallowAccess();
        }

        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('user/login.html.twig', [
            'error' => $error,
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout():Response{

        return $this->redirectToRoute('main_index');
    }

    private function disallowAccess():Response
    {
        $this->addFlash('info', 'Vous êtes déjà connecté, déconnectez vous pour changer de compte');

        return $this->redirectToRoute('main_index');
    }

    #[Route('/{id}', name: 'profil', requirements: ['id' => '\d+'])]
    public function profil($id):Response
    {
        {
            $user = $this->userRepository->find($id);
            
            return $this->render('user/profil.html.twig', [
                'user' => $user
            ]);
        }
    }
}
