<?php

namespace App\Controller;

use App\Entity\Articles;
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

        $panier = $this->em->getRepository(Articles::class)->findBy(array(
            "Statut" => -1
        ));
        return $this->render('prestations/index.html.twig', [
            'page_name' => 'Prestations',
            'prestations' => $prestations,
            'panier' => $panier
        ]);
    }

    /**
     * @Route("/detail/prestation/{idPrestation}", name="app_detailPrest")
     */
    public function detailsPrestation($idPrestation): Response
    {
        $unePrestation = $this->em->getRepository(Categories::class)
            ->findOneBy(array(
                "Statut" => null,
                "IdTypeOffre" => 2,
                "id" => $idPrestation
            ));

        $panier = $this->em->getRepository(Articles::class)->findBy(array(
                "Statut" => -1
            ));
        return $this->render('prestations/detailPrestation.html.twig', [
            'page_name' => 'Détails Prestation',
            'unePrestation' => $unePrestation,
            'panier' => $panier
        ]);
    }
}
