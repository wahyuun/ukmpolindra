<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Logbook extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function kegiatan(){
        return $this->belongsTo(Kegiatan::class,'kegiatan_id'); //1 log book(1 baris dalam database) hanya memiliki 1 kegiatan
    }

    public function ukm(){
        return $this->belongsTo(UKM::class,'ukm_id'); //1 log book(1 baris dalam database) hanya memiliki 1 ukm
    }

    public function getIdAttribute(){
        $hashids = new \Hashids\Hashids( env('MY_SECRET_SALT_KEY','MySecretSalt') );

        return $hashids->encode($this->attributes['id']);
    }
}
