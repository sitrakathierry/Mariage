<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Mariage;
use App\Entity\Festivites;
use App\Entity\Albums;
class FestiviteController extends AbstractController
{
    protected $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->em = $doctrine->getManager();
    }
    /**
     * @Route("/mariage", name="app_mariage")
     */
    public function index(): Response
    {
        $mariage = $this->em->getRepository(Mariage::class)
            ->findBy(array(
                "Statut" => null
            ));
        return $this->render('festivite/mariage.html.twig', [
            'page_name' => 'Mariage',
            'mariage' => $mariage
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
     * @Route("/detail/mariage/{idMariage}", name="app_detailMariage")
     */
    public function detailMariage($idMariage): Response
    {
        $unMariage = $this->em->getRepository(Mariage::class)
            ->findOneBy(array(
                "id" => $idMariage
            ));

        $lastFest = $this->em->getRepository(Festivites::class)
            ->getLastFestOfMariage($idMariage);

        $albums = $this->em->getRepository(Albums::class)
            ->findBy(array(
                "id_fest" => $lastFest[0]->getId(),
                "IdMariage" => $idMariage,
            ));

        $extensionImage = array('jpg', 'jpeg', 'png', 'gif', 'ico', 'svg', 'JPG', 'JPEG', 'PNG', 'SVG');

        $allFestivites = $this->em->getRepository(Festivites::class)
            ->getAll($idMariage);

        return $this->render('festivite/detailMariage.html.twig', [
            'page_name' => 'Détails Mariage',
            'unMariage' => $unMariage,
            'lastFest' => $lastFest,
            'albums' => $albums,
            'allFestivites' => $allFestivites,
            'extensionImage' => $extensionImage
        ]);
    }
}
