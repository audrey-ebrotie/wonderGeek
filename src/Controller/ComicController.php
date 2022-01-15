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
    private $ComicRepository;

    public function __construct(ComicRepository $ComicRepository)
    {
        $this->ComicRepository = $ComicRepository;
    }

    #[Route(' ', name: 'list')]
    public function comicList(Request $request): Response
    {
        $searchForm = $this->createForm(SearchComicType::class);
        $searchForm->handleRequest($request);
        $searchCriteria = $searchForm->getData();

        $comics = $this->ComicRepository->search($searchCriteria);

        return $this->render('comic/list.html.twig', [
            'comics' => $comics,
            'searchForm' => $searchForm->createView(),
        ]);
    }

    #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'])]
    public function showComic($id): Response
    {
        $comic = $this->ComicRepository->find($id);
        
        return $this->render('comic/show.html.twig', [
            'comic' => $comic
        ]);
    }
}
