<?php
namespace App\Http\Controllers;

use App\Models\CASES;
use App\Models\CPU;
use App\Models\HDD;
use App\Models\MAIN;
use App\Models\RAM;
use App\Models\SSD;
use App\Models\VGA;
use App\Models\PSU;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuilderController extends Controller
{
    public function getCPUs(Request $request) {
        $filter = $request->all();
        $query = CPU::query()->with(['memory_types']);
        $ram_id = $filter['ram_id'] ?? NULL;
        $main_id = $filter['main_id'] ?? NULL;
        $cpu_id = $filter['cpu_id'] ?? NULL;
        if ($cpu_id) {
            $query->where('cpu_id', $cpu_id);
        }
        else{
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
        }
        $cpu = $query->get();
        return $this->makeResponse(true, $cpu);
    }

    public function getMAINs(Request $request)
    {
        $filter = $request->all();
        $cpu_id = $filter['cpu_id'] ?? NULL;
        $ram_id = $filter['ram_id'] ?? NULL;
        $main_id = $filter['main_id'] ?? NULL;
        $query = MAIN::query();
        if ($main_id)
        {
            $query->where('main_id', $main_id);
        }
        else{
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
        }
        $main = $query->get();
        return $this->makeResponse(true, $main);
    }

    public function getRAMs(Request $request)
    {
        $filter = $request->all();
        $cpu_id = $filter['cpu_id'] ?? NULL;
        $main_id = $filter['main_id'] ?? NULL;
        $ram_id = $filter['ram_id'] ?? NULL;
        $query = RAM::query();
        if ($ram_id)
        {
            $query->where('ram_id', $ram_id);
        }
        else{
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
        }
        $ram = $query->get();
        return $this->makeResponse(true, $ram);
    }

    public function getVGAs(Request $request)
    {
        $filter = $request->all();
        $psu_id = $filter['psu_id'] ?? NULL;
        $vga_id = $filter['vga_id'] ?? NULL;
        if ($vga_id) {
            $vga = VGA::where('vga_id', $vga_id)->get();
        }
        else{
            if ($psu_id == null)
            {
                $vga = VGA::all();
            }
            else {
                $psu_model = PSU::find($psu_id);
                $vga = VGA::where('min_power', '<=', $psu_model->size)->get();
            }
        }
        return $this->makeResponse(true, $vga);
    }

    public function getPSUs(Request $request)
    {
        $filter = $request->all();
        $vga_id = $filter['vga_id'] ?? NULL;
        $psu_id = $filter['psu_id'] ?? NULL;
        if ($psu_id)
        {
            $psu = PSU::where('psu_id', $psu_id)->get();
        }
        else
        {
            if ($vga_id == null)
            {
                $psu = PSU::all();
            }
            else {
                $vga_model = VGA::find($vga_id);
                $psu = PSU::where('size', '>=', $vga_model->min_power)->get();
            }
        }
        return $this->makeResponse(true, $psu);
    }

    protected function makeResponse($success = false, $data = array()) {
        return array(
            'success' => $success,
            'data' => $data
        );
    }

    public function getCart(Request $request) {
        $filter = $request->all();
        $cpu_id = $filter['cpu_id'] ?? NULL;
        $ram_id = $filter['ram_id'] ?? NULL;
        $main_id = $filter['main_id'] ?? NULL;
        $vga_id = $filter['vga_id'] ?? NULL;
        $psu_id = $filter['psu_id'] ?? NULL;
        $ssd_id = $filter['ssd_id'] ?? NULL;
        $hdd_id = $filter['hdd_id'] ?? NULL;
        $case_id = $filter['case_id'] ?? NULL;

        $response = array(
            'cpu' => null,
            'ram' => null,
            'main' => null,
            'vga' => null,
            'psu' => null,
            'ssd' => null,
            'hdd' => null,
            'case' => null
        );

        if ($cpu_id) {
            $response['cpu'] = CPU::find($cpu_id);
        }

        if ($ram_id) {
            $response['ram'] = RAM::find($ram_id);
        }

        if ($main_id) {
            $response['main'] = MAIN::find($main_id);
        }

        if ($vga_id) {
            $response['vga'] = VGA::find($vga_id);
        }

        if ($psu_id) {
            $response['psu'] = PSU::find($psu_id);
        }

        if ($ssd_id) {
            $response['ssd'] = SSD::find($ssd_id);
        }

        if ($hdd_id) {
            $response['hdd'] = HDD::find($hdd_id);
        }

        if ($case_id) {
            $response['case'] = CASES::find($case_id);
        }
        return $this->makeResponse(true, $response);
    }
}
