<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/articles", name="admin_articles_")
 * @package App\Controller\Admin
 */
class ArticlesController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('admin/articles/index.html.twig', [
            'articles' => $articlesRepository->findAll()
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="supprimer")
     */
    public function supprimer(Articles $article): Response
    {
            $em = $this->getDoctrine()->getManager();
             $em->remove($article);
             $em->flush();

             $this->addFlash('message', 'Article supprimé avec succès');
             return $this->redirectToRoute('admin_articles_home');
    }


    // /**
    //  * @Route("/details/{id}", name="details")
    //  */
    // public function details($id, ArticlesRepository $articlesRepository): Response
    // {
    //     $article = $articlesRepository->findBy(['id' => $id]);

    //     if(!$article){
    //         throw new NotFoundHttpException('Pas d\'aticle trouvé);
    //     }
    //     return $this->render('admin/articles/index.html.twig', [
    //         'articles' => $articlesRepository,
    //     ]);
    // }


    /**
     * @Route("/{id}", name="admin_articles_show", methods={"GET"})
     */
    public function show(Articles $article): Response
    {
        return $this->render('articles/show.html.twig', [
            'article' => $article,
        ]);
    }
}


