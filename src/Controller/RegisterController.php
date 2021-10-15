<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class RegisterController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/inscription", name="register")
     */
    public function index(Request $request, UserPasswordHasherInterface $hasher, UrlGeneratorInterface $urlgenerator): Response
    {
        $user = new User();//instancion de la classe user
        $form = $this->createForm(RegisterType::class);

        $form ->handleRequest($request);//recupère saisie de l'utilisateur

        if($form->isSubmitted()&&$form->isValid()){
            $user = $form->getData();
            $password = $hasher->hashPassword($user, $user->getPassword());
            $user->setPassword($password);
           

            $this->entityManager->persist($user);
            $this->entityManager->flush();
            // dd($user);
            
            return new RedirectResponse($urlgenerator->generate('app_login'));
        }


        return $this->render('register/index.html.twig', [
            'form' => $form->createView(), //création de la vue
            
        ]);
    }
}

