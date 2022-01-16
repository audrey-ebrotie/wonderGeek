<?php

namespace App\Controller\Admin;

use App\Entity\Comic;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ComicCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comic::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextEditorField::new('description'),
            ImageField::new('picture')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads/comic_pictures')
                ->setFormType(FileUploadType::class)
                ->setUploadedFileNamePattern('[randomhash].[extension]')
        ];
    }
}
