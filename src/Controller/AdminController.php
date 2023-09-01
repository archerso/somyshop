<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            
        ]);
    }
    #[Route('/admin/produit/gestion', name: 'admin_produit_gestion')]
    public function gestionProduit(ProduitRepository $repo)
    {
        $produit = $repo->findAll();
        return $this->render('admin/admin.gestion.html.twig', [
            'produits' => $produit
            
        ]);
    }

    //!creation d'une methode avec 2 route differentes

    #[Route('admin/produit/update/{id}', name: 'admin_produit_update')]
    #[Route('admin/produit/new', name: 'admin_produit_new')]
    public function formProduit(Request $request, EntityManagerInterface $manager, Produit $produit = null) 
    //! la class Request contient les données véhiculées par les superglobales
    {
        if($produit == null)
        {
            $produit = new Produit;
        }
        
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            // dd($produit); 
            $produit->setdateenregistrement(new \dateTime);   
            $manager->persist($produit);
            $manager->flush();
            
            // redirige aprés l'envoi de données en bdd
            return $this->redirectToRoute('admin_article_gestion');
        }
        
        // affiche les données dans la page admin
        return $this->render('admin/gestionProduit.html.twig',[
            'formProduit' => $form,
            'editMode' => $produit->getId() !== null,
            //* si nous sommes sur la route/new : editMode = 0
            //* sinon editMode = 1
        ]);
    }
    // !creation method delete

  #[Route('admin/produit/delete/{id}', name: 'admin_produit_delete')]
    public function deleteProduit(Produit $produit, EntityManagerInterface $manager) 
          {
             
            $manager->remove($produit);
            $manager->flush();
            
            // redirige aprés la suppression de l'article
            return $this->redirectToRoute('admin_produit_gestion');
        }
    
}
