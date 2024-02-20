<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ClearLog extends Command
{
    protected $signature = 'log:clear';
    protected $description = 'Clear content of the log file';

    public function handle()
    {
        $logFilePath = storage_path('logs/laravel.log');

        if (file_exists($logFilePath)) {
            file_put_contents($logFilePath, '');
            $this->info('Log file content cleared.');
        } else {
            $this->error('Log file not found.');
        }
    }
}
