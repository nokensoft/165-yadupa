<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Validation\ValidationException;

class ImageCoverProcessor
{
    /**
     * Crop (tengah) & konversi gambar upload menjadi WebP dengan ukuran seragam.
     */
    public static function toWebp(UploadedFile $file, int $width, int $height, string $directory, string $errorField = 'gambar_file'): string
    {
        $source = match ($file->getMimeType()) {
            'image/jpeg', 'image/jpg' => @imagecreatefromjpeg($file->getRealPath()),
            'image/png' => @imagecreatefrompng($file->getRealPath()),
            'image/webp' => @imagecreatefromwebp($file->getRealPath()),
            'image/gif' => @imagecreatefromgif($file->getRealPath()),
            default => false,
        };

        if (!$source) {
            throw ValidationException::withMessages([
                $errorField => 'Format gambar tidak didukung. Gunakan JPG, PNG, GIF, atau WebP.',
            ]);
        }

        $srcWidth = imagesx($source);
        $srcHeight = imagesy($source);
        $targetRatio = $width / $height;

        if (($srcWidth / $srcHeight) > $targetRatio) {
            $cropHeight = $srcHeight;
            $cropWidth = (int) round($srcHeight * $targetRatio);
        } else {
            $cropWidth = $srcWidth;
            $cropHeight = (int) round($srcWidth / $targetRatio);
        }
        $cropX = (int) round(($srcWidth - $cropWidth) / 2);
        $cropY = (int) round(($srcHeight - $cropHeight) / 2);

        $canvas = imagecreatetruecolor($width, $height);
        imagecopyresampled($canvas, $source, 0, 0, $cropX, $cropY, $width, $height, $cropWidth, $cropHeight);
        imagedestroy($source);

        $path = trim($directory, '/') . '/' . uniqid('img_', true) . '.webp';
        $fullPath = storage_path('app/public/' . $path);
        if (!is_dir(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0755, true);
        }

        imagewebp($canvas, $fullPath, 82);
        imagedestroy($canvas);

        return $path;
    }
}
