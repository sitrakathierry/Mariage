<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoutiquesController extends AbstractController
{
    /**
     * @Route("/boutiques", name="app_boutiques")
     */
    public function index(): Response
    {
        return $this->render('boutiques/index.html.twig', [
            'page_name' => 'Boutiques',
        ]);
    }
}
