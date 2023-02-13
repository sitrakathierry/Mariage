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

    protected $extensionImage;
    protected $extensionVideo;
    protected $extensionAudio;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->em = $doctrine->getManager();
        $this->extensionImage =  array('jpg', 'jpeg', 'png', 'gif', 'ico', 'svg', 'JPG', 'JPEG', 'PNG', 'SVG', 'webp');
        $this->extensionVideo =  array('mp4', 'mkv', 'mov', 'wmv', 'avi', 'avchd', 'flv', 'f4v', 'swf', 'webm', 'mpeg-2', 'mpeg');
        $this->extensionAudio =  array('mp3', 'wav', 'ogg', 'wma', 'mid', 'riff');
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
        $mariage = $this->em->getRepository(Mariage::class)
            ->findAll();

        $firstFestivite = $this->em->getRepository(Festivites::class)
            ->getFirstFestivite();

        $albums = null;
        if (!empty($firstFestivite)) {
            $albums = $this->em->getRepository(Albums::class)
                ->findBy(array(
                    "id_fest" => $firstFestivite['id'],
                    "IdMariage" => $firstFestivite['IdMariage'],
                ));

            if (empty($albums))
                $albums = null;
        }

        $allFestivites = $this->em->getRepository(Festivites::class)
            ->getAll();
            
        return $this->render('festivite/albums.html.twig', [
            'page_name' => 'Albums',
            'mariage' => $mariage,
            'firstFestivite' => $firstFestivite,
            'allFestivites' => $allFestivites,
            'albums' => $albums,
            'extensionImage' => $this->extensionImage
        ]);
    }

    /**
     * @Route("/videos", name="app_videos")
     */ 
    public function videos(): Response
    {
        $mariage = $this->em->getRepository(Mariage::class)
            ->findAll();

        $firstFestivite = $this->em->getRepository(Festivites::class)
            ->getFirstFestivite();

        $albums = null;
        if (!empty($firstFestivite)) {
            $albums = $this->em->getRepository(Albums::class)
                ->findBy(array(
                    "id_fest" => $firstFestivite['id'],
                    "IdMariage" => $firstFestivite['IdMariage'],
                ));

            if (empty($albums))
                $albums = null;
        }

        $allFestivites = $this->em->getRepository(Festivites::class)
            ->getAll();

        return $this->render('festivite/videos.html.twig', [
            'page_name' => 'Videos',
            'mariage' => $mariage,
            'firstFestivite' => $firstFestivite,
            'allFestivites' => $allFestivites,
            'albums' => $albums,
            'extensionVideo' => $this->extensionVideo
        ]);
    }

    /**
     * @Route("/audio", name="app_audio")
     */
    public function audio(): Response
    {
        $mariage = $this->em->getRepository(Mariage::class)
            ->findAll();

        $firstFestivite = $this->em->getRepository(Festivites::class)
            ->getFirstFestivite();

        $albums = null;
        if (!empty($firstFestivite)) {
            $albums = $this->em->getRepository(Albums::class)
                ->findBy(array(
                    "id_fest" => $firstFestivite['id'],
                    "IdMariage" => $firstFestivite['IdMariage'],
                ));

            if (empty($albums))
                $albums = null;
        }

        $allFestivites = $this->em->getRepository(Festivites::class)
            ->getAll();

        return $this->render('festivite/audio.html.twig', [
            'page_name' => 'Audio',
            'mariage' => $mariage,
            'firstFestivite' => $firstFestivite,
            'allFestivites' => $allFestivites,
            'albums' => $albums,
            'extensionAudio' => $this->extensionAudio
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

        $albums = null;
        if (!empty($lastFest)) {
            $albums = $this->em->getRepository(Albums::class)
                ->findBy(array(
                    "id_fest" => $lastFest[0]->getId(),
                    "IdMariage" => $idMariage,
                ));

            if (empty($albums))
                $albums = null;
        }

        $allFestivites = $this->em->getRepository(Festivites::class)
            ->getAll();

        return $this->render('festivite/detailMariage.html.twig', [
            'page_name' => 'Détails Mariage',
            'unMariage' => $unMariage,
            'lastFest' => $lastFest,
            'albums' => $albums,
            'allFestivites' => $allFestivites,
            'extensionImage' => $this->extensionImage
        ]);
    }
}
