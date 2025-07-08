<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CleanupDetectionImages extends Command
{
    protected $signature = 'cleanup:detection-images';
    protected $description = 'Clean up old waste detection images';

    public function handle()
    {
        $path = config('waste-detection.storage.detection_images');
        $days = config('waste-detection.storage.cleanup_after_days', 30);

        $files = Storage::files($path);
        $count = 0;

        foreach ($files as $file) {
            $lastModified = Carbon::createFromTimestamp(Storage::lastModified($file));
            if ($lastModified->addDays($days)->isPast()) {
                Storage::delete($file);
                $count++;
            }
        }

        $this->info("Cleaned up {$count} old detection images");
    }
}
