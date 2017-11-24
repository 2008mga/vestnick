<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function anket($id)
    {
        $user = User::query()
            ->select(['id', 'name', 'about', 'avatar', 'sex'])
            ->with(['news'])
            ->findOrFail($id);

        return response()->json($user);
    }
}
