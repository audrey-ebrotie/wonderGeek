<?php

namespace App\Controller\Admin;

use App\Entity\Comic;
use App\Entity\Manga;
use App\Entity\BoardGame;
use App\Entity\VideoGame;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Bienvenue Admin de WonderGeek');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Jeux vidéos', 'fas fa-gamepad', VideoGame::class);
        yield MenuItem::linkToCrud('Jeux de société', 'fas fa-dice', BoardGame::class);
        yield MenuItem::linkToCrud('Mangas', 'fas fa-book-reader', Manga::class);
        yield MenuItem::linkToCrud('Comics', 'fas fa-book-reader', Comic::class);
    }
}
