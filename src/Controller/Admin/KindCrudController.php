<?php

namespace App\Controller\Admin;

use App\Entity\Kind;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class KindCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Kind::class;
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
            ->setPageTitle('edit', 'Genre')
            // the help message displayed to end users (it can contain HTML tags)
            ->setHelp('edit', 'Vous pouvez rajouter ou supprimer des types de livres dans cette partie');
    }
    
    public function configureFields(string $pageName): iterable
    {
        $hasNotRoleAuthor = !$this->isGranted('ROLE_AUTHOR');

        return [
            IdField::new('id')->hideOnIndex()->hideOnForm(),
            TextField::new('designation')->setDisabled('$hasNotRoleAuthor'),
        ];
    }
   
}
