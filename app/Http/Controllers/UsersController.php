<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index()
    {
        // get only 10 users
        $users = User::orderBy('id', 'DESC')->paginate(10);

        $roles = Role::all();

        return view('index', ['users' => $users, 'roles' => $roles]);
    }

    public function store(Request $request)
    {
        // Form validation
        $rules = [
            'role_id' => 'required',
            'nick' => 'required|unique:users|regex:/^[0-9a-zA-Z_]+$/u|',
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ];

        $messages = [
            'role_id.required' => 'El Rol es obligatorio',
            'nick.required' => 'El nick de usuario es obligatorio',
            'nick.unique' => 'El nick ya existe, seleccione otro',
            'nick.regex' => 'El nick debe comenzar con valores alfanuméricos o guión bajo',
            'name.required' => 'El nombre es obligatorio',
            'email.required' => 'El email es obligatorio',
            'email.unique' => 'El email ya existe',
            'password.required' => 'El password es obligatorio',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Save new user
        $new_user = new User();

        $new_user->role_id = $request->role_id;
        $new_user->nick = $request->nick;
        $new_user->name = $request->name;
        $new_user->last_name = $request->last_name;
        $new_user->email = $request->email;
        $new_user->password = bcrypt($request->password);
        $new_user->save();

        return redirect()->back();

    }

    public function update(Request $request, $id)
    {
        $rules = [
            'role_id' => 'required',
            'nick' => 'required|unique:users|alpha_dash',
            'name' => 'required',
            'email' => 'required',
        ];

        $messages = [
            'role_id.required' => 'El Rol es obligatorio',
            'nick.required' => 'El nick de usuario es obligatorio',
            'nick.unique' => 'El nick ya existe, seleccione otro',
            'nick.alpha_dash' => 'El nick debe comenzar con valores alfanuméricos o guión bajo',
            'name.required' => 'El nombre es obligatorio',
            'email.required' => 'El email es obligatorio',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::find($id);

        $user->role_id = $request->role_id;
        $user->nick = $request->nick;
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if(isset($request->password) || !is_null($request->password) )
            $user->password= bcrypt($request->password);
        $user->save();

        return redirect()->back();

    }

    public function delete(Request $request, $id)
    {
        // Delete user
        $user = User::find($id);
        $user->delete();

        return redirect()->back();

    }
}
