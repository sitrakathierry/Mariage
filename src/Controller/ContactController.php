<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
class ContactController extends AbstractController
{
    protected $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->em = $doctrine->getManager();
    }
    /**
     * @Route("/contact", name="app_contact")
     */
    public function index(): Response
    {
        return $this->render('contact/index.html.twig', [
            'page_name' => 'Contact',
        ]);
    }
}
