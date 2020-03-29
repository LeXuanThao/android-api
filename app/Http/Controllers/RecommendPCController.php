<?php

namespace App\Http\Controllers;

use App\Models\RecommendPC;
use Illuminate\Http\Request;

class RecommendPCController extends Controller
{
    public function getRecommendPC(Request $request)
    {
       $recommend_pc = RecommendPC::all();
       return $this->makeResponse(true, $recommend_pc);
    }

    protected function makeResponse($success = false, $data = array())
    {
        return array(
            'success' => $success,
            'data' => $data
        );
    }
}
