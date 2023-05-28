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
        Schema::create('finance_cln_periods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('finance_calenders_id');
            $table->foreign('finance_calenders_id')->references('id')->on('finance_calenders')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('number_of_days');
            $table->string('year_and_month',10);
            $table->integer('FINANCE_YR');
            $table->integer('MONTH_ID');
            $table->date('START_DATE_M');
            $table->date('END_DATE_M');
            $table->tinyInteger('is_open')->default(0);
            $table->date('start_date_for_pasma');
            $table->date('end_date_for_pasma');
            $table->integer('added_by');
            $table->integer('updated');
            $table->integer('com_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_cln_periods');
    }
};
