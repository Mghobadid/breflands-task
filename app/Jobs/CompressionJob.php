<?php

namespace App\Jobs;

use App\Compression\Interface\CompressionStrategy;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CompressionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected $file,protected string $output ,protected CompressionStrategy $strategy)
    {
    }

    public function handle(): void
    {
        $this->strategy->compress($this->file,$this->output);
    }
}
