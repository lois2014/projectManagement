<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('项目名称');
            $table->integer('area_code')->comment('地区代码');
            $table->integer('category_id')->comment('分类id');
            $table->decimal('population', 8,2)->default(0.00)->comment('常住人口（万）');
            $table->text('investor')->nullable()->comment('投资商');
            $table->text('size')->nullable()->comment('规模');
            $table->text('address')->nullable()->comment('地址');
            $table->text('schedule')->nullable()->comment('进度');
            $table->tinyInteger('status')->default(0)->comment('0-未建 1-待建 2-已建 -1-废弃');
            $table->tinyInteger('release')->defalut(0)->comment('发布 1-发布 0-不发布');
            $table->index('category_id');
            $table->index('area_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
