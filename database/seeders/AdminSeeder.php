<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Developer',
            'email' => 'dev@mail.com',
            'password' => Hash::make('dev'),
            'email_verified_at' => Carbon::now(),
            'user_type' => 'ADMIN',
        ]);
    }
}
