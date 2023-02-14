<?php

namespace App\Controller;

use App\Entity\Actualites;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
class ActualitesController extends AbstractController
{
    protected $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->em = $doctrine->getManager();
    }
    /**
     * @Route("/actualites", name="app_actualites")
     */
    public function index(): Response
    {
        $actualites = $this->em->getRepository(Actualites::class)
            ->findBy(array(
                "Statut" => null
            ));
        return $this->render('actualites/index.html.twig', [
            'page_name' => 'Actualites',
            'actualites' => $actualites
        ]);
    }

    /**
     * @Route("/detail/actualite/{id_actualite}", name="details_actualite")
     */
    public function detailAcualite($id_actualite): Response
    {
        $actualites = $this->em->getRepository(Actualites::class)
            ->findOneBy(array(
                "id" => $id_actualite
            ));
        return $this->render('actualites/detail.html.twig', [
            'page_name' => 'Details Actualités',
            'actualite' => $actualites
        ]);
    }
}
