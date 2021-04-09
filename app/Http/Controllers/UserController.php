<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.userList')
            ->with('user_list',User::all())
            ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.userRegister')
            ->with('user_register',new User())
            ->with('roles',Role::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);


       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole($request->role);
       return redirect()->route('users.index')->with('success','Created new user successful');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('user.userRegister')
            ->with('user_register',User::find($id))
            ->with('roles',Role::all())
            ->with('user','user');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'confirmed',
        ]);

        $user = User::find($id);
//        dd($user->roles->first()->name);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        if($user->roles->count()>0){
            if($request->get('role') !=  $user->roles->first()->name){
                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($user)
                    ->withProperties(['new' => $request->get('role'),'old' => $user->roles->first()->name])
                    ->useLog('user')
                    ->log('change role');
            }
        }else{
            if($request->get('role') !=  null){
                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($user)
                    ->withProperties(['new' => $request->get('role'),'old' => null])
                    ->useLog('user')
                    ->log('change role');
            }
        }


        $user->syncRoles($request->get('role'));

        return redirect()->route('users.index')->with('success','Updated user successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return back()->with('success','Deleted user successful');
    }

    public function role(){
        return view('user.userRole')
            ->with('user_role',Role::all());
    }

    public function newRole(){
        return view('user.newRole')
            ->with('user_role','user_role')
            ->with('permissions',Permission::all());
    }
    public function storePermission(Request $request){
        $request->validate([
         'role' => 'required|unique:roles,name'
        ]);

        $role = Role::create(['name' => $request->role]);
        $role->givePermissionTo($request->permissions);
        if($request->permissions != null){
            activity()
                ->causedBy(Auth::user())
                ->performedOn($role)
                ->useLog('role')
                ->log('role add permission');
        }

        return redirect()->route('users.role')
            ->with('success','Created role successful');
    }
    public function editRole($id){

        return view('user.newRole')
            ->with('user_role','user_role')
            ->with('permissions',Permission::all())
            ->with('role',Role::findById($id));
    }
    public function updatePermission(Request $request ,$id){
        $request->validate([
            'role' => 'required'
        ]);
        $role = Role::findById($id);
        $role->name = $request->role;
        $role->save();
        $role->revokePermissionTo($role->permissions()->pluck('name')->toArray());
        $role->givePermissionTo($request->permissions);
        activity()
            ->causedBy(Auth::user())
            ->performedOn($role)
            ->useLog('role')
            ->log('role update permission');
        return redirect()->route('users.role')
            ->with('success','Updated role successful');

    }
}
