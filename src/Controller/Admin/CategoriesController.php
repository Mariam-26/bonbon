<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Form\CategoriesType;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/categories", name="admin_categories_")
 * @package App\Controller\Admin
 */
class CategoriesController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CategoriesRepository $categorieRepository): Response
    {
        return $this->render('admin/categories/index.html.twig', [
            'categories' => $categorieRepository->findAll()
        ]);
    }

    /**
     * @Route("/ajout", name="ajout")
     */
    public function ajoutCategorie(Request $request, CategoriesRepository $categoriesRepository): Response
    {
        $categorie = new Categories;

        $form = $this->createForm(CategoriesType::class, $categorie);
         $form->handleRequest($request);
        
         if ($form->isSubmitted() && $form->isValid()) {
             $em = $this->getDoctrine()->getManager();
             $em->persist($categorie);
             $em->flush();
             $categoriesRepository->add($categorie);
             
             return $this->redirectToRoute('admin_categories_home');
         }
         
        return $this->renderForm('admin/categories/ajout.html.twig', [
            'form' => $form,
            'categorie' => $categorie,

        ]);
    }

     /**
     * @Route("/modifier/{id}", name="modifier")
     */
    public function modifCategorie(Categories $categorie, Request $request): Response
    {
        $form = $this->createForm(CategoriesType::class, $categorie);
         $form->handleRequest($request);
        
         if ($form->isSubmitted() && $form->isValid()) {
             $em = $this->getDoctrine()->getManager();
             $em->persist($categorie);
             $em->flush();
             
             return $this->redirectToRoute('admin_categories_home');
         }
         
        return $this->renderForm('admin/categories/ajout.html.twig', [
            'form' => $form,
            'categorie' => $categorie,

        ]);
    }
    
}
