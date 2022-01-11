<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/event', name: 'event_')]
class EventController extends AbstractController
{
    private $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    #[Route(' ', name: 'list')]
    public function eventsList(): Response
    {
        $events = $this->eventRepository->findAll();
        
        return $this->render('event/list.html.twig', [
            'events' => $events
        ]);
    }

    #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'])]
    public function showEvent($id): Response
    {
        $event = $this->eventRepository->find($id);
        
        return $this->render('event/show.html.twig', [
            'event' => $event
        ]);
    }

    #[Route('/new', name: 'new')]
    public function newEvent(): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);

        return $this->render('event/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
