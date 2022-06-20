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
        Schema::create('log_logbooks', function (Blueprint $table) {
            $table->id();
            $table->string('progress');
            $table->dateTime('tgl_logbook')->nullable();
            $table->mediumText('uraian');
            $table->mediumText('hasil');
            $table->mediumText('kendala');
            $table->foreignId('kegiatan_id');
            $table->foreignId('ukm_id');
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
        Schema::dropIfExists('log_logbooks');
    }
};
