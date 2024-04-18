<?php

namespace App\Console\Commands;

use App\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PharIo\Manifest\Exception;

class CreateRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-role';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create role from command line';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $role = $this->ask('Enter the role');

        try {
            Role::create([
                'name' => $role,
            ]);
            $this->alert('Role was created successfully');
        } catch (Exception $exception) {
            Log::error($exception);
        }
    }
}
