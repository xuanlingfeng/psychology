<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) { // 人员回答表
            $table->increments('id');
            $table->integer('personnel_id')->unsigned()->comment('人员id');
            $table->integer('subject_id')->unsigned()->comment('题目id');
            $table->integer('option_id')->unsigned()->comment('选项id');
            $table->integer('fraction')->unsigned()->comment('分值');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('personnels', function (Blueprint $table) { // 人员表
            $table->increments('id');
            $table->string('name', 10)->comment('姓名');
            $table->string('phone', 20)->comment('手机号');
            $table->string('post', 50)->comment('应聘岗位');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('subjects', function (Blueprint $table) { // 题目表
            $table->increments('id');
            $table->string('subject', 255)->comment('题目说明');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('options', function (Blueprint $table) { // 选项表
            $table->increments('id');
            $table->integer('subject_id')->unsigned()->comment('题目id');
            $table->string('option', 255)->comment('选项说明');
            $table->integer('fraction')->comment('分数');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('scores', function (Blueprint $table) { // 得分表
            $table->increments('id');
            $table->integer('personnel_id')->unsigned()->comment('人员id');
            $table->integer('score')->unsigned()->comment('得分');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
        Schema::dropIfExists('personnels');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('options');
        Schema::dropIfExists('scores');
    }
}
