<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Mariage;
use App\Entity\Albums;
use App\Entity\Articles;
use App\Entity\Attachement;
use App\Entity\Categories;
use App\Entity\Festivites;
use App\Entity\Invitation;
use App\Entity\Video;
use Symfony\Component\HttpFoundation\Request;

class AccueilController extends AbstractController
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
     * @Route("/", name="app_accueil")
     */
    public function index(): Response
    {
        $mariages = $this->em->getRepository(Festivites::class)
            ->getMariageEnCours();

        $invitations = $this->em->getRepository(Invitation::class)
            ->findBy(array(), array('id' => 'DESC'));

        $albums = $this->em->getRepository(Albums::class)
            ->findAll();

        $elements = [] ;
        foreach ($albums as $album) {
            $element = [] ;
            $image = $this->em->getRepository(Attachement::class)->findOneBy([
                "album" => $album
            ]);
            if(is_null($image))
            {
                $imageD = "bijoux.webp" ;
            }
            else
            {
                $imageD = $image->getImage() ;
            }
            $element["mariage"] = "MARIAGE-".(str_pad($album->getIdMariage()->getId(), 3, '0', STR_PAD_LEFT))."|".$album->getIdMariage()->getId() ;
            $element["festivite"] = $album->getIdTypeFest()->getFestivite() ;
            $element["image"] = $imageD ;
            $element["compte"] = 1 ;

            array_push($elements,$element) ;
        } 
        
        $groupedData = array_reduce($elements, function ($carry, $item) {
            $mariage = $item['mariage'];
            $festivite = $item['festivite'];
        
            if (!isset($carry[$mariage][$festivite])) {
                $carry[$mariage][$festivite] = [];
            }
            $carry[$mariage][$festivite] = $item['image'] ;
        
            return $carry;
        }, []);

        // dd($groupedData) ;

        $videos = $this->em->getRepository(Video::class)
            ->findAll();
        $boutiques = $this->em->getRepository(Categories::class)
            ->findBy(array(
                "Statut" => null,
                "IdTypeOffre" => 1
            ));
        $prestations = $this->em->getRepository(Categories::class)
            ->findBy(array(
                "Statut" => null,
                "IdTypeOffre" => 2
            ));

        $panier = $this->em->getRepository(Articles::class)
                ->findBy(array(
                    "Statut" => -1
                ));
        return $this->render('accueil/index.html.twig', [
            'page_name' => 'Accueil',
            'mariages' => $mariages,
            'invitations' => $invitations,
            'extensionImage' => $this->extensionImage,
            'extensionAudio' => $this->extensionAudio,
            'albums' => $albums,
            'elemets' => $groupedData,
            'videos' => $videos,
            'boutiques' => $boutiques,
            'prestations' => $prestations
        ]);
    }
}
