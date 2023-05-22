<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Mariage;
use App\Entity\Festivites;
use App\Entity\Albums;
use App\Entity\Attachement;
use App\Entity\TypeFestivite;
use App\Entity\Video;
use Symfony\Component\HttpFoundation\Request;

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
                    "IdTypeFest" => $firstFestivite['idTypeF'],
                    "IdMariage" => $firstFestivite['IdMariage'],
                ));

            if (empty($albums))
                $albums = null;
        }

        $allFestivites = $this->em->getRepository(TypeFestivite::class)
            ->findAll();
            
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
            $albums = $this->em->getRepository(Video::class)
                ->findBy(array(
                    "idMariage" => $firstFestivite['idTypeF'],
                    "idTypeFestivite" => $firstFestivite['IdMariage'],
                ));

            if (empty($albums))
                $albums = null;
        }

        $allFestivites = $this->em->getRepository(TypeFestivite::class)
            ->findAll();

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
                    "IdTypeFest" => $firstFestivite['idTypeF'],
                    "IdMariage" => $firstFestivite['IdMariage'],
                ));

            if (empty($albums))
                $albums = null;
        }

        $allFestivites = $this->em->getRepository(TypeFestivite::class)
            ->findAll();

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
        $mariage = $this->em->getRepository(Mariage::class)->find($idMariage);

        $lastFest = $this->em->getRepository(Festivites::class)
            ->getLastFestOfMariage($idMariage);

        $albums = null;
        if (!empty($lastFest)) {
            $albums = $this->em->getRepository(Albums::class)
                ->findBy(array(
                    "IdTypeFest" => $lastFest[0]->getIdTypeFestivite(),
                    "IdMariage" => $idMariage,
                ));
            if (empty($albums))
                $albums = null;
        }

        $albums = $this->em->getRepository(Albums::class)->findBy([
            "IdMariage" => $mariage
        ]) ;
        
        $elements = [] ;
        foreach ($albums as $album) {
            $element = [] ;
            $idF = $album->getIdTypeFest()->getId() ; 

            $element["festivite"] = $album->getIdTypeFest()->getFestivite()."|".$album->getIdTypeFest()->getId();

            $attachements = $this->em->getRepository(Attachement::class)->findBy([
                "album" => $album
            ]) ;
            $element["album"] = [] ;
            foreach ($attachements as $attachement) {
                // $item = [] ;

                // $item["image"] = $attachement->getImage() ;
                // $item["date"] = $attachement->getCreatedAt()->format("d/m/Y") ;

                array_push($element["album"],[$attachement->getImage(),$attachement->getCreatedAt()->format("d/m/Y")]) ;
            } 
            array_push($elements,$element) ;
            
        } 

        $result = [];
        foreach ($elements as $item) {
            $festivite = $item['festivite'];
            $album = $item['album'];
            $result[$festivite][] = $album;
        }
        
        foreach ($result as $key => $value) {
            // Aplatir les sous-tableaux
            $flattenedArray = array_reduce($result[$key], "array_merge", []);
            // Réorganiser le tableau
            $result[$key] = array_values($flattenedArray);
        } 

        return $this->render('festivite/detailMariage.html.twig', [
            'page_name' => 'Détails Mariage',
            'unMariage' => $mariage,
            'albums' => $albums,
            'festivites' => $result,
        ]);
    }

    /**
     * @Route("/mariage/affiche/contenu", name="contenu_Mariage")
   */ 
    public function afficheContenuMariage(Request $request): Response
    {
        $one_festivite = $request->request->get('one_festivite');
        $one_type_content = $request->request->get('one_type_content');
        $idMariage = $request->request->get('idMariage');

        if ($one_type_content == 1) # Album
        {
            $albums = $this->em->getRepository(Albums::class)
                ->findBy(array(
                    "IdMariage" => $idMariage,
                    "IdTypeFest" => $one_festivite
                ));

            return $this->render('festivite/detailAlbum.html.twig', [
                'albums' => $albums,
                'extensionImage' => $this->extensionImage
            ]);
        } else if ($one_type_content == 2) # Video
        {
            $albums = $this->em->getRepository(Video::class)
            ->findBy(array(
                "idMariage" => $idMariage,
                "idTypeFestivite" => $one_festivite
            ));

            return $this->render('festivite/detailVideo.html.twig', [
                'albums' => $albums
            ]);

        } else { # Audio
            $albums = $this->em->getRepository(Albums::class)
                ->findBy(array(
                    "IdMariage" => $idMariage,
                    "IdTypeFest" => $one_festivite
                ));

            return $this->render('festivite/detailAudio.html.twig', [
                'albums' => $albums,
                'extensionAudio' => $this->extensionAudio
            ]);
        }
    }

    /**
     * @Route("/mariage/affiche/unique/contenu", name="contenu_unique_Mariage")
   */ 
  public function afficheContenuUniqueMariage(Request $request): Response
  {
      $mariage = $request->request->get('mariage');
      $festivite = $request->request->get('festivite');
      
      $mariage = $this->em->getRepository(Mariage::class)->find($mariage);
      $festivite = $this->em->getRepository(TypeFestivite::class)->find($festivite);

      $type = $request->request->get('type');

      if ($type == "ALBUM") # Album
      {
          $albums = $this->em->getRepository(Albums::class)
              ->findBy(array(
                "IdTypeFest" => $festivite,
                "IdMariage" => $mariage
              ));

            if(empty($albums))
            {
                return new Response('
                    <div class="alert alert-info">Aucun contenu image trouvé</div>
                ') ;
            }
          return $this->render('festivite/detailAlbum.html.twig', [
              'albums' => $albums,
              'extensionImage' => $this->extensionImage
          ]);
      } else if ($type == "VIDEO") # Video
      {
          $albums = $this->em->getRepository(Video::class)
          ->findBy(array(
              "idMariage" => $mariage,
              "idTypeFestivite" => $festivite
          ));
          if(empty($albums))
          {
                return new Response('
                    <div class="alert alert-info">Aucune contenu vidéo trouvée</div>
                ') ;
          }
          return $this->render('festivite/detailVideo.html.twig', [
              'albums' => $albums
          ]);

      } else { # Audio
          $albums = $this->em->getRepository(Albums::class)
              ->findBy(array(
                  "IdMariage" => $mariage,
                  "IdTypeFest" => $festivite
              ));

        if(empty($albums))
        {
            return new Response('
                <div class="alert alert-info">Aucune contenu audio trouvée</div>
            ') ;
        }
          return $this->render('festivite/detailAudio.html.twig', [
              'albums' => $albums,
              'extensionAudio' => $this->extensionAudio
          ]);
      }
  }
}
