<?php

namespace App\Http\Controllers;

use App\Models\HDD;
use Illuminate\Http\Request;

class HDDController extends Controller
{
    public function getHDDs(Request $request)
    {
        $filter = $request->all();
        $hdd_id = $filter['hdd_id'] ?? NULL;
        if ($hdd_id)
        {
            $hdd = HDD::where('hdd_id', $hdd_id)->get();
        }
        else
        {
            $hdd = HDD::all();
        }
        return $this->makeResponse(true, $hdd);
    }

    protected function makeResponse($success = false, $data = array())
    {
        return array(
            'success' => $success,
            'data' => $data
        );
    }
}
