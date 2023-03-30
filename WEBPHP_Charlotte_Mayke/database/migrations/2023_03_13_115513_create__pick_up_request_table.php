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
        Schema::create('pick_up_requests', function (Blueprint $table) {
            $table->id();
            $table->date('start');
            $table->date('end');
            $table->time('time');
            $table->text('title');
            $table->string('postcode');
            $table->string('huisnummer');
            $table->timestamps();
            $table->string('webshop');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pick_up_requests');
    }
};
