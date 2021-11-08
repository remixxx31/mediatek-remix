<?php

namespace App\Controller\Admin;

use App\Entity\Book;
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
        // dd($this->isGranted('ROLE_USER'));
        $hasNotRoleAuthor = !$this->isGranted('ROLE_AUTHOR');
        // $books = $this->getDoctrine()->getRepository(Book::class)->findAll();

        return [
            TextField::new('title', 'titre')->setDisabled($hasNotRoleAuthor),
            IntegerField::new('year', 'Année de parution')->hideOnIndex()->setDisabled($hasNotRoleAuthor),
            AssociationField::new('authorbook', 'Auteur')->setDisabled($hasNotRoleAuthor),
            AssociationField::new('category', 'Catégorie')->setDisabled($hasNotRoleAuthor),
            ImageField::new('cover', 'image')->setUploadDir("public/assets/images/cover_img")
                ->setBasePath("/assets/images/cover_img")
                ->setRequired(false)->setDisabled($hasNotRoleAuthor),
            BooleanField::new('available', 'Réserver'),
            DateField::new('loan_date', 'emprunté depuis le')->setDisabled($hasNotRoleAuthor),
            AssociationField::new('holder', 'Détenteur')->autocomplete()->setDisabled($hasNotRoleAuthor)->setPermission('ROLE_AUTHOR'),
            // DateField::new('loan_date',"date d'emprunt")->setPermission('ROLE_AUTHOR'),
            // DateTimeField::new('createdAt')->onlyOnDetail(),
            TextEditorField::new('description')->setDisabled($hasNotRoleAuthor),
        ];
    }
}
