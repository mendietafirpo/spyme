<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        /*$users = User::with('roles')->get();*/
        $users= User::with('roles')->simplePaginate(5);


        return view('usuarios.index',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    protected function create()
    {
        $roles = Role::pluck('name','id');
        return view('usuarios.create', compact('roles'));
    }


    public function store(Request $request){
        $email  = $request->input('email');
        if (User::where('email', $email)->first()){
            return redirect()->back()->with('info','¡ el mail '.$email.' ya fue agregado !');
            }
        else {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create(([
            'name' => $request->name,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'pais' => $request->pais,
            'password' => Hash::make($request->password),
        ]));
        $user->roles()->attach($request->input('roles', []), ['app' => 2]);
        /**user_id=id de user, role_id=attach(x, app= a =>x */

        return redirect()->route('usuarios.index')
        ->with('success','Se agregó el usuario correctamente.');
        }
    }


    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','descripcion','id');

        return view('usuarios.show',compact('user','roles'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','id','descripcion');

        return view('usuarios.edit',compact('user','roles'));
    }

    public function update(Request $request,User $user,$id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'telefono' => 'string|max:30',
            'direccion' => 'string|max:100',
            'ciudad' => 'string|max:50',
            'pais' => 'string|max:30',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->telefono = $request->input('telefono');
        $user->direccion = $request->input('direccion');
        $user->ciudad = $request->input('ciudad');
        $user->pais = $request->input('pais');
        $user->save();

        $user->roles()->attach($request->input('roles', []), ['app' => 2]);

        return redirect()->route('usuarios.index')
                ->with('success','Se actualizó el usuario correctamente');

    }

    public function destroy($id)
    {
        /* borrar en tabla user_role
        User::find($id)->roles()->detach();*/
        $user = User::findOrFail($id);
        $user -> Roles() -> detach();
        $user -> delete();

        return redirect()->route('usuarios.index')
                        ->with('success','Se eliminó el usuario correctamente');
    }

}
