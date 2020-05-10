<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->bigInteger('category_id')->unsigned()->index();
            $table->string('title');
            $table->text('body');
            $table->string('image')->nullable();
            $table->timestamps();

            
        });

        // Schema::table('posts', function($table) {
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        // });
        
        // Schema::table('posts', function($table) {
        //     $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('posts');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}