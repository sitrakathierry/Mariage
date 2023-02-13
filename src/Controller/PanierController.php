<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Categories;
use App\Entity\Panier;
use App\Entity\Festivites;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PanierController extends AbstractController
{
    protected $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->em = $doctrine->getManager();
    }
    /**
     * @Route("/panier", name="app_panier")
     */
    public function index(): Response
    {
        $panier = $this->em->getRepository(Articles::class)->findBy(array(
            "Statut" => -1
        ));

        return $this->render('panier/index.html.twig', [
            'page_name' => 'Panier',
            'panier' => $panier
        ]);
    }

    /**
     * @Route("/ajout/panier", name="ajout_panier")
     */
    public function ajouterAuPanier(Request $request): JsonResponse
    {
        $article = $request->request->get('article');
        $qteProd = $request->request->get('qteProd');

        $articlePanier = new Articles();

        $Categorie = $this->em->getRepository(Categories::class)->find(intval($article));
        $Panier = $this->em->getRepository(Panier::class)->find(1);

        $articlePanier->setIdCategorie($Categorie);
        $articlePanier->setIdPanier($Panier);

        $articlePanier->setStatut(-1);
        $articlePanier->setQuantite($qteProd);
        $articlePanier->setUpdatedAt(new \DateTimeImmutable);
        $articlePanier->setCreatedAt(new \DateTimeImmutable);
        $articlePanier->setDate(new \DateTime);

        $this->em->persist($articlePanier);

        $this->em->flush();
        return new JsonResponse(['msg' => 'success']);
    }
}
