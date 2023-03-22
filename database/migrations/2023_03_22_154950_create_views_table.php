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
        Schema::create('views', function (Blueprint $table) {
            $table->id();

            /* foreign key apartment id */
            $table->unsignedBigInteger('apartment_id')
            ->nullable()
            ->after('id');
            $table->foreign('apartment_id')
            ->references('id')
            ->on('apartments')
            ->onDelete('set null');

            $table->ipAddress('ip_address');

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
        Schema::dropIfExists('views');
    }
};