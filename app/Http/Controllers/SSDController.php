<?php

namespace App\Http\Controllers;

use App\Models\SSD;
use Illuminate\Http\Request;

class SSDController extends Controller
{
    public function getSSDs(Request $request)
    {
        $ssds = SSD::all();
        return $ssds;
    }
}
