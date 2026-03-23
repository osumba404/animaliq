<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class ImageService
{
    /**
     * Handle an incoming file upload.
     * Converts to WebP if it's an image. Stores conventionally otherwise.
     */
    public static function handleUpload(UploadedFile $file, string $directory): string
    {
        $mimeType = $file->getMimeType();

        if (str_starts_with($mimeType, 'image/')) {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file->getPathname());
            
            $filename = Str::uuid() . '.webp';
            $path = $directory . '/' . $filename;
            
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }
            
            Storage::disk('public')->put($path, $image->toWebp(80)->toString());
            
            return $path;
        }

        return $file->store($directory, 'public');
    }

    /**
     * Permanently delete a file from public storage.
     */
    public static function delete(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
