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
        Schema::create('tbl_person', function (Blueprint $table)
        {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable(false);
            $table->integer('phone', 8);
            $table->string('address');
            $table->timestamps('created_at');
        });

        Schema::create('tbl_n_person', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('person_id')->constrained('tbl_person');
            $table->string('p_middle_name')->nullable();
            $table->string('p_last_name');
            $table->string('p_identification', 16)->unique()->nullable(false);
            $table->time('birth_time')->nullable(false);
            $table->char('gender')->nullable(false);
        });

        Schema::create('tbl_lg_person', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('person_id')->constrained('tbl_person');
            $table->string('bussines_name');
            $table->string('lg_identification',16)->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_peron');
        Schema::dropIfExists('tbl_n_person');
        Schema::dropIfExists('tbl_lg_person');
    }
};
