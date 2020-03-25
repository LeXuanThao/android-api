<?php

namespace App\Http\Controllers;

use App\Models\SSD;
use Illuminate\Http\Request;

class SSDController extends Controller
{
    public function getSSDs(Request $request)
    {
        $filter = $request->all();
        $ssd_id = $filter['ssd_id'] ?? NULL;
        if ($ssd_id)
        {
            $ssd = SSD::where('ssd_id', $ssd_id)->get();
        }
        else
        {
            $ssd = SSD::all();
        }
        return $this->makeResponse(true, $ssd);
    }

    protected function makeResponse($success = false, $data = array())
    {
        return array(
            'success' => $success,
            'data' => $data
        );
    }
}
