<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            /* foreign user id */
            $table->unsignedBigInteger('user_id')
            ->nullable()
            ->after('id');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('set null');

            
            $table->string('title', 100)->unique();
            $table->string('slug')->unique();
            $table->tinyInteger('n_room');
            $table->tinyInteger('n_bed');
            $table->tinyInteger('n_bathroom');
            $table->smallInteger('mq');
            $table->string('image')->nullable();
            $table->decimal('latitude', 9, 6);
            $table->decimal('longitude', 9, 6);
            

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
        Schema::dropIfExists('apartments');
    }
};