<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $encoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);//transmet les info de la super globale $request (method=post ($query=method get))
        if ($form->isSubmitted() && $form->isValid()){
            /*
            appel de la methode hashPassword() de l'objet encoder pour hasher le mor de passe
            2paraetres :
                -utilisateur
                -mot de passe (on peut passer par $user->getPassword() ou par le formulaire $form->getData()->getPassword())
            */
            $password = $encoder->hashPassword($user, $user->getPassword());
            $user->setPassword($password);
            $manager->persist($user);
            $manager->flush();
            $this->addFlash('success', 'Bravo vous etes inscrit, vous pouvez maintenant vous connecter');

            return $this->redirectToRoute('app_front');
        }


        return $this->renderForm('front/inscription.html.twig', [
            'formUser' => $form
        ]);
    }
}
