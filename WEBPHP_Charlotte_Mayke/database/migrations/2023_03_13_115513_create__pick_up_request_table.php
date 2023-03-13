<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pick_up_request', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('streetName');
            $table->string('houseNumber');
            $table->string('postalCode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pick_up_request');
    }
};
