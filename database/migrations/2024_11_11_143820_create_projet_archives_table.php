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
        Schema::create('projet_archives', function (Blueprint $table) {
            $table->id();
            $table->String('nom');
            $table->text('description');
            $table->Date('date_debut');
            $table->Date('date_fin');
            $table->String('statute');
            $table->String('pdf');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projet_archives');
    }
};
