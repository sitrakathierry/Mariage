<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActualitesController extends AbstractController
{
    #[Route('/actualites', name: 'app_actualites')]
    public function index(): Response
    {
        /**
         * @Route("/actualites", name="app_actualites")
         */
        return $this->render('actualites/index.html.twig', [
            'page_name' => 'Actualites',
        ]);
    }
}
