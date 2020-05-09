<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('file');
            $table->timestamps();
            // $table->foreign('id')->references('photo_id')->on('users')->onDelete('cascade');
            // $table->foreign('id')->references('photo_id')->on('posts')->onDelete('cascade');

        });

        // Schema::table('photos', function($table) {
        //     $table->foreign('id')->references('photo_id')->on('users')>onDelete('cascade');
        //     // $table->foreign('id')->references('photo_id')->on('posts')->onDelete('cascade');
        // });

        // DB::statement(
        //     "ALTER TABLE photos ADD FOREIGN KEY (id) REFERENCES users(photo_id)"
        // );
        // DB::statement(
        //     "ALTER TABLE photos ADD FOREIGN KEY (id) REFERENCES posts(photo_id)"
        // );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('photos');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
