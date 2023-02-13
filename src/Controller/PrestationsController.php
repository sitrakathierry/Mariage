<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
class PrestationsController extends AbstractController
{
    protected $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->em = $doctrine->getManager();
    }
    /**
     * @Route("/prestations", name="app_prestations")
     */ 
    public function index(): Response
    {
        return $this->render('prestations/index.html.twig', [
            'page_name' => 'Prestations',
        ]);
    }

    /**
     * @Route("/detail/prestation", name="app_detailPrest")
     */
    public function detailsPrestation(): Response
    {
        return $this->render('prestations/detailPrestation.html.twig', [
            'page_name' => 'Détails Prestation',
        ]);
    }
}
