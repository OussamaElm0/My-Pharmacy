<?php

namespace App\Console\Commands;

use App\Models\Pharmacy;
use Illuminate\Console\Command;
use PharIo\Version\Exception;

class CreatePharmacy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-pharmacy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create pharmacy from command line';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $inpe = $this->ask("Pharmacy's INPE");
            Pharmacy::create([
                'inpe' => $inpe
            ]);
            $this->alert('Pharmacy was created successfully');
        } catch (Exception $exception) {
            $this->info($exception);
        }
    }
}
