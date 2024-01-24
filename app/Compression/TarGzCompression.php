<?php

namespace App\Compression;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;

class TarGzCompression implements Interface\CompressionStrategy
{

    public function compress($file, string $output): bool
    {
        $uniq = time();
        $tarGzFileName = "$output/compressed_files_$uniq.tar.gz";
        $command = "tar -czvf $tarGzFileName " . $file;
        // Execute shell command
        exec($command, $output, $returnCode);
        $result = Process::run($command);
        // Remove temporary files
        File::delete($file);
        if ($result->failed())
        {
            Log::error("Shell execution failed with  {$result->errorOutput()}");
            return false;
        }
        return true;
    }
}
