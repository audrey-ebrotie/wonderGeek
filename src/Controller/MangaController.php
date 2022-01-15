<?php

namespace App\Controller;

use App\Entity\Manga;
use App\Repository\MangaRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/manga', name: 'manga_')]
class MangaController extends AbstractController
{
    private $mangaRepository;

    public function __construct(MangaRepository $mangaRepository)
    {
        $this->mangaRepository = $mangaRepository;
    }

    #[Route(' ', name: 'list')]
    public function mangaList(Request $request): Response
    {
        $limit = 12;        
        $page = (int)$request->query->get("page", 1);    
        
        $mangas = $this->mangaRepository->getPaginatedMangas($page, $limit);       
        $total = $this->mangaRepository->getTotalMangas();

        return $this->render('manga/list.html.twig', [
            'mangas' => $mangas,
            'total' => $total,
            'limit' => $limit,
            'page' => $page
        ]);
    }

    #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'])]
    public function showManga($id): Response
    {
        $manga = $this->mangaRepository->find($id);
        
        return $this->render('manga/show.html.twig', [
            'manga' => $manga
        ]);
    }
}
