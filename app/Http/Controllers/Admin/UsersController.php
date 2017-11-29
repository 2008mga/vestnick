<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('q')) {
            $users = User::search($request->get('q'));
        } else {
            $users = User::query();
        }
        $users = $users->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all([
            'id',
            'name',
        ]);
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $user = new User();
        $user->fill($request->except([
            'avatar',
            'roles',
        ]));

        if ($request->hasFile('avatar')) {
            // if upload avatar
            $user = $user->uploadAvatar($request->file('avatar'));
        }

        $user->save();

        // sync roles
        $user->roles()->sync($request->get('roles'));

        $request->session()->flash('success', 'Пользователь успешно добавлен');

        return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit($user)
    {
        $user = User::findOrFail($user);
        $roles = Role::all([
            'id',
            'name',
        ]);

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest|Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(UserUpdateRequest $request, $user)
    {
        $user = User::findOrFail($user);
        $user->fill($request->except([
            'password',
            'avatar',
            'roles',
        ]));

        if ($request->hasFile('avatar')) {
            // if upload avatar
            $user = $user->uploadAvatar($request->file('avatar'));
        }

        if ($request->has('password') && $request->get('password')) {
            $user->password = $request->get('password');
        }

        $user->save();

        // sync roles
        $user->roles()->sync($request->get('roles'));

        $request->session()->flash('success', 'Пользователь успешно обновлён');

        return redirect(route('admin.users.edit', $user->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $users
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Request $request, $user)
    {
        $user = User::findOrFail($user);
        if (Auth::user()->id !== $user->id) {
            $user->delete();
        } else {
            $request->session()->flash('danger', 'Вы не можете удалить сами себя');
            return redirect(route('admin.users.index'));
        }

        $request->session()->flash('success', 'Пользовать ' . $user->email . ' удалён');

        return redirect(route('admin.users.index'));
    }
}
