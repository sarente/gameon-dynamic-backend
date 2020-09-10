<?php

namespace App\Database\Seeds\Demo;

use App\Models\User;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=User::pluck('id')->toArray();

        app()->setLocale('tr');
        $category_names=['Değeler','Yetkinlikler','Eğlence'];

        foreach($category_names as $category_name){
            $category = new \App\Models\Category([
                'name'=> $category_name,
            ]);
            $category->save();
            $category->users()->attach($users);
        }
    }
}