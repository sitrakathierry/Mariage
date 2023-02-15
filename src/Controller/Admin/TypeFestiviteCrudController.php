<?php

namespace App\Controller\Admin;

use App\Entity\TypeFestivite;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeFestiviteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeFestivite::class;
    }
    

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Festivite'),
            DateTimeField::new('created_at')->hideOnForm(),
            DateTimeField::new('updated_at')->hideOnForm(),
        ];
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof TypeFestivite) return;
        $entityInstance->setCreatedAt(new \DateTimeImmutable);
        $entityInstance->setUpdatedAt(new \DateTimeImmutable);
        parent::persistEntity($em, $entityInstance);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('new', 'Ajout Festivité')
            ->setPageTitle('index', 'Consultation Festivités');
    }
}
