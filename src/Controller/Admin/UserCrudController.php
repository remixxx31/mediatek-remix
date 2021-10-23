<?php

namespace App\Controller\Admin;

use App\Entity\User;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            
            ->setSearchFields(['id', 'Lastname', 'email']);
            
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('books_holded','Livres en votre possesion')->setDisabled('ROLE_USER')
            ->addCssClass('fw-bold'),
            EmailField::new('Email','Adresse mail')->setPermission('ROLE_ADMIN')->setDisabled(),
            HiddenField::new('Password')->hideOnIndex(),
            TextField::new('Firstname','Prénom')->setDisabled(),
            TextField::new('Lastname','Nom')->setDisabled(),
            DateField::new('Birthday','Date de naissance')->hideOnIndex()->setDisabled(),
            ArrayField::new('roles')->hideOnIndex()->setPermission('ROLE_ADMIN'),
            TextareaField::new('adress')->setPermission('ROLE_AUTHOR'),

        ];
    }
    
}
