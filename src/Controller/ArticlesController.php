<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Comments;
use App\Form\CommentsType;
use App\Form\Articles1Type;
use App\Repository\ArticlesRepository;
use App\Repository\CommentsRepository;
use Symfony\Component\HttpFoundation\Request;
use function PHPUnit\Framework\throwException;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\CssSelector\Parser\Handler\CommentHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/articles")
 */
class ArticlesController extends AbstractController
{
    /**
     * @Route("/", name="articles_retour", methods={"GET"})
     */
    public function retour(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'articles' => $articlesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_articles_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ArticlesRepository $articlesRepository): Response
    {
        $article = new Articles();
        $form = $this->createForm(Articles1Type::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articlesRepository->add($article);
            return $this->redirectToRoute('app_articles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('articles/new.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    // MA SECTION COMMENTAIRE
    /**
     * @Route("/comment", name="articles_comments", methods {"GET", "POST"})
     */

    public function comment(Request $request, ArticlesRepository $articlesRepository): Response
    {
        
        // J'INSTACIE MON COMMENTAIRE
        $comment = new Comments();
        $comment = $this->createForm(CommentsType::class, $commentsRepository);
        $comment->handleRequest($request);

        return $this->render('articles/details.html.twig', [
            'article' => $articlesRepository,
            'form' => $form->createView(),
            'commentForm' => $commentForm->createView()
        ]);
    }

    //  MA SECTION DETAILS
    /**
     * @Route("/details/{id}", name="articles_details", methods={"GET"})
     */
    public function details($id, ArticlesRepository $articlesRepository): Response
    {
        $article = $articlesRepository->findOneBy(['id' => $id]);

        // if(!$article){
        //     throw new NotFoundHttpException('MMMMMMMMMMMMMOOOOOOO');
        // }

        // dd($article);
        return $this->render('articles/details.html.twig', compact('article'));
    }

    /**
     * @Route("/{id}/edit", name="app_articles_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Articles $article, ArticlesRepository $articlesRepository): Response
    {
        $form = $this->createForm(Articles1Type::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articlesRepository->add($article);
            return $this->redirectToRoute('app_articles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('articles/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_articles_delete", methods={"POST"})
     */
    public function delete(Request $request, Articles $article, ArticlesRepository $articlesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $articlesRepository->remove($article);
        }

        return $this->redirectToRoute('app_articles_index', [], Response::HTTP_SEE_OTHER);
    }
}
