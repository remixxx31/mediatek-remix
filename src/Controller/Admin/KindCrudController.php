<?php

namespace App\Controller\Admin;

use App\Entity\Kind;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class KindCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Kind::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex()->hideOnForm(),
            TextField::new('designation')->setDisabled('ROLE_USER'),
            AssociationField::new('category')
        ];
    }
   
}
