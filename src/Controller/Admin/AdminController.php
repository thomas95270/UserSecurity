<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    #[Route('/admin/utilisateurs', name: 'app_listeUtilisateurs')]
    public function listeUtilisateurs(UserRepository $userRepository): Response
    {
        $users= $userRepository -> findAll();
        return $this->render('admin/listeUtilisateurs.html.twig', [
            'users' => $users
        ]);
    }
}
