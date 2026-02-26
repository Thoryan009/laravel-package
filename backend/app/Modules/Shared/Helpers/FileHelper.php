<?php

namespace App\Modules\Shared\Helpers;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileHelper
{
    /**
     * Store image/pdf file in storage/app/public
     *
     * @param UploadedFile $file
     * @param string $directory
     * @return string|null
     */
    public static function store(UploadedFile $file, string $directory): ?string
    {
        return $file->store($directory, 'public');
    }

    /**
     * Delete file from storage/app/public
     *
     * @param string|null $path
     * @return void
     */
    public static function delete(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
