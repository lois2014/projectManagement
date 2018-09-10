<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::delete('delete from categories');
        //垃圾发电项目 污泥处置项目 危险废弃物项目 医疗废弃项目 填埋场项目
        Category::insert([
        	['id' => 1, 'title' => '垃圾发电项目', 'parent_id' => 0, 'order' => 9999, 'created_at' => date('Y-m-d H:i:s')],
        	['id' => 2, 'title' => '污泥处置项目', 'parent_id' => 0, 'order' => 9999,'created_at' => date('Y-m-d H:i:s')],
        	['id' => 3, 'title' => '危险废弃物项目', 'parent_id' => 0, 'order' => 9999, 'created_at' => date('Y-m-d H:i:s')],
        	['id' => 4, 'title' => '医疗废弃项目', 'parent_id' => 0, 'order' => 9999, 'created_at' => date('Y-m-d H:i:s')],
        	['id' => 5, 'title' => '填埋场项目', 'parent_id' => 0, 'order' => 9999, 'created_at' => date('Y-m-d H:i:s')],

        ]);
    }
}
