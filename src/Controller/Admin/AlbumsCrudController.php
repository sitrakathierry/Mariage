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
            AssociationField::new('IdTypeFest', "Festivité"),
            AssociationField::new('IdMariage', "Mariage"),
            TextField::new('Nom')->hideOnForm(),
            // TextareaField::new('albumFile')
            // ->setFormType(VichImageType::class),
            // ImageField::new('albumFile')
            //         ->setFormType(VichImageType::class)
            //         ->setLabel('Image')
            //     ,
            Field::new('albumFile')
            ->setFormType(VichImageType::class)
            ->setLabel('Contenu')
            ->hideOnIndex(),
            DateField::new('Date'),
            DateTimeField::new('created_at')->hideOnForm(),
            DateTimeField::new('updated_at')->hideOnForm(),
            TextField::new('Type')->hideOnForm(),
        ];
    }


    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Albums) return;
        $entityInstance->setNom('Album');
        $entityInstance->setType('Album');
        $entityInstance->setCreatedAt(new \DateTimeImmutable);
        parent::persistEntity($em, $entityInstance);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('new', 'Ajout Image/Audio')
            ->setPageTitle('index', 'Consultation Contenu');
    }
    
}
