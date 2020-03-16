<?php
namespace App\Http\Controllers;

use App\Models\CPU;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BuilderController extends Controller
{
    public function buildPC(Request $request) {
        $cpu = $request->get("cpu");
        $ram = $request->get("ram");
        $main = $request->get("main");
        $notify = $this->checkPC($cpu, $ram, $main);
        return [
            'success' => $notify === "Success",
            'message' => $notify
        ];
    }

    public function suggestWithMain(Request $request) {

    }

    public function suggestion(Request $request) {
        $has = $request->get('has');
        $main_id = $has['main'] ?? NULL;
        $ram_id = $has['ram'] ?? NULL;
        $card_id = $has['card'] ?? NULL;
        $selected = $request->get("selected");
        if ($selected == "cpu") {
            $list_cpu = $this->suggestCPU($main_id, $ram_id, $card_id);
            $verify = $this->checkPC($main_id, $ram_id, $card_id, $psu);
        }

        return [
            'verify_status' => $verify,
            'suggestion' => $list_cpu
        ];
    }

    public function suggestCPU($main_id, $ram_id) {
        $query = CPU::query();
        if ($main_id) {
            $main_model = Main::find($main_id);
            $query->where("socket", $main_model->socket);
        }
        if ($ram_id) {
            $ram_model = Ram::find($ram_id);
            $query->where("ram_support", $ram_model->version); //DDR4
        }
        return $query->get();
    }


    public function checkPC($main_id, $ram_id, $card_id, $psu = null) {
        $estimated_power = $this->calcPower($main_id, $ram_id, $card_id); //<= -1, 500W;
        if ($estimated_power == -1) return true;
        if (isset($psu) && $estimated_power < $psu_power) {
            return false;
        }
    }
}
