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
        Schema::create('occasions', function (Blueprint $table) {
            $table->id();
            $table->string('name',225);
            $table->date('from_date');
            $table->date('to_date');
            $table->integer('days_counter');
            $table->tinyInteger('active')->default(1);
            $table->foreignId('added_by')->references('id')->on('admins')->onUpdate('cascade');
            $table-> foreignId('updated_by')->nullable()->references('id')->on('admins')->onUpdate('cascade');
            $table->integer('com_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('occasions');
    }
};
