<?php
namespace App\Http\Controllers;

use App\Models\CPU;
use App\Models\MAIN;
use App\Models\RAM;
use App\Models\VGA;
use App\Models\PSU;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuilderController extends Controller
{
    public function getCPUs(Request $request) {
//        dd(DB::select("SELECT * FROM cpus c LEFT JOIN cpu_support_memory_types csp ON csp.cpu_id = c.cpu_id LEFT JOIN memory_types mt ON mt.memory_type_id = csp.memory_type_id"));
        $filter = $request->all();
        $query = CPU::query()->with(['memory_types']);
        $ram_id = $filter['ram_id'] ?? NULL;
        $main_id = $filter['main_id'] ?? NULL;
        if ($ram_id) {
            $ram_model = RAM::find($ram_id);
            if (!$ram_model) {
                return $this->makeResponse();
            }
            $memory_type_id = $ram_model->memory_type_id ?? NULL;
            if ($memory_type_id) {
                $query->whereHas('memory_types', function ($subQuery) use ($memory_type_id) {
                    $subQuery->where('memory_types.memory_type_id', $memory_type_id);
                });
            }
        }
        if ($main_id) {
            $main_model = MAIN::find($main_id);
            if (!$main_model) {
                return $this->makeResponse();
            }
            $socket = $main_model->socket ?? NULL;
            if ($socket) {
                $query->where('socket', $socket);
            }
        }
        $cpu = $query->get();
        return $this->makeResponse(true, $cpu);
    }

    public function getMAINs(Request $request)
    {
        $filter = $request->all();
        $cpu_id = $filter['cpu_id'];
        $ram_id = $filter['ram_id'];
        $query = MAIN::query();
        if ($cpu_id) {
            $cpu_model = CPU::with(['memory_types'])->find($cpu_id);
            if (!$cpu_model) {
                return $this->makeResponse();
            }
            $supported_memory_types = $cpu_model->memory_types->pluck('memory_type_id') ?? NULL;
            if ($supported_memory_types) {
                $query->whereIn('memory_type_id', $supported_memory_types);
            }
            $socket = $cpu_model->socket ?? NULL;
            if ($socket) {
                $query->where('socket', $socket);
            }
        }
        if ($ram_id) {
            $ram_model = RAM::find($ram_id);
            if (!$ram_model) {
                return $this->makeResponse();
            }
            $ram_memory_type_id = $ram_model->memory_type_id ?? NULL;
            if ($ram_memory_type_id) {
                $query->where('memory_type_id', $ram_memory_type_id);
            }
        }
        $main = $query->get();
        return $this->makeResponse(true, $main);
    }

    public function getRAMs(Request $request)
    {
        $filter = $request->all();
        $cpu_id = $filter['cpu_id'];
        $main_id = $filter['main_id'];
        $query = RAM::query();
        if ($cpu_id){
            $cpu_model = CPU::with(['memory_types'])->find($cpu_id);
            if (!$cpu_model) {
                return $this->makeResponse();
            }
            $supported_memory_types = $cpu_model->memory_types->pluck('memory_type_id') ?? NULL;
            if ($supported_memory_types) {
                $query->whereIn('memory_type_id', $supported_memory_types);
            }
        }
        if ($main_id){
            $main_model = MAIN::find($main_id);
            if (!$main_model) {
                return $this->makeResponse();
            }
            $main_memory_type_id = $main_model->memory_type_id ?? NULL;
            if ($main_memory_type_id){
                $query->where('memory_type_id', $main_memory_type_id);
            }
        }
        $ram = $query->get();
        return $this->makeResponse(true, $ram);
    }

    public function getVGAs(Request $request)
    {
        $vga = VGA::all();
        return $this->makeResponse(true, $vga);
    }

    public function getPSUs(Request $request)
    {
        $filter = $request->all();
        $vga = $filter['vga_id'];
        if ($vga == null)
        {
            $psu = PSU::all();
        }
        else
        {
            $vga_model = VGA::find($vga);
            $psu = PSU::where('size', '>', $vga_model->min_power)->get();
        }
        return $this->makeResponse(true, $psu);
    }

    protected function makeResponse($success = false, $data = array()) {
        return array(
            'success' => $success,
            'data' => $data
        );
    }
}
