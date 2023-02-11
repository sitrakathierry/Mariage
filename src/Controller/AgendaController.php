<?php

namespace App\Controller;

use App\Entity\Albums;
use App\Entity\Festivites;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgendaController extends AbstractController
{
    protected $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->em = $doctrine->getManager();
    }
    /**
     * @Route("/agenda", name="app_agenda")
     */
    public function index(): Response
    {
        $agenda = $this->em->getRepository(Festivites::class)->findAll();
        return $this->render('agenda/index.html.twig', [
            'page_name' => 'Agenda',
            'agenda' => $agenda,
        ]);
    }

    /**
     * @Route("/admin/add/agenda", name="admin_add_agenda") admin_show_agenda
     */
    public function addAgenda(): Response
    {
        return $this->render('admin/agenda/add.html.twig', []);
    }

    /**
     * @Route("/admin/show/agenda", name="admin_show_agenda") 
     */
    public function showAgenda(): Response
    {
        return $this->render('admin/agenda/show.html.twig', []);
    }
    
    
}
