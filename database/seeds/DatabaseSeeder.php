<?php

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
        // $this->call(AreasSeeder::class);//地区数据
        // $this->call(CategorySeeder::class); //分类初始数据
        $this->call(AdminSeeder::class);//管理后台数据
    }
}
