<?php

namespace App\Controller\Admin;

use App\Entity\Mariage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MariageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mariage::class;
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
