<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Entryuser;
use App\Models\Role;
use App\Models\Roleuser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        /*$users = User::with('roles')->get();*/
        $lastentry = Entryuser::where('app_id',2)->orderBy('created_at','desc')->first()->pluck('created_at','idUser');
        $users= User::with('roles')->simplePaginate(5);
        $roles = Role::pluck('name','id','descripcion');

        return view('usuarios.index',compact('users','roles','lastentry'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    protected function create()
    {
        $roles = Role::pluck('name','id');
        $app = Role::pluck('app');
        return view('usuarios.create', compact('roles'));
    }


    public function store(Request $request){
        $email  = $request->input('email');
        if (User::where('email', $email)->first()){
            return redirect()->back()->with('info','¡ el mail '.$email.' ya fue agregado !');
            }
        else {
        $request->validate([
            'username' => 'required|string|max:20',
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create(([
            'username' => $request->username,
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
            'username' => 'required|string|max:20',
            'name' => 'required|string|max:100',
            'telefono' => 'string|max:30',
            'direccion' => 'string|max:100',
            'ciudad' => 'string|max:50',
            'pais' => 'string|max:30',
        ]);

        $user = User::findOrFail($id)->update([
        'name' => $request->input('name'),
        'username' => $request->input('username'),
        'telefono' => $request->input('telefono'),
        'direccion' => $request->input('direccion'),
        'ciudad' => $request->input('ciudad'),
        'pais' => $request->input('pais')
        ]);
        $user = User::findOrFail($id);
        $user->roles()->sync($request->input('roles', []), ['app' => 2]);

        return redirect()->route('usuarios.index')
                ->with('success','Se actualizó el usuario correctamente');

    }

    public function addusers(Request $request,$id)
    {
        $userInApp = DB::table('role_user')
        ->where('app','=',2)
        ->where('user_id','=',$id)
        ->where('role_id',$request->input('roles'))
        ->count();
        $user = User::findOrFail($id);

        if ($userInApp){
            $userElim = Roleuser::where('app',2)
            ->where('user_id',$id)
            ->where('role_id',$request->input('roles'));

            $userElim -> delete();


            return redirect()->route('usuarios.index')
            ->with('success','Se quitó el usuario de la app correctamente');

        }else{
            $user->roles()->attach($request->input('roles'), ['app' => 2]);
            return redirect()->route('usuarios.index')
            ->with('success','Se agregó el usuario a la app correctamente');

        }

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
