<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AdminCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Admin::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->onlyOnIndex(),
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('sex'),
            TextField::new('adresse'),
            TextField::new('username'),
            TextField::new('password'),
            AssociationField:: new('profil'),
            IntegerField::new('telephone'),
        ];
    }

}
