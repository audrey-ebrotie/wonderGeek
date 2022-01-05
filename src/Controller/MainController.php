<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('', name: 'main_')]
class MainController extends AbstractController
{

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig');
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('main/contact.html.twig');
    }

    #[Route('/about', name: 'about')]
    public function about(): Response
    {

        return new Response("Page à propos");
    }

    #[Route('/register',name:'register')]
    public function register(): Response
    {   
        $event= new User();
        $form = $this->createForm(UserType::class);

        return $this->render('main/register.html.twig', [
            'form'=> $form->createView(),
        ]);
    }


}