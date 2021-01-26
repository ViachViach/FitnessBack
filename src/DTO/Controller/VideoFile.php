<?php

declare(strict_types=1);

namespace App\DTO\Controller;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

final class VideoFile
{
    /**
     * @Assert\File(
     *     maxSize = "60m",
     *     mimeTypes = {"video/mp4", "video/vnd.sealedmedia.softseal.mov"},
     *     mimeTypesMessage = "Please upload a valid video file (mp4, mov)"
     * )
     */
    private UploadedFile $uploadFile;

    /**
     * @return UploadedFile
     */
    public function getUploadFile(): UploadedFile
    {
        return $this->uploadFile;
    }

    /**
     * @param UploadedFile $uploadFile
     *
     * @return VideoFile
     */
    public function setUploadFile(UploadedFile $uploadFile): VideoFile
    {
        $this->uploadFile = $uploadFile;
        return $this;
    }
}
