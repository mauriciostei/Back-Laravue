<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u1 = new User();
        $u1->name = 'admin';
        $u1->email = 'admin@mail.com';
        $u1->password = bcrypt('12345');
        $u1->save();

        $u2 = new User();
        $u2->name = 'juan';
        $u2->email = 'juan@mail.com';
        $u2->password = bcrypt('12345');
        $u2->save();
    }
}
