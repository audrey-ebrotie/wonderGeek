<?php

namespace App\Controller;

use App\Repository\VideoGameRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    private $VideoGameRepository;

    public function __construct(
        VideoGameRepository $VideoGameRepository,
    ){
        $this->VideoGameRepository = $VideoGameRepository;
    }
    #[Route('/category', name: 'category_')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    #[Route('/gamelist', name: 'gamelist')]
    public function gamelist(): Response
    {
        $game = $this->VideoGameRepository-> findAll();

        return $this->render('category/gamelist.html.twig', [
            'game' => $game]
        );
    }
}
