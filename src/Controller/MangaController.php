<?php

namespace App\Controller;

use App\Entity\Manga;
use App\Repository\MangaRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/manga', name: 'manga_')]
class MangaController extends AbstractController
{
    private $MangaRepository;

    public function __construct(MangaRepository $MangaRepository)
    {
        $this->MangaRepository = $MangaRepository;
    }

    #[Route(' ', name: 'list')]
    public function mangaList(): Response
    {
        $mangas = $this->MangaRepository->findAll();

        return $this->render('manga/list.html.twig', [
            'mangas' => $mangas,
        ]);
    }

    #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'])]
    public function showManga($id): Response
    {
        $manga = $this->MangaRepository->find($id);
        
        return $this->render('manga/show.html.twig', [
            'manga' => $manga
        ]);
    }
}
