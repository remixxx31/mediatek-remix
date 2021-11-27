<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/compte", name="account")
     */

    public function index(): Response
    {
        $user = $this->getUser();
        
        return $this->render('account/index.html.twig', [
            'booksHolded' => $user ? $user->getBooksHolded() : [],
        ]);
    }
}
