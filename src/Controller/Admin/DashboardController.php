<?php

namespace App\Controller\Admin;

use App\Entity\Actualites;
use App\Entity\Albums;
use App\Entity\Articles;
use App\Entity\Categories;
use App\Entity\Festivites;
use App\Entity\Mariage;
use App\Entity\Panier;
use App\Entity\Prix;
use App\Entity\TypeOffre;
use App\Entity\TypePrix;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {

        return $this->render('bundles/EasyAdminBundle/welcome.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Mariage');
    }



    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de Bord', 'fa fa-home');
        yield MenuItem::subMenu('Mariage', 'fas fa-ring')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fa fa-plus', Mariage::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Consulter', 'fa fa-eye', Mariage::class)
        ]);
        yield MenuItem::subMenu('Festivité', 'fas fa-bell')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fa fa-plus', Festivites::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Consulter', 'fa fa-eye', Festivites::class)
        ]);
        yield MenuItem::subMenu('Agenda', 'fa fa-calendar')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fa fa-plus', Festivites::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Consulter', 'fa fa-eye', Festivites::class),
        ]);
        yield MenuItem::subMenu('Contenu', 'fas fa-box')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fa fa-plus', Albums::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Consulter', 'fa fa-eye', Albums::class)
        ]);
        yield MenuItem::subMenu('Article', 'fa fa-bell')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fa fa-plus', Categories::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Consulter', 'fa fa-eye', Categories::class),
        ]);
        yield MenuItem::subMenu('Panier', 'fa fa-shopping-cart')->setSubItems([
            MenuItem::linkToCrud('Consulter', 'fa fa-eye', Articles::class),
        ]);
        yield MenuItem::subMenu('Actualités', 'fa fa-globe')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fa fa-plus', Actualites::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Consulter', 'fa fa-eye', Actualites::class),
        ]);
        
        // yield MenuItem::linkToCrud('Actualités', 'fas fa-globe', Actualites::class);
        // yield MenuItem::linkToCrud('Festivites', 'fas fa-bell', Festivites::class);
        // yield MenuItem::linkToCrud('Albums', 'fas fa-image', Albums::class);
        // yield MenuItem::linkToCrud('Articles', 'fas fa-store', Articles::class);
        // yield MenuItem::linkToCrud('Categories', 'fas fa-list', Categories::class);
        // yield MenuItem::linkToCrud('Mariage', 'fas fa-ring', Mariage::class);
        // yield MenuItem::linkToCrud('Panier', 'fas fa-shopping-cart', Panier::class);
        // yield MenuItem::linkToCrud('Prix', 'fa fa-money', Prix::class);
        // yield MenuItem::linkToCrud('Offre', 'fa fa-check', TypeOffre::class);
        // yield MenuItem::linkToCrud('Type prix', 'fas fa-sort', TypePrix::class);
    }
}
