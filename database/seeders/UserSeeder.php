<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Operator 1',
            'email' => 'operator@yadupa.org',
            'password' => 'operator@yadupa.org',
            'role' => 'operator',
        ]);

        User::create([
            'name' => 'Staf Operator',
            'email' => 'staf@yadupa.org',
            'password' => 'staf@yadupa.org',
            'role' => 'operator',
        ]);

    }
}
