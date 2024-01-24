<?php

namespace App\Compression\Interface;

interface CompressionStrategy
{
    public function compress($file,string $output):bool;
}
