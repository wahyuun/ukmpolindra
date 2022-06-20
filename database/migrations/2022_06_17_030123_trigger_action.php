<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TriggerAction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // INSERT INTO log_logbooks;
        DB::unprepared('
            CREATE TRIGGER after_delete_logbook
                AFTER DELETE ON `logbooks`
                FOR EACH ROW
            BEGIN
            INSERT INTO log_logbooks
                SET progress=OLD.progress,
                tgl_logbook=OLD.tgl_logbook,
                uraian=OLD.uraian,
                hasil=OLD.hasil,
                kendala=OLD.kendala,
                kegiatan_id=OLD.kegiatan_id,
                ukm_id=OLD.ukm_id,
                created_at=now(),
                updated_at=now();
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER "after_delete_logbook"');
    }
};
