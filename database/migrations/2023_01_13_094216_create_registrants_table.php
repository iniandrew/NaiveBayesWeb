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
        Schema::create('registrants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->enum('school', ['SMK', 'SMA', 'MA']);
            $table->string('major');
            $table->unsignedFloat('mean_smt_4');
            $table->unsignedFloat('mean_smt_5');
            $table->enum('status', ['graduated', 'not_graduated']);
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
        Schema::dropIfExists('registrants');
    }
};
