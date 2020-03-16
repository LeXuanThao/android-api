<?php
namespace App\Http\Controllers;

use App\Models\CPU;
use Illuminate\Http\Request;

class CPUController extends Controller
{
    public function getCPUs(Request $request) {
        $filter = $request->all();
        $cpus = [];
        if (count($filter) > 0 ) {
            $type = $filter['type'];
            $ver = $filter['ver'];
            $cpus = CPU::where('type', $type)->where('ver', '>', $ver)->get();
        } else {
            $cpus = CPU::all();
        }
        return $cpus;
    }
}
