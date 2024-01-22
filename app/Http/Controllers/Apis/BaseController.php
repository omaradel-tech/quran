<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{

    public function success($data , $message = 'success', $status = 200)
    {
        return response()->json([
            'data' => $data,
            'message' => $message
        ],$status);
    }

    public function error($data , $message = 'success', $status = 422)
    {
        return response()->json([
            'errors' => $data,
            'message' => $message
        ], $status);
    }
}
