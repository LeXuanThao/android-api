<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecommendPC extends Model {
    protected $table = 'recommend_pc';
    public $timestamps = false;
    protected $guarded = [];
    protected $primaryKey = 'pc_id';
}
