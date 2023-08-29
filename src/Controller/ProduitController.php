<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

}
