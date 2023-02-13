<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
class AccueilController extends AbstractController
{
    protected $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->em = $doctrine->getManager();
    }

    /**
     * @Route("/", name="app_accueil")
     */
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'page_name' => 'Accueil',
        ]);
    }
}
