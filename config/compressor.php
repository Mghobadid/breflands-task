<?php

return [
    'strategy' => env('COMPRESS_TYPE', 'zip'),
    'strategies' => [
        'zip' => \App\Compression\ZipCompression::class,
        '7zip' => \App\Compression\Zip7Compression::class,
        'tar' => \App\Compression\TarGzCompression::class
    ]
];
