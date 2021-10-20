<?php

namespace App\Controller\Admin;

use App\Entity\User;
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
    // public function configureCrud(Crud $crud): Crud
    // {
    //     return $crud
    //         ->setEntityLabelInSingular('book')
    //         ->setEntityLabelInPlural('book');
    //         // ->setSearchFields(['id', 'Lastname', 'email']);
    // }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('books'),
            EmailField::new('Email','Adresse mail')->setDisabled(),
            HiddenField::new('Password')->hideOnIndex(),
            TextField::new('Firstname','Prénom')->setDisabled(),
            TextField::new('Lastname','Nom')->setDisabled(),
            DateField::new('Birthday','Date de naissance')->hideOnIndex(),
            ArrayField::new('roles')->hideOnIndex(),
            TextareaField::new('adress')->setDisabled(),

        ];
    }
    
}
