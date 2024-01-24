<?php

namespace App\Compression;

use App\Compression\Interface\CompressionStrategy;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;

class Zip7Compression implements CompressionStrategy
{

    public function compress($file, string $output): bool
    {
        $uniq = time();
        $tarGzFileName = "$output/compressed_files_$uniq.tar.gz";
        $command = "7z a $tarGzFileName " . $file;
        // Execute shell command
        exec($command, $output, $returnCode);
        $result = Process::run($command);
        // Remove temporary files
        File::delete($file);
        if ($result->failed())
        {
            report(new \Exception("Shell execution failed with code: $returnCode"));
            Log::error("Shell execution failed with  {$result->errorOutput()}");
            return false;
        }
        return true;
    }
}
