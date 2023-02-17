<?php

namespace App\Controller\Admin;

use App\Entity\Panier;
use App\Form\ArticleFormType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class PanierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Panier::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('IdUser', "Client"),
            IdField::new('id', 'Code Panier')->onlyOnIndex(),
            CollectionField::new('articles','Articles')
                ->setEntryType(ArticleFormType::class)
                ->setFormTypeOption('by_reference', false)
                ->onlyOnForms(),
            CollectionField::new('articles', "Articles")
                ->setTemplatePath('articles.html.twig')
                ->onlyOnDetail(),
            DateTimeField::new('created_at')->onlyOnIndex(),
            DateTimeField::new('updated_at')->onlyOnIndex(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('new', 'Ajout Panier')
            ->setPageTitle('index', 'Consultation Panier');
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(CRUD::PAGE_INDEX, 'detail');
    }
    
}
