<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CPUSupportMemoryType extends Pivot
{
    protected $table = 'cpu_support_memory_types';
}
