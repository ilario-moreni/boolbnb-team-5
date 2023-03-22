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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            
            /* foreign key apartment id */
            $table->unsignedBigInteger('apartment_id')
            ->nullable()
            ->after('id');
            $table->foreign('apartment_id')
            ->references('id')
            ->on('apartments')
            ->onDelete('set null');

            $table->string('name', 30);
            $table->string('surname', 30);
            $table->string('email')->unique();
            $table->text('description');


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
        Schema::dropIfExists('messages');
    }
};