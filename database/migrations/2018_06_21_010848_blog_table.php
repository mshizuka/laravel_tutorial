<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('posts', function (Blueprint $table){
        $table->increments('id');
        $table->integer('user_id') ->unsigned();
    	$table->string('title');
    	$table->text('content');
        $table->timestamps();


        $table->foreign('user_id')  //外部キー制約の追加
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
    });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIFExists('posts');
    }
}

