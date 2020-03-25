<?php

namespace App\Http\Controllers;

use App\Models\CASES;
use Illuminate\Http\Request;

class CASEController extends Controller
{
    public function getCASEs(Request $request)
    {
        $filter = $request->all();
        $case_id = $filter['case_id'] ?? NULL;
        if ($case_id)
        {
            $case = CASES::where('case_id', $case_id)->get();
        }
        else
        {
            $case = CASES::all();
        }
        return $this->makeResponse(true, $case);
    }

    protected function makeResponse($success = false, $data = array())
    {
        return array(
            'success' => $success,
            'data' => $data
        );
    }
}
