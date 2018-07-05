<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id') ->unsigned() ->nullable(); //usersテーブルとの紐付け
            $table->integer('post_id') ->unsigned(); //postsテーブルとの紐付け
            $table->string('name');
            $table->text('comment');
            $table->timestamps();

            $table->foreign('user_id')  //外部キー制約の追加
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('post_id')  //外部キー制約の追加
                ->references('id')
                ->on('posts')
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
        Schema::dropIfExists('comments');
    }
}
