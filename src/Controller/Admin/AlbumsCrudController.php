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
class AlbumsCrudController extends AbstractCrudController
{
    public const ACTION_DUPLICATE = 'duplicate';
    // public const ALBUM_BASE_PATH = 'plugs/photo/albums';
    // public const ALBUM_UPLOAD_DIR = 'public/plugs/photo/albums';


    public static function getEntityFqcn(): string
    {
        return Albums::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'), Date
            AssociationField::new('IdMariage', "Mariage"),
            AssociationField::new('id_fest', "Festivité"),
            TextField::new('Nom')->hideOnForm(),
            TextareaField::new('albumFile')
            ->setFormType(VichImageType::class),
            // ImageField::new('albumFile')
            //         ->setFormType(VichImageType::class)
            //         ->setLabel('Image')
            //     ,
            DateField::new('Date'),
            DateTimeField::new('created_at')->hideOnForm(),
            DateTimeField::new('updated_at')->hideOnForm(),
            TextField::new('Type')
                ->hideOnForm(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $editAlbum = Action::new(self::ACTION_DUPLICATE)
            ->linkToCrudAction('editAlbum');

        return $actions
            ->add(Crud::PAGE_EDIT, $editAlbum);
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Albums) return ;

        $entityInstance->setNom($entityInstance->getChemin());
        $entityInstance->setType('Album');
        $entityInstance->setCreatedAt(new \DateTimeImmutable);
        $entityInstance->setUpdatedAt(new \DateTimeImmutable);

        parent::persistEntity($em, $entityInstance);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('new', 'Ajout Album')
            ->setPageTitle('index', 'Consultation Album');
    }
    
}
