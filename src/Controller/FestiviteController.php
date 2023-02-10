<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FestiviteController extends AbstractController
{
    /**
     * @Route("/mariage", name="app_mariage")
     */   
    public function index(): Response
    {
        return $this->render('festivite/mariage.html.twig', [
            'page_name' => 'Mariage',
        ]);
    }

    /**
     * @Route("/albums", name="app_albums")
     */ 
    public function albums(): Response
    {
        return $this->render('festivite/albums.html.twig', [
            'page_name' => 'Albums',
        ]);
    }

    /**
     * @Route("/videos", name="app_videos")
     */ 
    public function videos(): Response
    {
        return $this->render('festivite/videos.html.twig', [
            'page_name' => 'Videos',
        ]);
    }

    /**
     * @Route("/audio", name="app_audio")
     */
    public function audio(): Response
    {
        return $this->render('festivite/audio.html.twig', [
            'page_name' => 'Audio',
        ]);
    }

    /**
     * @Route("/detail/mariage", name="app_detailMariage")
     */
    public function detailMariage(): Response
    {
        return $this->render('festivite/detailMariage.html.twig', [
            'page_name' => 'Détails Mariage',
        ]);
    }
}
