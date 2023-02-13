<?php

namespace App\Controller;

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
        return $this->render('actualites/index.html.twig', [
            'page_name' => 'Actualites',
        ]);
    }
}
