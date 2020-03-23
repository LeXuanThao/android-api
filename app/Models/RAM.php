<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RAM extends Model {
    protected $table = 'rams';
    public $timestamps = false;
    protected $guarded = [];
    protected $primaryKey = 'ram_id';
}

