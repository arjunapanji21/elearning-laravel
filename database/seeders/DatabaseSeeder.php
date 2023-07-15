<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $id = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'username' => 'superadmin',
            'password' => bcrypt('rahasia'),
        ])->id;
        Profile::create([
            'user_id' => $id,
            'role' => 'Super Admin',
        ]);
        $id = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => bcrypt('admin'),
        ])->id;
        Profile::create([
            'user_id' => $id,
            'role' => 'Admin',
        ]);
        $id = User::create([
            'name' => 'Siti Nurbaya',
            'email' => 'siti@gmail.com',
            'username' => 'siti',
            'password' => bcrypt('siti'),
        ])->id;
        Profile::create([
            'user_id' => $id,
            'role' => 'Guru',
        ]);
        $id = User::create([
            'name' => 'Adit',
            'email' => 'adit@gmail.com',
            'username' => 'adit',
            'password' => bcrypt('adit'),
        ])->id;
        Profile::create([
            'user_id' => $id,
            'role' => 'Siswa',
        ]);
    }
}
