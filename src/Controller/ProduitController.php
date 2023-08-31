<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]
    // pour recupérer en bdd les articles nous avon besoin d'un repository
    // pour faire la manipulation nous avons besoin d'un manager
    public function index(ProduitRepository $repo): Response
    {
        // ! pour recuperer le repository, je le passe en paramètre de la methode
        //! cela s'appelle une injection

        $produit = $repo->findAll();
        // ! j'utilise la méthode findAll pour récupérer tous les articles en BDD
        return $this->render('produit/index.html.twig',[
        'produit' => $produit, //! j'envoie les articles au templates
    ]);
        // return $this->render('produit/index.html.twig', [
        //     'controller_name' => 'ProduitController',
        // ]);
    }

    #[Route('/produit', name: 'home')]
    public function home(): Response
    {
        return $this->render('produit/home.html.twig', [
            'homeController_name' => 'ProduitController',
        ]);
    }

    #[Route('/produit/show/{id}', name: 'produit_show')]
    //! id est en parametre de route, ce sera l'id de l'article
    public function show(Produit $produit) 
    //! en passant un objet produit a la methode, symfony conprend qu'il doit
    //! récuperer dans la bdd produit correspondant à l'id dans la route
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit //!j'envoie le produit au template  
        ]);
    }

    #[Route('/produit/form', name: 'produit_form')]
    #[Route("/produit/edit/{id}" , name: "produit_edit")]
    public function form(Request $request, EntityManagerInterface $manager, Produit $produit = null) 
    //! la class Request contient les données véhiculées par les superglobales
    {
        $produit = new Produit;
        $form = $this->createForm(ProduitType::class, $produit);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            // dd($produit);    
        $manager->persist($produit);
        $manager->flush();
        // redirige aprés l'envoi de données en bdd
        return $this->redirectToRoute('home');
        }

        // affiche les données dans la page show
        return $this->render('produit/form.html.twig',[
            'formProduit' => $form,
            'editMode' => $produit->getId() !== null,
            //* si nous sommes sur la route/new : editMode = 0
            //* sinon editMode = 1
        ]);
    }
   
}


