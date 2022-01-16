<?php

namespace App\Controller\Admin;

use App\Entity\VideoGame;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VideoGameCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VideoGame::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextEditorField::new('description'),
            ImageField::new('picture')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads/videoGame_pictures')
                ->setFormType(FileUploadType::class)
                ->setUploadedFileNamePattern('[randomhash].[extension]')
        ];
    }

}
