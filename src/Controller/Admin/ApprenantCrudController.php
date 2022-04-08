<?php

namespace App\Controller\Admin;

use App\Entity\Apprenant;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class ApprenantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Apprenant::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->onlyOnIndex(),
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('sex'),
            DateField::new('date_naissance'),
            TextField::new('lieu_naissance'),
            TextField::new('adresse'),
            IntegerField::new('telephone'),
            TextField::new('nom_parent'),
            TextField::new('prenom_parent'),
            TextField::new('profession_parent'),
            IntegerField::new('contact_parent'),
            TextField::new('username'),
            TextField::new('password'),
            AssociationField:: new('profil'),
        ];
    }
    
}
