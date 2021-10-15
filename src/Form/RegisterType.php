<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName',TextType::class ,
            [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre prénom'
                    
                    ]
            ])
            ->add('lastName',TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre nom'
                ]
                ])
            ->add('adress',TextType::class,
            [
                'label' => 'Adresse postale',
                'attr' => [
                    'placeholder' => ' au format n°: / nom de rue / CP / ville '
                ]
            ]
            )
            ->add('birthday', BirthdayType::class,
            [
                'label' => 'Date de naissance',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre date de naissance'
                ]
            ])
            ->add('email',EmailType::class,
            [
                'label' => 'adresse email',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre email',
                ]
            ])
     
            ->add('password_confirm',RepeatedType::class,
            [
                'type' => PasswordType::class,
                'invalid_message'=> 'Le mot de passe et la confirmation doivent être identique.',
                'required' => true,
                'first_options' => [ 'label'=> 'Mot de passe'],
                'second_options' => [ 'label'=> 'Confirmez votre mot de passe'],
                'attr' => [
                    'placeholder' => 'Merci de saisir votre mot de passe',
                ]
            ])
            ->add('submit', SubmitType::class,
            [
                'label' => "S'inscrire"
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
