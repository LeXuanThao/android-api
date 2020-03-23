<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoryType extends Model
{
    protected $table = 'memory_types';
    public $timestamps = false;
    protected $guarded = [];
    protected $primaryKey = 'memory_type_id';
}
