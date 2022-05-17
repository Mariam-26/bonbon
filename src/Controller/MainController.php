<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */

    public function index(ArticlesRepository $articlesRepository): Response
    {
        
        return $this->render('main/index.html.twig', [
            'articles' => $articlesRepository->findAll('DESC', 4),
        ]);     
    } 
    
}
