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
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'disabled' => true,
                'label' => 'Votre email'

            ])
            
            ->add('firstname', TextType::class,[
                'disabled' => true,
                'label' => 'Mon prénom'
                ])
                ->add('lastname', TextType::class,[
                    'disabled' => true,
                    'label' => 'Mon nom'
                    ])
            ->add('old_password', PasswordType::class,[
                'label' => 'Mon mot de passe actuel',
                'mapped'=>false,
                'attr' => [
                    'placeholder' => 'Veuillez saisir votre mot de passe actuel'
                
                ]
            ])
            ->add('new_password', RepeatedType::class,[
                'type' =>PasswordType::class,
                'invalid_message'=>'Le mot de passe et la confirmation doivent être identique.',
                'mapped' => false,
                'label' => 'Votre mot de passe',
                'constraints'=>new Length([
                    'min'=>5,
                    'max'=> 30
                ]),
                'required' => true,
                'first_options'=>[
                    'label'=>'Mon nouveau mot de passe',
                    'empty_data' => 'Merci de saisir votre mot de passe'
                ],
                'second_options'=>[
                    'label'=>'Confirmez votre nouveau mot de passe',
                    'empty_data' => 'Merci de confirmez votre nouveau mot de passe'
                ]
            ])
           
         
            ->add('submit', SubmitType::class,
            [
                'label' => "Valider"
                // 'attr'=>['class'=> 'mt-3']
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
