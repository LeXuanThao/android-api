<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SSD extends Model {
    protected $table = 'ssds';
    public $timestamps = false;
    protected $guarded = [];
    protected $primaryKey = 'ssd_id';
}
