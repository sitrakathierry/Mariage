<?php

namespace App\Controller\Admin;

use App\Entity\Mariage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

use Vich\UploaderBundle\Form\Type\VichImageType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
class MariageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mariage::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('NomHomme', 'Le marié'),
            TextField::new('NomFemme', 'La mariée'),
            Field::new('couvertureFile')
                ->setFormType(VichImageType::class)
                ->setLabel('Photo de couverture')
                ->setRequired(true),
            DateTimeField::new('created_at')->hideOnForm(),
            DateTimeField::new('updated_at')->hideOnForm(),
        ];
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Mariage) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable);
        $entityInstance->setUpdatedAt(new \DateTimeImmutable);
        parent::persistEntity($em, $entityInstance);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('new', 'Ajout Mariage')
            ->setPageTitle('index', 'Consultation Mariage');
    }
}
