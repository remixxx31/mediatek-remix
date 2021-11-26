<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Entity\Book;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;

class AuthorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Author::class;
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->setPermission(Action::NEW, 'ROLE_AUTHOR')
            ->setPermission(Action::DELETE, 'ROLE_ADMIN')
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        $hasNotRoleAuthor = !$this->isGranted('ROLE_AUTHOR');
        return [
            IdField::new('id')->hideOnIndex()->hideOnForm(),
            TextField::new('name')->setDisabled($hasNotRoleAuthor),
            AssociationField::new('books','Bibliographie')->setDisabled($hasNotRoleAuthor),
            TextEditorField::new('description')->setDisabled($hasNotRoleAuthor),
            DateField::new('birthdate')->hideOnIndex()->setDisabled($hasNotRoleAuthor),

        ];
    }
    
}
