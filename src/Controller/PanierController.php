<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Categories;
use App\Entity\Panier;
use App\Entity\Festivites;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncode;

// use Symfony\Component\HttpFoundation\RequestStack;

class PanierController extends AbstractController
{
    protected $em;
    // private $requestStack;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->em = $doctrine->getManager();
        // $this->requestStack = $requestStack;
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



    /**
     * @Route("/supprimer/panier", name="supprimer_panier")
     */
    public function supprimerPanier(Request $request): JsonResponse
    {
        $article = $request->request->get('article');

        $articlePanier = $this->em->getRepository(Articles::class)
            ->findOneBy(array(
                "Statut" => -1,
                "id" => intval($article)
            ));

        $this->em->remove($articlePanier);
        $this->em->flush();

        return new JsonResponse(['msg' => 'success']);
    }

    /**
     * @Route("/suppression/all/panier", name="supprimer_all_panier")
     */
    public function supprimerAllPanier(): JsonResponse
    {
        $articlePanier = $this->em->getRepository(Articles::class)
            ->findOneBy(array(
                "Statut" => -1
            ));

        $this->em->remove($articlePanier);
        $this->em->flush();

        return new JsonResponse(['msg' => 'success']);
    }

    /**
     * @Route("/enregistrer/panier", name="enregistrer_panier",methods={"POST"} )
     */
    public function enregistrerPanier(Request $request): JsonResponse
    {
        $userClient = new User();

        $session = $request->getSession();

        if (empty($session->get('mailUser'))) {
            $cmd_nom = $request->request->get('cmd_nom');
            $cmd_prenom = $request->request->get('cmd_prenom');
            $cmd_adresse = $request->request->get('cmd_adresse');
            $cmd_telephone = $request->request->get('cmd_telephone');
            $cmd_email = $request->request->get('cmd_email');

            if (!empty($cmd_email)) {

                $verifyEmail = $this->em->getRepository(User::class)
                    ->findOneBy(array(
                        "email" => $cmd_email,
                    ));
                if (empty($verifyEmail)) {
                    $userClient->setEmail($cmd_email);
                    $userClient->setAdresse($cmd_adresse);
                    $userClient->setNom($cmd_nom);
                    $userClient->setPassword("VIDE");
                    $userClient->setRoles(array("Info" => "NONE"));
                    $userClient->setPrenoms($cmd_prenom);
                    $userClient->setPays($cmd_adresse);
                    $userClient->setTelephone($cmd_telephone);
                    $this->em->persist($userClient);
                    $this->em->flush();
                }

                $session->set('mailUser', $cmd_email);
                $articlePanier = $this->em->getRepository(Articles::class)
                    ->findOneBy(array(
                        "Statut" => -1
                    ));

                $articlePanier->setIdUser($userClient);
                $articlePanier->setStatut(null);
                $this->em->flush();
                return new JsonResponse(['msg' => 'success']);
            } else {
                return new JsonResponse(['msg' => 'error']);
            }
        } else {
            $articlePanier = $this->em->getRepository(Articles::class)
                ->findOneBy(array(
                    "Statut" => -1
                ));

            $verifyEmail = $this->em->getRepository(User::class)
                ->findOneBy(array(
                    "email" => $session->get('mailUser'),
                ));

            $articlePanier->setIdUser($userClient);
            $articlePanier->setStatut(null);
            $this->em->flush();

            return new JsonResponse(['msg' => 'success']);
        }
    }
}
