<?php

namespace App\Controller\Admin;

use App\Entity\Attachement;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use Vich\UploaderBundle\Form\Type\VichImageType;


class AttachementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Attachement::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('album', 'Album'),
            Field::new('imageFile')
                ->setFormType(VichImageType::class)
                ->setLabel('Image')
                ->hideOnIndex()
                ->hideOnDetail(),
            ImageField::new('image')
                ->setBasePath('plugs/photo/albums')
                ->setLabel('Image')
                ->onlyOnDetail(),
            DateTimeField::new('created_at')->hideOnForm(),
            DateTimeField::new('updated_at')->hideOnForm(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(CRUD::PAGE_INDEX, 'detail');
    }
}
