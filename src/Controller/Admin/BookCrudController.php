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
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BookCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Book::class;
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->setPermission(Action::NEW, 'ROLE_AUTHOR')
            ->setPermission(Action::DELETE, 'ROLE_ADMIN')
        ;
    }
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
            FormField::addPanel('Descriptif du livre'),
            TextField::new('title', 'titre')->setDisabled($hasNotRoleAuthor)->setColumns(7),
            IntegerField::new('year', 'Année de parution')->hideOnIndex()->setDisabled($hasNotRoleAuthor)->setColumns(5),
            AssociationField::new('authorbook', 'Auteur')->setDisabled($hasNotRoleAuthor)->setColumns(7),
            AssociationField::new('category', 'Catégorie')->setDisabled($hasNotRoleAuthor)->setColumns(5),
            ImageField::new('cover', 'image')->setUploadDir("public/assets/images/cover_img")
            ->setBasePath("/assets/images/cover_img")
            ->setRequired(false)->setDisabled($hasNotRoleAuthor),
            TextEditorField::new('description')->setDisabled($hasNotRoleAuthor),
            FormField::addPanel('Gestion du prêt'),
            BooleanField::new('available', 'Réserver')->setColumns(2),
            TextField::new('reservedFor', 'réservé pour')->setColumns(4),
            FormField::addRow(),
            DateField::new('loan_date', 'emprunté depuis le')->setDisabled($hasNotRoleAuthor)->setColumns(4),
            DateField::new('returnLoanDate', 'A rendre au plus tard')->setDisabled($hasNotRoleAuthor)->setColumns(4),
            AssociationField::new('holder', 'Détenteur')->autocomplete()->setDisabled($hasNotRoleAuthor)->setPermission('ROLE_AUTHOR'),
            // DateTimeField::new('createdAt')->onlyOnDetail(),
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
