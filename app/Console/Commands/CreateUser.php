<?php

namespace App\Console\Commands;

use App\Models\Pharmacy;
use App\Models\Role;
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
                $pharmacyId = 1;
                $roleId = 6;

            } else {
                $roles = Role::where('id',"!=",6)
                        ->pluck("name",'id')
                        ->toArray();
                $roleName = $this->choice("Roles",$roles);
                $roleId = array_search($roleName, $roles);

                $pharmacies = Pharmacy::where('id',"!=", 1)
                            ->pluck('inpe','id')
                            ->toArray();
                $pharmacy = $this->choice('Pharmacy',$pharmacies);
                $pharmacyId = array_search($pharmacy,$pharmacies);

                if ($this->option("password")) {
                    $password = $this->ask('Enter your costumizable pasword');
                } else {
                    $password .= $roleName;
                }
            }

            User::create([
                'name' => $name,
                "email" => $email,
                "cni" => $cni,
                "password" => $password,
                "pharmacy_id" => $pharmacyId,
                "role_id" => $roleId
            ]);
            $this->alert("email : $email");
            $this->alert("password: $password");
        } catch (Exception $exception) {
            $this->error($exception);
        }
    }
}
