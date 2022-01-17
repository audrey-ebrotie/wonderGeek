<?php

namespace App\Controller;

use App\Entity\Comic;
use App\Form\SearchComicType;
use App\Repository\ComicRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/comic', name: 'comic_')]
class ComicController extends AbstractController
{
    private $comicRepository;

    public function __construct(ComicRepository $comicRepository)
    {
        $this->comicRepository = $comicRepository;
    }

    #[Route(' ', name: 'list')]
    public function comicList(Request $request): Response
    {
        // Formulaire de recherche
        $searchForm = $this->createForm(SearchComicType::class);
        $searchForm->handleRequest($request);
        $searchCriteria = $searchForm->getData();
        
        // Système de pagination
        $limit = 12;        
        $page = (int)$request->query->get("page", 1);    
        $comics = $this->comicRepository->getPaginatedComics($page, $limit);       
        $total = $this->comicRepository->getTotalComics();   

        $comics = $this->comicRepository->search($searchCriteria);

        return $this->render('comic/list.html.twig', [
            'comics' => $comics,
            'total' => $total,
            'limit' => $limit,
            'page' => $page,
            'searchForm' => $searchForm->createView(),
        ]);
    }

    #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'])]
    public function showComic($id): Response
    {
        $comic = $this->comicRepository->find($id);
        
        return $this->render('comic/show.html.twig', [
            'comic' => $comic
        ]);
    }
}
