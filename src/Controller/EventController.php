<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Event;
use App\Entity\Booking;
use App\Form\EventType;
use App\Entity\UserLevel;
use App\Service\UploaderHelper;
use Gedmo\Sluggable\Util\Urlizer;
use App\Form\SearchEventType;
use Symfony\Component\Uid\Uuid;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
    public function eventsList(Request $request): Response
    {
        //  Formulaire de recherche
        # $searchForm = $this->createForm(SearchEventType::class);
        # $searchForm->handleRequest($request);
        # $searchCriteria = $searchForm->getData(); 

        // Système de pagination
        $limit = 12;        
        $page = (int)$request->query->get("page", 1);  
        
        $events = $this->eventRepository->getPaginatedEvents($page, $limit);       
        $total = $this->eventRepository->getTotalEvents();   
        # $events = $this->eventRepository->search($searchCriteria); 
        return $this->render('event/list.html.twig', [
            'events' => $events,
            'total' => $total,
            'limit' => $limit,
            'page' => $page,
            #'searchForm' => $searchForm->createView(),
    
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
    #[Route('/{id}/edit', name: 'edit', requirements: ['id' => '\d+'])]
    #[IsGranted('ROLE_USER')]
    public function eventForm(Request $request, UploaderHelper $uploaderHelper, $id = null): Response
    {
        if($id){
            $event = $this->eventRepository->find($id);
            $isNew = false;
        } else {
            $event = new Event();
            $event->setOwner($this->getUser());  /* On définit le owner une fois à la création de l'event pour éviter un chgt de owner en cas d'edit */
            $isNew = true;
        }
        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $uploadedFile = $form['pictureFile']->getData();

            $newFilename = $uploaderHelper->uploadEventPicture($uploadedFile);
            $event->setPicture($newFilename);

            $this->em->persist($event);
            $this->em->flush();

            $message = sprintf('Votre évènement a bien été %s' , $isNew ? 'créé' : 'modifié');
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('event_show', [
                'id' => $event->getId(),
            ]);
        }

        return $this->render('event/form.html.twig', [
            'form' => $form->createView(),
            'isNew'=>$isNew
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', requirements: ['id' => '\d+'])]
    public function delete($id){
        $event = $this->eventRepository->find($id);
        $this->em->remove($event);
        $this->em->flush();

        $response = new Response();
        $response->send();

        $this->addFlash('notice', 'L\'évènement a bien été annulé.');
        return $this->redirectToRoute('event_list');
    }

    #[Route('/{id}/booking', name: 'booking', requirements: ['id' => '\d+'])]
    #[IsGranted('BOOK_EVENT', subject: 'event')]
    public function booking(Request $request, Event $event): Response
    {
        $booking = new Booking();
        $booking->setEvent($event);
        $booking->setUser($this->getUser());
        $booking->setReference(Uuid::v4());

        $this->em->persist($booking);
        $this->em->flush();

        $this->addFlash('notice', 'L\'évènement a bien été réservé.');
        return $this->redirectToRoute('event_list');
    }
}
        
    

