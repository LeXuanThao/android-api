<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PSU extends Model {
    protected $table = 'psus';
    public $timestamps = false;
    protected $guarded = [];
    protected $primaryKey = 'psu_id';
}
