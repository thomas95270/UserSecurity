<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label'=> false,
                'attr' => [
                    'placeholder' => 'Votre nom'
            ]])
            ->add('prenom', TextType::class, [
                'label'=> false,
                'attr' => [
                    'placeholder' => 'Votre prénom'
            ]])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre email'
            ]])
            // ->add('roles') l'utilisateurne choisit pas son role
            ->add('password', PasswordType::class,[
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre mot de passe'
            ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
