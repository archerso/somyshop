<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            
        ]);
    }
    #[Route('/admin/produit/gestion', name: 'admin_produit_gestion')]
    public function gestionProduit(ProduitRepository $repo)
    {
        $produit = $repo->findAll();
        return $this->render('admin/gestionProduit.html.twig', [
            'produit' => $produit
            
        ]);
    }
    

    
}
