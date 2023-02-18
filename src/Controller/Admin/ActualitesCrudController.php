<?php

namespace App\Controller\Admin;

use App\Entity\Actualites;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Asset;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class ActualitesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Actualites::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Titre'),
            DateField::new('Date'),
            Field::new('actualitesFile')
                ->setFormType(VichImageType::class)
                ->setLabel('Photo de l\'actualité')
                ->hideOnIndex(),
            TextEditorField::new('Explication')
            ->setFormType(CKEditorType::class),
            TextField::new('Auteur')->setRequired(true),
            DateTimeField::new('created_at')->hideOnForm(),
            DateTimeField::new('updated_at')->hideOnForm(),
        ];
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Actualites) return;
        $entityInstance->setCreatedAt(new \DateTimeImmutable);
        $entityInstance->setUpdatedAt(new \DateTimeImmutable);
        parent::persistEntity($em, $entityInstance);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('new', 'Ajout Actualités')
            ->setPageTitle('index', 'Consultation Actualités')
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }

    // public function configureAssets(Assets $assets): Assets
    // {
    //     return $assets
    //         ->addCssFile(Asset::new('plugs/admin/summernote/summernote-bs3.css')->preload())
    //         ->addCssFile(Asset::new('plugs/admin/summernote/summernote.css')->preload())
    //         ->addJsFile(Asset::new('plugs/predefinie/js/jquery.js')->preload())
    //         ->addJsFile(Asset::new('plugs/admin/summernote/summernote.min.js')->preload())
    //         ->addJsFile(Asset::new('plugs/admin/summernote/main.js')->preload());
    // }
}

