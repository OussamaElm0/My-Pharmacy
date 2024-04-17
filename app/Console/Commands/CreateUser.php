<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use PharIo\Manifest\Exception;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user {--s|--superuser} {--p|--password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create users from the command line';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $name = $this->ask("Enter username");
            $email = $this->ask("Enter the user's email");
            $cni = $this->ask("Enter the user's CNI");
            $isSuperuser = $this->option("superuser");
            $password = "mypharmacy@";

            if($isSuperuser){

                if ($this->option("password")) {
                    $password = $this->ask('Enter your costumizable pasword');
                } else {
                    $password .= "superuser";
                }

                User::create([
                    'name' => $name,
                    "email" => $email,
                    "cni" => $cni,
                    "password" => $password,
                    "pharmacy_id" => 1,
                    "role_id" => 6
                ]);
                $this->info("email :" . $email);
                $this->info("password: " . $password);
            } else {
                $role = $this->choice("Role", ['admin','cashier', 'invetory manager']);
                $this->alert($role);
            }
        } catch (Exception $exception) {
            $this->error($exception);
        }
    }
}
