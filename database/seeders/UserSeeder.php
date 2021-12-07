<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_account =
            [
                'name' => "Admin GVB Book",
                'email' => "gvb@gmail.com",
                'coin' => 99999999,
                'role' => 0,
                'password' => Hash::make("administrator"),
            ];
        User::create($admin_account);
    }
}
