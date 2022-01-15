<?php

namespace App\Controller;

use App\Entity\Manga;
use App\Form\SearchMangaType;
use App\Repository\MangaRepository;
use Symfony\Component\HttpFoundation\Request;
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
    public function mangaList(Request $request): Response
    {
        $searchForm = $this->createForm(SearchMangaType::class);
        $searchForm->handleRequest($request);
        $searchCriteria = $searchForm->getData();

        $mangas = $this->MangaRepository->search($searchCriteria);

        return $this->render('manga/list.html.twig', [
            'mangas' => $mangas,
            'searchForm' => $searchForm->createView(),
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
