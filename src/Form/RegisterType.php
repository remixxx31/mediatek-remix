<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
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
                // 'constraints'=>new Length('min' = 2, 'max'= 30),
                'attr' => [
                    'class' => 'form-control mx-auto my-3',
                    'placeholder' => 'Merci de saisir votre prénom'
                    
                    ]
            ])
            ->add('lastName',TextType::class, [
                'label' => 'Nom',
                // 'constraints'=>new Length('min' = 2, 'max'= 30),

                'attr' => [
                    'class' => 'form-control mx-auto my-3',
                    'placeholder' => 'Merci de saisir votre nom'
                ]
                ])
            ->add('adress',TextType::class,
            [
                'label' => 'Adresse postale',
                // 'constraints'=>new Length('min' = 2, 'max'= 30),
                'attr' => [
                    'class' => 'form-control mx-auto my-3 ',
                    'placeholder' => ' au format n°: / nom de rue / CP / ville '
                ]
            ]
            )
            ->add('birthday', BirthdayType::class,
            [
                'label' => 'Date de naissance',
                'attr' => [
                    'class' => 'form-row form-control-sm mx-auto my-3',
                    'placeholder' => 'Merci de saisir votre date de naissance'
                ]
            ])
            ->add('email',EmailType::class,
            [
                'label' => 'adresse email',
                // 'constraints'=>new Length('min' = 2, 'max'= 30),
                'attr' => [
                    'class' => 'form-control mx-auto my-3',
                    'placeholder' => 'Merci de saisir votre email',
                ]
            ])
            ->add('password', RepeatedType::class,[
                'type' =>PasswordType::class,
                'invalid_message'=>'Le mot de passe et la confirmation doivent être identique.',
                'label' => 'Votre mot de passe',
                // 'constraints'=>new Length('min' = 2, 'max'= 30),
                'required' => true,
                'first_options'=>[
                    'label'=>'Mot de passe',
                    'placeholder' => 'Merci de saisir votre mot de passe'
                ],
                'second_options'=>[
                    'label'=>'Confirmez Votre mot de passe',
                    'placeholder' => 'Merci de confirmez votre mot de passe'
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
