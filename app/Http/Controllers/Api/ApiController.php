<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function loginUser(Request $request): Response
    {
        $data = $request->all();
        Auth::attempt($data);
        $user = Auth::user();
        $token = $user->createToken('My Token')->accessToken;
        return Response(['status' => 200, 'token' => $token, 'data' => $user], 200);
    }

    /**
     * Display the specified resource.
     */
    public function getUserApi(User $user)
    {
        $data = Auth::guard('api')->user();
        return Response(['data' => $data], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
