<?php

namespace App\Http\Controllers;

use App\Compression\Interface\CompressionStrategy;
use App\Jobs\CompressionJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CompressorController extends Controller
{
    public function __invoke(Request $request, CompressionStrategy $strategy)
    {
        $request->validate([
            'file' => 'file|required'
        ]);
        // Temporary directory to store the uploaded file
        $tempDir = storage_path('app/temp');
        // Create the temporary directory if it doesn't exist
        if (!File::isDirectory($tempDir))
        {
            File::makeDirectory($tempDir, 0755, true, true);
        }
        // Move uploaded file to the temporary directory
        $file = $request->file('file');
        $uploadedFile = $file->move($tempDir, $file->getClientOriginalName())->getPathname();
        CompressionJob::dispatch($uploadedFile, public_path(), $strategy);
        return response()->json(['message' => "your file successfully add to queue"]);
    }
}
