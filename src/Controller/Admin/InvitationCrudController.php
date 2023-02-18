<?php

namespace App\Controller\Admin;

use App\Entity\Invitation;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;


class InvitationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Invitation::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nomMariees', 'Les Mariées'),
            Field::new('invitationFile')
                ->setFormType(VichImageType::class)
                ->setLabel("Photo d'invitation")
                ->hideOnIndex(),
            TextEditorField::new('motInvitation', 'Lettre d\'invitation')
                ->setFormType(CKEditorType::class),
            DateTimeField::new('created_at')->hideOnForm(),
            DateTimeField::new('updated_at')->hideOnForm(),

        ];
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Invitation) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable);
        $entityInstance->setUpdatedAt(new \DateTimeImmutable);

        parent::persistEntity($em, $entityInstance);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('new', 'Ajout Invitation')
            ->setPageTitle('index', 'Consultation Invitation')
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }
}
