<?php

namespace App\Controller;

use App\Entity\Albums;
use App\Entity\Festivites;
use App\Entity\Mariage;
use App\Entity\TypeFestivite;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        $mariages = $this->em->getRepository(Mariage::class)
            ->findBy([
                "Statut" => null
            ]);
        $festivites = $this->em->getRepository(TypeFestivite::class)
            ->findBy([
                "Statut" => null
            ]);
        return $this->render('agenda/index.html.twig', [
            'page_name' => 'Agenda',
            'agenda' => $agenda,
            'mariages' => $mariages,
            'festivites' => $festivites,
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

    /**
     * @Route("/agenda/recherche", name="recherche_agenda") 
     */
    public function rechercheAgenda(Request $request): Response
    {
        $params = $request->request->get('params');

        $agenda = $this->em->getRepository(Festivites::class)
            ->findAgendaBy($params);

        return $this->render('agenda/recherche.html.twig', ["agenda" => $agenda]);
    }
}
