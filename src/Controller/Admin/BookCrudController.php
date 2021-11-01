<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use APP\Controller\Admin\BookCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BookCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Book::class;
    }

    // public function configureActions(Actions $actions):Actions

    // {
    //     $LinkExterne = Action::new('LinkExterne','Github','fa fa-glob')
    //      ->linkToUrl(url:"https://github.com")
    //      ->addCssClass(cssClass:'btn btn-success')
    //      ->setHtmlAttributes([
    //          'target' => '_blank',
    //      ])
    //     ->addCssClass(cssClass:'btn btn-success')
    //     ;
    //     return $actions
    //     ->setPermission(Action::DELETE, 'ROLE_BOOK_CRUD')
    //     ->disable(Action::DELETE)
    //     ->add( Crud::PAGE_INDEX, $linkExterne)

      
    // }
    public function configureFields(string $pageName): iterable
    {

        return [
            TextField::new('title','titre')->setPermission('ROLE_AUTHOR'),
            IntegerField::new('year','Année de parution')->hideOnIndex()->setPermission('ROLE_AUTHOR'),
            AssociationField::new('authorbook', 'Auteur')->setPermission('ROLE_AUTHOR'),
            AssociationField::new('category','Catégorie')->setPermission('ROLE_AUTHOR'),
            ImageField::new('cover')->setUploadDir("public/assets/images/cover_img")
            ->setBasePath("/assets/images/cover_img")
            ->setRequired(false)->setDisabled('ROLE_USER')->setPermission('ROLE_AUTHOR'),
            BooleanField::new('available','Réserver'),
            DateField::new('loan_date','emprunté depuis le')->setPermission('ROLE_AUTHOR'),
            AssociationField::new('holder','Détenteur')->autocomplete()->setPermission('ROLE_AUTHOR'),
            // DateField::new('loan_date',"date d'emprunt")->setPermission('ROLE_AUTHOR'),
            TextEditorField::new('description')->setDisabled('ROLE_USER'),
        ];
    }
    
}
