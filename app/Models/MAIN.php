<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MAIN extends Model
{
    protected $table='mains';
    public $timestamps = false;
    protected $guarded = [];
    protected $primaryKey = "main_id";

    public function memory_type() {
        return $this->hasOne("memory_type","memory_type_id", "memory_type_id");
    }
}
