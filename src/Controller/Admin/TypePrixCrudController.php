<?php

namespace App\Controller\Admin;

use App\Entity\TypePrix;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TypePrixCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypePrix::class;
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
