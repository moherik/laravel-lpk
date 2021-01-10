<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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
        DB::transaction(function () {
            return tap(User::create([
                'name' => 'Developer',
                'email' => 'dev@mail.com',
                'password' => Hash::make('dev'),
                'user_type' => 'ADMIN'
            ]), function (User $user) {
                $this->createTeam($user);
            });
        });
    }
}
