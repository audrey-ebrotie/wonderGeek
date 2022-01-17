<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    #[Route('', name: 'contact_')]
class ContactController extends AbstractController
{
    #[Route('/', name: 'index')]
        public function index(Request $request, MailerInterface $mailer)
        {
            $form = $this->createForm(ContactType::class);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $contactFormData = $form->getData();

                $message=(new Email())
                ->from($contactFormData['email'])
                ->to('wondergeek01@gmail.com')
                ->subject('Demande de contact')
                ->text('Sender : ' .$contactFormData['email'] .\PHP_EOL. $contactFormData['message'], 'text/plain');

                $mailer->send($message);

                $this->addFlash('success', 'message envoyé');
                return $this->redirectToRoute('contact');
            }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
