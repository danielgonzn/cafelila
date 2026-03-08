<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadService
{
    public function store(UploadedFile $file, string $directory = 'uploads', int $quality = 80): string
    {
        $filename = Str::uuid().'.jpg';
        $relativePath = trim($directory, '/').'/'.$filename;

        $imageResource = $this->createImageFromFile($file->getRealPath(), $file->extension());

        if (! $imageResource) {
            return $file->store($directory, 'public');
        }

        $width = imagesx($imageResource);
        $height = imagesy($imageResource);
        $maxWidth = 1600;

        if ($width > $maxWidth) {
            $newHeight = (int) round(($maxWidth / $width) * $height);
            $resized = imagecreatetruecolor($maxWidth, $newHeight);
            imagecopyresampled($resized, $imageResource, 0, 0, 0, 0, $maxWidth, $newHeight, $width, $height);
            imagedestroy($imageResource);
            $imageResource = $resized;
        }

        ob_start();
        imagejpeg($imageResource, null, $quality);
        $binary = (string) ob_get_clean();

        imagedestroy($imageResource);

        Storage::disk('public')->put($relativePath, $binary);

        return $relativePath;
    }

    private function createImageFromFile(string $path, string $extension): mixed
    {
        return match (strtolower($extension)) {
            'jpg', 'jpeg' => function_exists('imagecreatefromjpeg') ? @imagecreatefromjpeg($path) : null,
            'png' => function_exists('imagecreatefrompng') ? @imagecreatefrompng($path) : null,
            'webp' => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($path) : null,
            default => null,
        };
    }

    public function delete(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
