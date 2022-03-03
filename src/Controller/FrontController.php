<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{
    #[Route('/', name: 'app_front')]
    public function index(): Response
    {
        return $this->render('front/index.html.twig', [
        ]);
    }
    
    /** 3 methodes pour isGranted */

    #[Route('/profil', name: 'app_profil')]
    public function profil(): Response
    {
    //dans le controlleur, on peut recuperer l'utilisateur à n'importe quel moment grace $this->getUser()

    // On peut gérer l'accessibilité aux routes directement dans la méthode
    // On a accès à une méthode d'AbstractController pour gérer les autorisations.
        if ( $this->isGranted("ROLE_USER") ){
            return $this->render('front/profil.html.twig', [
                'user' => $this->getUser()
            ]);
        }else{
            return $this->redirectToRoute("app_login");
        }
    }

    /* *******************
    #[IsGranted("ROLE_USER")]  (à décommenter)
    #[Route('/profil', name: 'app_profil')]
    public function profil(): Response
    {
        return $this->render('front/profil.html.twig', [
            'user' => '$this-getUser()'
        ]);
    }
    */
    /* *******************
Dans SecurityController
    #[@Route("/connexion", name="app_login")]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        Ici on limite l'accès à la page de connexion. 
        Si on est déjà connecté on sera redirigé vers la page 'app_profil'
        if ($this->getUser()) {
            return $this->redirectToRoute('app_profil');
        }

    */


}
