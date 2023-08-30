<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }

    #[Route('/produit', name: 'home')]
    public function home(): Response
    {
        return $this->render('produit/home.html.twig', [
            'homeController_name' => 'ProduitController',
        ]);
    }

    #[Route('/produit/show', name: 'produit_show')]
    public function show() 
    {
        return $this->render('produit/show.html.twig');
    }

    #[Route('/produit/form', name: 'produit_form')]
    public function form(Request $request, EntityManagerInterface $manager) 
    //! la class Request contient les données véhiculées par les superglobales
    {
        $produit = new Produit;
        $form = $this->createForm(ProduitType::class, $produit);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
        $manager->persist($produit);
        $manager->flush();
        }
        return $this->render('produit/form.html.twig',[
            'formProduit' => $form
        ]);
    }
    // #[Route('/produit/form', name: 'produit_formshow')]
    // return $this->render('nomducontrollerenminuscule/nomdufichierdeformulaire.html.twig', [
    //     // on renvoie le formulaire à la vue
    //      'form'=>$form->createView()
     
    //  ]);
}


