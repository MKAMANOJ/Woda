<?php

namespace App\Http\Controllers\Api;

use App\EBP\Entities\DeviceToken;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeviceTokenController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request['token']) {
            return response(json_encode(['code' => 422, 'message' => 'Token is required']));
        }
        $token = app(DeviceToken::class)->firstOrCreate($request->all());

        return response(json_encode(['code' => 200, 'status' => 'Successfully registered', 'data' => $token]));
    }
}
