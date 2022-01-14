<?php

namespace App\Service;

use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderHelper
{
    public function __construct(string $uploadsPath)
    {
        $this->uploadsPath = $uploadsPath;
    }

    public function uploadEventPicture(UploadedFile $uploadedFile): string
    {
        $destination = $this->uploadsPath.'/event_pictures';
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();
        $uploadedFile->move(
            $destination,
            $newFilename
        );

        return $newFilename;
    }

    public function uploadUserAvatar(UploadedFile $uploadedFile): string
    {
        $destination = $this->uploadsPath.'/user_avatars';
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();
        $uploadedFile->move(
            $destination,
            $newFilename
        );

        return $newFilename;
    }

}