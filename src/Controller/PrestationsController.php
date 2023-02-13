<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Categories;
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
        $prestations = $this->em->getRepository(Categories::class)
            ->findBy(array(
                "Statut" => null,
                "IdTypeOffre" => 2
            ));
        return $this->render('prestations/index.html.twig', [
            'page_name' => 'Prestations',
            'prestations' => $prestations
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
