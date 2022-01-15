<?php

namespace App\Controller;

use App\Entity\VideoGame;
use App\Repository\VideoGameRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/video_game', name: 'video_game_')]
class VideoGameController extends AbstractController
{
    private $videoGameRepository;

    public function __construct(VideoGameRepository $videoGameRepository)
    {
        $this->videoGameRepository = $videoGameRepository;
    }

    #[Route(' ', name: 'list')]
    public function videoGamesList(Request $request): Response
    {
        $limit = 12;        
        $page = (int)$request->query->get("page", 1);    
        
        $videoGames = $this->videoGameRepository->getPaginatedVideoGames($page, $limit);       
        $total = $this->videoGameRepository->getTotalVideoGames(); 
        
        return $this->render('video_game/list.html.twig', [
            'videoGames' => $videoGames,
            'total' => $total,
            'limit' => $limit,
            'page' => $page
        ]);
    }

    #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'])]
    public function showGame($id): Response
    {
        $videoGame = $this->videoGameRepository->find($id);
        
        return $this->render('video_game/show.html.twig', [
            'videoGame' => $videoGame
        ]);
    }


}
