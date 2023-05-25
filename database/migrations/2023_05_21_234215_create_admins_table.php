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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('email',100)->nullable();
            $table->string('username',100);
            $table->string('password',225);
            $table->integer('added_by');
            $table->integer('updated_by');
            $table->tinyInteger('active');
            $table->date('date');
            $table->timestamps();
            $table->integer('com_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
