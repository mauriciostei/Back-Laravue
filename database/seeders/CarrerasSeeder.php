<?php

namespace Database\Seeders;

use App\Models\Carreras;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarrerasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $c1 = new Carreras();
        $c1->nombre = 'INFORMATICA';
        $c1->save();

        $c2 = new Carreras();
        $c2->nombre = 'MATEMATICA';
        $c2->save();

        $c3 = new Carreras();
        $c3->nombre = 'FISICA';
        $c3->save();
    }
}
