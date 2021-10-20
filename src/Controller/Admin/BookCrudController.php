<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use APP\Controller\Admin\BookCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
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
            TextField::new('title','titre'),
            IntegerField::new('year','Année de parution'),
            AssociationField::new('authorbook', 'Auteur'),
            AssociationField::new('category','Catégorie'),
            ImageField::new('cover')->setUploadDir("public/assets/images/cover_img")
            ->setBasePath("/assets/images/cover_img")
            ->setRequired(false),
            BooleanField::new('available','Emprunt'),
            AssociationField::new('holder','Détenteur')->autocomplete()->,
            TextEditorField::new('description'),
        ];
    }
    
}
