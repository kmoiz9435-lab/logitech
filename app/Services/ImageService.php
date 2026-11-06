<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

class ImageService
{
    /**
     * Store a photo as an optimized JPEG on the public uploads disk.
     */
    public function storePhoto(UploadedFile $file, string $folder, int $maxWidth = 1800, int $maxHeight = 1800): string
    {
        $folder = trim($folder, '/');
        $extension = strtolower($file->getClientOriginalExtension());
        $filename = Str::random(24).'.jpg';
        $relative = $folder.'/'.$filename;

        if ($this->canProcess($file)) {
            $image = @imagecreatefromstring(file_get_contents($file->getRealPath()));

            if ($image !== false) {
                $image = $this->orient($image, $file);
                $width = imagesx($image);
                $height = imagesy($image);
                $scale = min(1, $maxWidth / $width, $maxHeight / $height);
                $newWidth = max(1, (int) round($width * $scale));
                $newHeight = max(1, (int) round($height * $scale));

                $canvas = imagecreatetruecolor($newWidth, $newHeight);
                imagefill($canvas, 0, 0, imagecolorallocate($canvas, 16, 29, 45));
                imagecopyresampled($canvas, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                Storage::disk('uploads')->makeDirectory($folder);
                $target = Storage::disk('uploads')->path($relative);
                imagejpeg($canvas, $target, 84);

                imagedestroy($canvas);
                imagedestroy($image);

                return $relative;
            }
        }

        $path = Storage::disk('uploads')->putFileAs($folder, $file, $filename);

        if (! $path) {
            throw new RuntimeException('The image could not be stored.');
        }

        return $path;
    }

    /**
     * Store a brand asset (logo / favicon), preserving transparency where possible.
     */
    public function storeBrandImage(UploadedFile $file, string $folder, int $maxWidth = 800): string
    {
        $folder = trim($folder, '/');
        $extension = strtolower($file->getClientOriginalExtension());
        $extension = in_array($extension, ['png', 'webp', 'jpg', 'jpeg'], true) ? $extension : 'png';
        $filename = Str::random(24).'.'.$extension;
        $relative = $folder.'/'.$filename;

        if ($this->canProcess($file) && in_array($extension, ['png', 'webp', 'jpg', 'jpeg'], true)) {
            $image = @imagecreatefromstring(file_get_contents($file->getRealPath()));

            if ($image !== false) {
                $image = $this->orient($image, $file);
                $width = imagesx($image);
                $height = imagesy($image);
                $scale = min(1, $maxWidth / $width);
                $newWidth = max(1, (int) round($width * $scale));
                $newHeight = max(1, (int) round($height * $scale));

                $canvas = imagecreatetruecolor($newWidth, $newHeight);

                if (in_array($extension, ['png', 'webp'], true)) {
                    imagealphablending($canvas, false);
                    imagesavealpha($canvas, true);
                    imagefill($canvas, 0, 0, imagecolorallocatealpha($canvas, 0, 0, 0, 127));
                }

                imagecopyresampled($canvas, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                Storage::disk('uploads')->makeDirectory($folder);
                $target = Storage::disk('uploads')->path($relative);

                match ($extension) {
                    'png' => imagepng($canvas, $target, 8),
                    'webp' => imagewebp($canvas, $target, 88),
                    default => imagejpeg($canvas, $target, 88),
                };

                imagedestroy($canvas);
                imagedestroy($image);

                return $relative;
            }
        }

        $path = Storage::disk('uploads')->putFileAs($folder, $file, $filename);

        if (! $path) {
            throw new RuntimeException('The image could not be stored.');
        }

        return $path;
    }

    /**
     * Remove an upload only when no other database record references it.
     */
    public function deleteIfUnused(?string $path): void
    {
        if (blank($path)) {
            return;
        }

        $path = ltrim($path, '/');

        if (Str::startsWith($path, ['http://', 'https://', 'assets/'])) {
            return;
        }

        if ($this->isReferenced($path)) {
            return;
        }

        if (Storage::disk('uploads')->exists($path)) {
            Storage::disk('uploads')->delete($path);
        }
    }

    protected function isReferenced(string $path): bool
    {
        $checks = [
            ['products', 'main_image'],
            ['product_images', 'image'],
            ['product_categories', 'image'],
            ['industries', 'image'],
            ['gallery_images', 'image'],
            ['website_sections', 'image'],
        ];

        foreach ($checks as [$table, $column]) {
            if (DB::table($table)->where($column, $path)->exists()) {
                return true;
            }
        }

        return DB::table('website_settings')
            ->whereIn('key', ['logo', 'favicon'])
            ->where('value', $path)
            ->exists();
    }

    protected function canProcess(UploadedFile $file): bool
    {
        return function_exists('imagecreatefromstring')
            && in_array(strtolower($file->getClientOriginalExtension()), ['jpg', 'jpeg', 'png', 'webp'], true);
    }

    protected function orient(\GdImage $image, UploadedFile $file): \GdImage
    {
        if (! function_exists('exif_read_data')) {
            return $image;
        }

        $exif = @exif_read_data($file->getRealPath());
        $orientation = $exif['Orientation'] ?? null;

        if ($orientation === 3) {
            $rotated = imagerotate($image, 180, 0);
        } elseif ($orientation === 6) {
            $rotated = imagerotate($image, -90, 0);
        } elseif ($orientation === 8) {
            $rotated = imagerotate($image, 90, 0);
        } else {
            return $image;
        }

        if ($rotated !== false) {
            imagedestroy($image);

            return $rotated;
        }

        return $image;
    }
}
