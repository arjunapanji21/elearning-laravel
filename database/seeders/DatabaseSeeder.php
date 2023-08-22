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
            'username' => 'superadmin',
            'password' => bcrypt('rahasia'),
        ])->id;
        Profile::create([
            'user_id' => $id,
            'role' => 'Super Admin',
        ]);
        $id = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin'),
        ])->id;
        Profile::create([
            'user_id' => $id,
            'role' => 'Admin',
        ]);
        $id = User::create([
            'name' => 'Lisnawati',
            'username' => 'lisnawati',
            'password' => bcrypt('lisnawati'),
        ])->id;
        Profile::create([
            'user_id' => $id,
            'role' => 'Guru',
        ]);
        $id = User::create([
            'name' => 'Ajeng Pratiwi Chasi',
            'username' => '11205',
            'password' => bcrypt('ajeng'),
        ])->id;
        Profile::create([
            'user_id' => $id,
            'role' => 'Siswa',
        ]);
        $id = User::create([
            'name' => 'Amelia Putri Assifa',
            'username' => '11206',
            'password' => bcrypt('amelia'),
        ])->id;
        Profile::create([
            'user_id' => $id,
            'role' => 'Siswa',
        ]);
        $id = User::create([
            'name' => 'Anisa',
            'username' => '11207',
            'password' => bcrypt('anisa'),
        ])->id;
        Profile::create([
            'user_id' => $id,
            'role' => 'Siswa',
        ]);
        $id = User::create([
            'name' => 'Astri Afriani',
            'username' => '11208',
            'password' => bcrypt('astri'),
        ])->id;
        Profile::create([
            'user_id' => $id,
            'role' => 'Siswa',
        ]);
        $id = User::create([
            'name' => 'Aura Sintia Sari',
            'username' => '11209',
            'password' => bcrypt('aura'),
        ])->id;
        Profile::create([
            'user_id' => $id,
            'role' => 'Siswa',
        ]);
    }
}
