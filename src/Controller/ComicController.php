<?php

namespace App\Controller;

use App\Entity\Comic;
use App\Repository\ComicRepository;
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
    public function comicList(): Response
    {
        $comics = $this->ComicRepository->findAll();

        return $this->render('comic/list.html.twig', [
            'comics' => $comics,
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
