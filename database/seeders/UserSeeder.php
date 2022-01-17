<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
        [
            'name' => "Admin",
            'sector_id' => 1,
            'role_id' => 1,
            'email' => "admin@cerr.uz",
            'password' => Hash::make('password')
        ],
        [
            'name' => "Н.К.Ортиков",
            'email' => "ortiqov@cerr.uz",
            'sector_id' => 2,
            'role_id' => 2,
            'password' => Hash::make('password')
        ],
        [
            'name' => "Х.С.Асадов",
            'sector_id' => 3,
            'role_id' => 2,
            'email' => "asadov@cerr.uz",
            'password' => Hash::make('password')
        ],
        [
            'name' => "Ф.Д.Давлетов",
            'sector_id' => 4,
            'role_id' => 2,
            'email' => "f.davletov@cerr.uz",
            'password' => Hash::make('password')
        ],
        [
            'name' => "Б.Б.Хамидов",
            'sector_id' => 5,
            'role_id' => 2,
            'email' => "b.khamidov@cerr.uz",
            'password' => Hash::make('password')
        ],
        [
            'name' => "Х.С.Хамидов",
            'sector_id' => 6,
            'role_id' => 2,
            'email' => "k.khamidov@cerr.uz",
            'password' => Hash::make('password')
        ],
        [
            'name' => "М.М.Холмухамедов",
            'sector_id' => 7,
            'role_id' => 2,
            'email' => "m.kholmukhamedov@cerr.uz",
            'password' => Hash::make('password')
        ],
        [
            'name' => "З.А.Ризаева",
            'sector_id' => 8,
            'role_id' => 2,
            'email' => "z.rizaeva@cerr.uz",
            'password' => Hash::make('password')
        ],
        [
            'name' => "Х.З.Мажидов",
            'sector_id' => 3,
            'role_id' => 3,
            'email' => "majidov@cerr.uz",
            'password' => Hash::make('password')
        ],
        [
            'name' => "О.О.Одилов",
            'sector_id' => 3,
            'role_id' => 3,
            'email' => "odilov@cerr.uz",
            'password' => Hash::make('password')
        ],
        [
            'name' => "Ю.Ш.Кутбитдинов",
            'sector_id' => 2,
            'role_id' => 3,
            'email' => "qutbitdinov@cerr.uz",
            'password' => Hash::make('password')
        ]
        ]);
    }
}
