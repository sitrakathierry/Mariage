<?php

namespace App\Controller\Admin;

use App\Entity\Albums;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AlbumsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Albums::class;
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
