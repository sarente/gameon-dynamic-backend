<?php

namespace App\Database\Seeds\Demo;

use App\Models\Result;
use App\Models\Reward;
use Illuminate\Database\Seeder;

class ResultTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //First of all add permission to db then create roles thus connect the permission to related role
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\Result::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        /////////////////////////////////////
        $reward=Reward::find(1);
        $result = Result::create([
            'name' => 'Değerler',
            'point' => 75,
        ]);
        $result->rewards()->sync($reward);
        unset($reward);
        unset($result);

        /////////////////////////////////////
        $reward=Reward::find(2);
        $result = Result::create([
            'name' => 'Eğitim',
            'point' => 75,
        ]);
        $result->rewards()->sync($reward);

    }
}