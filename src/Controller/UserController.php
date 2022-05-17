<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticlesType;
use App\Form\EditProfileType;
use App\Repository\UserRepository;
use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="app_user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/user/articles/ajout", name="user_articles_ajout")
     */
    public function ajoutArticle(Request $request, ArticlesRepository $articlesRepository): Response
    {
        $article = new Articles;

        $form = $this->createForm(ArticlesType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('app_user');
        }

        return $this->render('user/articles/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/profil/modifier", name="user_profil_modifier")
     */
    public function editProfile(Request $request, UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);

        if ($form->isSubmitted() && $form->isValid()) {          
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirectToRoute('app_user');
        }

        return $this->render('user/editprofile.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/pass/modifier", name="user_pass_modifier")
     */
    public function editPass(Request $request, UserPasswordEncoderInterface $userPasswordEncoder): Response
    {
        if($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();

            $user = $this->getUser();
            
            // JE VERIFIE SI LES DEUX MOTS SE PASS SONT IDENTIQUES
            if($request->request->get('pass') == $request->request->get('pass2')) {
                $user->getPassword($userPasswordEncoder->encodePassword($user, $request->request->get('pass')));
                $em->flush();
                $this->addFlash('message', 'Mot de passe mis à jour avec succès');
                
                return $this->redirectToRoute('app_user');
            }else {
                $this->addFlash('error', 'Les deux mots passe ne sont pas identiques');
            }
        }

        return $this->render('user/editpass.html.twig');
    }

}
