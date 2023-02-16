<?php

namespace App\Controller\Admin;

use App\Entity\Albums;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField; 
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use App\Field\VichImageField;
use App\Form\AttachementType;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class AlbumsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Albums::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'), Date
            AssociationField::new('IdTypeFest', "Festivité")
                ->setRequired(true),
            AssociationField::new('IdMariage', "Mariage")
                ->setRequired(true),
            TextField::new('Nom')->hideOnForm(),
            // TextareaField::new('albumFile')
            // ->setFormType(VichImageType::class),
            // ImageField::new('albumFile')
            //         ->setFormType(VichImageType::class)
            //         ->setLabel('Image')
            //     ,
            DateField::new('Date')
                ->setRequired(true),
            CollectionField::new('attachements', "Images")
            ->setEntryType(AttachementType::class)
            ->setFormTypeOption('by_reference', false)
            ->onlyOnForms(),
            
            // Field::new('albumFile')
            // ->setFormType(VichImageType::class)
            // ->setLabel('Contenu')
            // ->hideOnIndex(),
            DateTimeField::new('created_at')->hideOnForm(),
            DateTimeField::new('updated_at')->hideOnForm(),
            TextField::new('Type')->hideOnForm(),
            CollectionField::new('attachements', "Images")
                ->setTemplatePath('images.html.twig')
                ->onlyOnDetail() 
        ];
    }


    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Albums) return;
        $entityInstance->setNom('Album');
        $entityInstance->setType('Album');
        $entityInstance->setCreatedAt(new \DateTimeImmutable);
        $entityInstance->setUpdatedAt(new \DateTimeImmutable);
        parent::persistEntity($em, $entityInstance);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('new', 'Ajout Image/Audio')
            ->setPageTitle('index', 'Consultation Contenu');
    }

    public function configureActions(Actions $actions): Actions
    {

        return $actions->add(CRUD::PAGE_INDEX, 'detail');
    }
    
}
