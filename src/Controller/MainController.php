<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Mime\Email;
use App\Repository\EventRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('', name: 'main_')]
class MainController extends AbstractController
{
    
        private $eventRepository;
    
        public function __construct(EventRepository $eventRepository)
        {
            $this->eventRepository = $eventRepository;
        }
    

    #[Route('/', name: 'index')]
    public function index(): Response
        {
            $events = $this->eventRepository->findAll();
            
            return $this->render('main/index.html.twig', [
                'events' => $events
            ]);
        }

    #[Route('/contact', name: 'contact')]
    public function contact(MailerInterface $mailer): Response
    {
        $email = (new Email())
        ->from('hello@example.com')
        ->to('you@example.com')
        //->cc('cc@example.com')
        //->bcc('bcc@example.com')
        //->replyTo('fabien@example.com')
        //->priority(Email::PRIORITY_HIGH)
        ->subject('Time for Symfony Mailer!')
        ->text('Sending emails is fun again!')
        ->html('<p>See Twig integration for better HTML integration!</p>');

    $mailer->send($email);
        return $this->render('main/contact.html.twig');
    }

    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return new Response("Page à propos");
    }

}