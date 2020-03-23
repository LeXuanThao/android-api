<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CPU extends Model {
    protected $table = 'cpus';
    public $timestamps = false;
    protected $guarded = [];
    protected $primaryKey = 'cpu_id';

    public function memory_types() {
        return $this->hasManyThrough(MemoryType::class, CPUSupportMemoryType::class, 'cpu_id', 'memory_type_id', 'cpu_id', 'memory_type_id');
    }
}

