<?php

namespace App\Controller\Admin;

use App\Entity\Prix;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PrixCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Prix::class;
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
