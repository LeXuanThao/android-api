<?php

namespace App\Http\Controllers;

use App\Models\HDD;
use Illuminate\Http\Request;

class HDDController extends Controller
{
    public function getHDDs(Request $request)
    {
        $hdds = HDD::all();
        return $this->makeResponse(true, $hdds);
    }

    protected function makeResponse($success = false, $data = array())
    {
        return array(
            'success' => $success,
            'data' => $data
        );
    }
}
