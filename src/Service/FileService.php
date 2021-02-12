<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Controller\VideoFile;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use ViachViach\CustomValidationBundle\Service\ValidationServiceInterface;

class FileService
{
    public function __construct(
        private SluggerInterface $slugger,
        private ParameterBagInterface $params,
        private ExerciseService $exerciseService,
        private ValidationServiceInterface $validateService
    ) { }

    public function uploadExerciseFile(UploadedFile $uploadedFile, int $exerciseId): string
    {
        $fileDto = new VideoFile();
        $fileDto->setUploadFile($uploadedFile);
        $this->validateService->validate($fileDto);

        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename     = $this->slugger->slug($originalFilename);

        $newFilename = $safeFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();

        $uploadedFile->move(
            $this->params->get('upload_videos'),
            $newFilename,
        );

        $filePath = $this->params->get('front_video_file_path').$newFilename;
        $this->exerciseService->attachFile($filePath, $exerciseId);

        return $newFilename;
    }
}
