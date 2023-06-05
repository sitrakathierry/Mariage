<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
class BoutiquesController extends AbstractController
{
    protected $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->em = $doctrine->getManager();
    }
    /**
     * @Route("/boutiques", name="app_boutiques")
     */
    public function index(): Response
    {
        $boutiques = $this->em->getRepository(Categories::class)
            ->findBy(array(
                "Statut" => null,
                "IdTypeOffre" => 1
            ));
        $panier = $this->em->getRepository(Articles::class)->findBy(array(
            "Statut" => -1
        ));
        return $this->render('boutiques/index.html.twig', [
            'page_name' => 'Boutiques',
            'boutiques' => $boutiques ,
            'panier' => $panier
        ]);
    }
    
    /**
     * @Route("/boutiques/details/{id}", name="details_boutique")
     */
    public function detailsBoutique($id)
    {
        $boutique = $this->em->getRepository(Categories::class)
            ->find($id);

        return $this->render('boutiques/details.html.twig', [
            'page_name' => 'Détails boutique',
            'boutique' => $boutique,
        ]);
    }
}
