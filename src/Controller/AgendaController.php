<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgendaController extends AbstractController
{
    
    /**
     * @Route("/agenda", name="app_agenda")
     */
    public function index(): Response
    {
        return $this->render('agenda/index.html.twig', [
            'page_name' => 'Agenda',
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
