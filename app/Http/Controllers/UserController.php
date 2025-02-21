<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;

class UserController extends Controller
{
    /*** Display a listing of the resource.
     * 
     * ** @return \Illuminate\Http\Response*/
    public function index(Request $request)
    {
        $user= DB::table('users')->get();
        $data = User::orderBy('id', 'DESC')->paginate(5);
        return view('users.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
        // return response($user);
    }





    /*** Show the form for creating a new resource.
     * ** @return \Illuminate\Http\Response*/
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }







    /*** Store a newly created resource in storage.
     * ** @param  \Illuminate\Http\Request  $request*
     *  @return \Illuminate\Http\Response*/
    public function store(Request $request)
    {
        //     $this->validate(
        //         $request,
        //         [
        //             'name' => 'required',
        //             'email' => 'required|email|unique:users,email',
        //             'password' => 'required|same:confirm-password',
        //             'roles_name' => 'required'
        //         ]
        //     );
        //     // $input = $request->all();
        //     // $input['password'] = Hash::make($input['password']);


        $user = User::create([
            'name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles_name' => $request->roles_name,
            'Status' => $request->status,

        ]);

        $user->assignRole($request->input('roles'));
        // $user = User::create($input);
        return redirect()->route('users.index')->with('success', 'User created successfully');
        // return response($request);
    }



    /*** Display the specified resource.
     * 
     * 
     ** @param  int  $id* @return \Illuminate\Http\Response*/
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }




    /***
     *  Show the form for editing the specified resource.
     * 
     * ** @param  int  $id* @return \Illuminate\Http\Response*/
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('users.edit', compact('user', 'roles', 'userRole'));


    }


    /*** Update the specified resource in storage.
    ** @param  \Illuminate\Http\Request  $request* 
    
    @param  int  $id* @return \Illuminate\Http\Response*/
    public function update(Request $request, $id)
    {
        // $this->validate($request, ['name' => 'required', 'email' => 'required|email|unique:users,email,' . $id, 'password' => 'same:confirm-password', 'roles' => 'required']);
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            // $input = array_except($input, array('password'));
            $request->password = DB::table('users')->where('id', $id)->select('password')->get();
        }


        $user = User::find($id);
        User::where('id', $id)->update([
            'password' => Hash::make($request->password),
            'name' => $request->user_name,
            'email' => $request->email,
            'Status' => $request->status,


        ]);



        // $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')->with('success', 'User updated successfully');
        // return response();

    }




    /*** Remove the specified resource from storage.
     * ** @param  int  $id* @return \Illuminate\Http\Response*/

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
        // return response($id);
    }
}