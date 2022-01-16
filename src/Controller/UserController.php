<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Service\UploaderHelper;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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

    #[Route(' ', name: 'list')]
    public function usersList(Request $request): Response
    {
        //  Formulaire de recherche
        // $searchForm = $this->createForm(SearchUserype::class);
        // $searchForm->handleRequest($request);
        // $searchCriteria = $searchForm->getData();

        // $users = $this->userRepository->search($searchCriteria);  

        // Système de pagination
        $limit = 18;        
        $page = (int)$request->query->get("page", 1);  
        
        $users = $this->userRepository->getPaginatedUsers($page, $limit);       
        $total = $this->userRepository->getTotalUsers();   

        return $this->render('user/list.html.twig', [
            'users' => $users,
            'total' => $total,
            'limit' => $limit,
            'page' => $page,
            // 'searchForm' => $searchForm->createView(),
    
        ]);
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
        $this->addFlash('info', 'Vous êtes déconnecté(e)');

        return $this->redirectToRoute('main_index');
    }

    private function disallowAccess():Response
    {
        $this->addFlash('notice', 'Vous êtes déjà connecté(e), déconnectez vous pour changer de compte');

        return $this->redirectToRoute('main_index');
    }

    #[Route('/{id}', name: 'profile', requirements: ['id' => '\d+'])]
    public function profile($id):Response
    {
        {
            $user = $this->userRepository->find($id);
            
            return $this->render('user/profile.html.twig', [
                'user' => $user
            ]);
        }
    }

    /**
     * Editer pour pouvoir afficher le formulaire de modif' de profil
     */
    #[Route('/{id}/edit', name: 'edit', requirements: ['id' => '\d+'])]
    #[IsGranted('ROLE_USER')]
    public function edit(user $user, Request $request, UploaderHelper $uploaderHelper)
    {
        $form = $this->createForm(UserType::class, $user);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $uploadedFile = $form['pictureFile']->getData();

            $newFilename = $uploaderHelper->uploadUserAvatar($uploadedFile);
            $user->setPicture($newFilename);
            
            $this->em->persist($user);
            $this->em->flush();

            $this->addFlash('notice', 'Votre compte a bien été modifié');
            return $this->redirectToRoute('user_profile', [
                'id' => $user->getId(),
            ]);
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(), 
        ]);
    }
    
    #[Route('/{id}/delete', name: 'delete', requirements: ['id' => '\d+'])]
    public function delete($id){
        $user = $this->userRepository->find($id);
        $this->em->remove($user);
        $this->em->flush();

        $response = new Response();
        $response->send();

        $this->addFlash('notice', 'Votre compte a été supprimé.');
        return $this->redirectToRoute('main_index');
    }

}
