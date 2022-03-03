<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    //declaration d'une propriété privée qu icontiendra mon objet de la classe UserPasswordInterface
    private $encoder;
    //Pour définir la valeur de ma propriété privée $encoder, j'utilise la méthode magique __construct() qui sera appelée automatiquement lorque j'utiliserai la classe A^^Fixtures
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager): void
    {
        $user = new User();

        //stockage du mot de passe hashé
        $password = $this->encoder->hashPassword($user,'mdp');
        //on hydrate l'objet $user
        $user
            -> setPrenom('Thomas')
            -> setNom('VANDEN MAAGDENBERG')
            -> setEmail('admin@gmail.com')
            -> setRoles(['ROLE_ADMIN'])
            -> setPassword($password);

        //preparation de l'envoie vers BDD
        $manager->persist($user);
        
        //envoi vers BDD
        $manager->flush();
    }
}
