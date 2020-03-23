<?php

namespace App\Http\Controllers;

use App\Models\CASES;
use Illuminate\Http\Request;

class CASEController extends Controller
{
    public function getCASEs(Request $request)
    {
        $filter = $request->all();
        $cases = [];
        if (count($filter) > 0) {
            $type = $filter['type'];
            $ver = $filter['ver'];
            $cases = CASES::where('type', $type)->where('ver', '>', $ver)->get();
        } else {
            $cases = CASES::all();
        }
        return $cases;
    }
}
