<?php

namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MeController extends Controller
{
    public function me()
    {
        return response()->json(Auth::user());
    }

    public function signOut(Request $request)
    {
        $request->user()->token()->revoke();
        // Delete all session data and get a new
        $json = [
            'success' => true,
            'code' => 200,
            'message' => 'You are Logged out.',
        ];
        return response()->json($json, '200');
    }
}
