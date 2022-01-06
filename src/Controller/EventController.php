<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/event', name: 'event')]
    public function event(): Response
    {
        return $this->render('event/event.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }
}
