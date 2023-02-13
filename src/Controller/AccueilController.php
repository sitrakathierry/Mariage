<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Mariage;
use App\Entity\Albums;
use App\Entity\Categories;
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
        $mariages = $this->em->getRepository(Mariage::class)
            ->findAll();

        return $this->render('accueil/index.html.twig', [
            'page_name' => 'Accueil',
            'mariages' => $mariages
        ]);
    }
}
