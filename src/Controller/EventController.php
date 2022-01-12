<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/event', name: 'event_')]
class EventController extends AbstractController
{
    private $em;
    private $eventRepository;

    public function __construct(EntityManagerInterface $em, EventRepository $eventRepository)
    {
        $this->em = $em;
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
    public function newEvent(Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $user = $this->em->getRepository(User::class)->find(1492);  /* TODO : A remplacer par l'utilisateur connecter */
            $event->setOwner($user);
            $this->em->persist($event);
            $this->em->flush();

            $this->addFlash('notice', 'Votre évènement a été créé');
            return $this->redirectToRoute('main_index');
        }

        return $this->render('event/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
