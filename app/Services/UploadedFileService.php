<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Filesystem\FilesystemAdapter;

class UploadedFileService
{
    private FilesystemAdapter $filesystem;

    //protected string $formField = 'file';

    //protected string $subfolder = DIRECTORY_SEPARATOR;

    public function __construct(FilesystemAdapter $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function uploadFile(Request $request, string $subpath = DIRECTORY_SEPARATOR, string $formField = 'file'): ?string
    {
        return ($request->hasFile($formField))
            ? $this->filesystem->putFile($subpath, $request->file($formField))
            : null;
    }

    public function removeFile(?string $relativeFilePath = null)
    {
        $this->filesystem->delete($relativeFilePath);
    }
}