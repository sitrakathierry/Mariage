<?php

namespace App\Controller\Admin;

use App\Entity\TypeOffre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TypeOffreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeOffre::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
