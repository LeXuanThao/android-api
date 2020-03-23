<?php

namespace App\Http\Controllers;

use App\Models\CASES;
use Illuminate\Http\Request;

class CASEController extends Controller
{
    public function getCASEs(Request $request)
    {

        $cases = CASES::all();
        return $this->makeResponse(true, $cases);
    }

    protected function makeResponse($success = false, $data = array())
    {
        return array(
            'success' => $success,
            'data' => $data
        );
    }
}
