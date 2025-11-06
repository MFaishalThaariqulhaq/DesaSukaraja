<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class OptimizeBanners extends Command
{
  protected $signature = 'banners:optimize {--source=storage/app/public/banners/raw} {--dest=storage/app/public/banners/optimized} {--width=1200} {--quality=80}';
  protected $description = 'Optimize banner images (resize + convert to webp) into public storage folder.';

  public function handle()
  {
    $source = base_path($this->option('source'));
    $dest = base_path($this->option('dest'));
    $width = (int) $this->option('width');
    $quality = (int) $this->option('quality');

    $fs = new Filesystem();

    if (! $fs->exists($source)) {
      $this->error("Source folder not found: $source\nCreate it and put banner images there (jpg/png). Example: php artisan storage:link then put files in storage/app/public/banners/raw");
      return 1;
    }

    if (! $fs->exists($dest)) {
      $fs->makeDirectory($dest, 0755, true);
    }

    $files = $fs->files($source);
    if (empty($files)) {
      $this->info('No images found in source.');
      return 0;
    }

    foreach ($files as $file) {
      $path = (string) $file;
      $filename = pathinfo($path, PATHINFO_FILENAME);
      $this->info("Processing: $path");

      $data = @file_get_contents($path);
      if ($data === false) {
        $this->error("Failed to read $path");
        continue;
      }

      $img = @imagecreatefromstring($data);
      if (! $img) {
        $this->error("Unsupported image type: $path");
        continue;
      }

      $origW = imagesx($img);
      $origH = imagesy($img);

      if ($origW > $width) {
        $ratio = $width / $origW;
        $newW = (int) round($origW * $ratio);
        $newH = (int) round($origH * $ratio);
      } else {
        $newW = $origW;
        $newH = $origH;
      }

      $resized = imagecreatetruecolor($newW, $newH);
      // preserve transparency for PNG
      imagealphablending($resized, false);
      imagesavealpha($resized, true);
      imagecopyresampled($resized, $img, 0, 0, 0, 0, $newW, $newH, $origW, $origH);

      // Save webp
      $outWebp = $dest . DIRECTORY_SEPARATOR . $filename . '.webp';
      if (function_exists('imagewebp')) {
        $saved = imagewebp($resized, $outWebp, $quality);
        if ($saved) $this->info("Saved: $outWebp");
        else $this->error("Failed to save webp: $outWebp");
      } else {
        $this->warn('imagewebp not available in this PHP build. Skipping webp.');
      }

      // Save jpeg fallback
      $outJpeg = $dest . DIRECTORY_SEPARATOR . $filename . '.jpg';
      $savedJ = imagejpeg($resized, $outJpeg, $quality);
      if ($savedJ) $this->info("Saved: $outJpeg");
      else $this->error("Failed to save jpeg: $outJpeg");

      imagedestroy($img);
      imagedestroy($resized);
    }

    $this->info('Done.');
    return 0;
  }
}
