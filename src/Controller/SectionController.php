<?php

namespace App\Controller;

use App\Repository\VideoGameRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SectionController extends AbstractController
{
    #[Route('/section', name: 'section')]
    public function index(): Response
    {
        return $this->render('section/index.html.twig', [
            'controller_name' => 'SectionController',
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
