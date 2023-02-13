<?php

namespace App\Controller\Admin;

use App\Entity\Festivites;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
class FestivitesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Festivites::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('IdMariage', 'Mariage de '),
            TextField::new('NomFest', 'Nom Festivité'),
            TextField::new('Lieu'),
            TextField::new('Ville'),
            DateField::new('Date'),
            TimeField::new('Heure'),
            DateTimeField::new('created_at')->hideOnForm(),
            DateTimeField::new('updated_at')->hideOnForm(),
        ];
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Festivites) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable);
        $entityInstance->setUpdatedAt(new \DateTimeImmutable);
        parent::persistEntity($em, $entityInstance);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('new', 'Ajout Festivités')
            ->setPageTitle('index', 'Consultation Agenda') ;
    }
    
}
