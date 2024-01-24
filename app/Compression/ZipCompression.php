<?php

namespace App\Compression;

use App\Compression\Interface\CompressionStrategy;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use ZipArchive;

class ZipCompression implements CompressionStrategy
{
    public function compress($file, string $output): bool
    {
        $uniq = time();
        $zipFilePath = "$output/compressed_files_$uniq.zip";
        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true)
        {
            $zip->addFile($file, pathinfo($file, PATHINFO_BASENAME));
            $zip->close();
            // Remove temporary files
            File::delete($file);
            return true;
        }
        else
        {
            Log::error("Failed to create zip file.");
            // Remove temporary files
            File::delete($file);
            return false;
        }

    }
}
