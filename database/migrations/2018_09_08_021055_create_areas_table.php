<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('areas', function (Blueprint $table) {
            $table->primary('id');
            $table->integer('code')->comment("行政代码");
            $table->string("name", 20)->comment("地区名称");
            $table->enum("level", ['1','2','3'])->default('1')->comment("地区级别 1-省 2-直辖市 3-地级市");
            $table->unique('code');
            $table->index('level');
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
        Schema::dropIfExists('areas');
    }
}
