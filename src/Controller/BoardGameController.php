<?php

namespace App\Controller;

use App\Entity\BoardGame;
use App\Repository\BoardGameRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/board_game', name: 'board_game_')]
class BoardGameController extends AbstractController
{
    private $boardGameRepository;

    public function __construct(BoardGameRepository $boardGameRepository)
    {
        $this->boardGameRepository = $boardGameRepository;
    }

    #[Route(' ', name: 'list')]
    public function boardGamesList(Request $request): Response
    {
        $limit = 12;        
        $page = (int)$request->query->get("page", 1);    
        
        $boardGames = $this->boardGameRepository->getPaginatedBoardGames($page, $limit);       
        $total = $this->boardGameRepository->getTotalBoardGames();
        
        return $this->render('board_game/list.html.twig', [
            'boardGames' => $boardGames,
            'total' => $total,
            'limit' => $limit,
            'page' => $page
        ]);
    }

    #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'])]
    public function showGame($id): Response
    {
        $boardGame = $this->boardGameRepository->find($id);
        
        return $this->render('board_game/show.html.twig', [
            'boardGame' => $boardGame
        ]);
    }

}
