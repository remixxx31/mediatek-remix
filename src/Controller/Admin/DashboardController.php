<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Entity\Kind;
use App\Entity\User;
use App\Entity\State;
use App\Entity\Author;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
       
        // return parent::index();
            // redirect to some CRUD controller
            // $routeBuilder = $this->get(AdminUrlGenerator::class);
            // return $this->redirect($routeBuilder->setController(BookCrudController::class)->generateUrl());            
            $routeBuilder = $this->get(AdminUrlGenerator::class);
            return $this->redirect($routeBuilder->setController(BookCrudController::class)->generateUrl());
        // // you can also redirect to different pages depending on the current user
        // if ('ROLE_USER' === $this->getUser()->getRoles()) {
        //     return $this->redirect($routeBuilder->setController(BookCrudController::class)->generateUrl());
        // }

    }
    

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Mediatek');    
    }
    public function configureMenuItems(): iterable
    {
        // $hasNotRoleAuthor = !$this->isGranted('ROLE_AUTHOR');
        // yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linktoRoute('Mon compte', 'fas fa-reply', 'account');
        // yield MenuItem::linkToRoute('Abonnés', 'fas fa-eye', User:class)->setPermission('ROLE_AUTHOR');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class)->
        setPermission('ROLE_AUTHOR');
        yield MenuItem::linkToCrud('Livres', 'fas fa-book', Book::class);
        yield MenuItem::linkToCrud('Genres', 'fas fa-folder', Kind::class);
        yield MenuItem::linkToCrud('Auteurs', 'fas fa-feather', Author::class);
    }
}
