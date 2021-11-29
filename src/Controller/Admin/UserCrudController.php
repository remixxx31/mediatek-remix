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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * @Security("is_granted('ROLE_AUTHOR')")
 */
class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setSearchFields(['id', 'lastname', 'email'])
        ->setPageTitle('index', 'Abonnés')->setPageTitle('edit', 'Abonné')
        ->setHelp('edit', 'Les informations vous concernant');

        // the help message displayed to end users (it can contain HTML tags)
    }
    

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('books_holded', 'Livres en votre possesion')
                ->addCssClass('fw-bold'),
            EmailField::new('email', 'Adresse mail')->setPermission('ROLE_AUTHOR')->setDisabled(),
            HiddenField::new('Password')->hideOnIndex(),
            TextField::new('Firstname', 'Prénom')->setDisabled(),
            TextField::new('lastname', 'Nom')->setDisabled(),
            DateField::new('birthday', 'Date de naissance')->hideOnIndex()->setDisabled(),
            ArrayField::new('roles')->hideOnIndex()->setPermission('ROLE_ADMIN'),
            TextareaField::new('adress')->setPermission('ROLE_AUTHOR')->hideOnIndex(),
        ];
    }
}
