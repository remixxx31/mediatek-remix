<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
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
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // the visible title at the top of the page and the content of the <title> element
            // it can include these placeholders:
            //   %entity_name%, %entity_as_string%,
            //   %entity_id%, %entity_short_id%
            //   %entity_label_singular%, %entity_label_plural%
            ->setPageTitle('index', 'Livres')
            ->setPageTitle('edit', 'Livre')
            ->setPageTitle('new', 'Ajouter un Livre')
            // the help message displayed to end users (it can contain HTML tags)
            ->setHelp('edit', 'Vous pouvez modifier les informations sur le livre')
            ->setHelp('new', 'Vous pouvez ajouter un livre dans la catalogue de la médiathèque');
    }
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
            TextField::new('reservedFor', 'réservé pour')->setPermission('ROLE_AUTHOR'),
            DateField::new('loan_date', 'emprunté depuis le')->setDisabled($hasNotRoleAuthor),
            DateField::new('returnLoanDate', 'A rendre au plus tard')->setDisabled($hasNotRoleAuthor),
            AssociationField::new('holder', 'Détenteur')->autocomplete()->setDisabled($hasNotRoleAuthor)->setPermission('ROLE_AUTHOR'),
            // DateTimeField::new('createdAt')->onlyOnDetail(),
            TextEditorField::new('description')->setDisabled($hasNotRoleAuthor),
            BooleanField::new('disableAvailable')->onlyWhenUpdating(),
        ];
    }
    //pour ajouter le fichier JS
    public function configureAssets(Assets $assets): Assets
    {
        return $assets
            // adds the CSS and JS assets associated to the given Webpack Encore entry
            // it's equivalent to adding these inside the <head> element:
            // {{ encore_entry_link_tags('...') }} and {{ encore_entry_script_tags('...') }}
            ->addWebpackEncoreEntry('bookCrud');
    }
}
// // callables also receives the entire entity instance as the second argument
// ->formatValue(function ($value, $entity) {
//     return $entity->isPublished() ? $value : 'Coming soon...';
// });
