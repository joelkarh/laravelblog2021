<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UsersRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UsersEditRequest;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     return $this->middleware('auth');
    // } goed voor 5controllers
    public function index()
    {
        $users = User::all(); //orm queries
        // query builder 2de manier
        // $users= DB::table('users')->get();
        $roles = Role::all();
        //manier 1 met queries orm
        // return view('admin.users.index', ['users'=>$users, 'roles'=>$roles]);
        //manier 2 
        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //De pluck methode retourneert een associatieve array die je kan overdragen
        // naar een formulier in je blade pagina.
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //
        $user= new User();
        $user->name =$request->name ;
        $user->email=$request->email;
        $user->is_active=$request->is_active;
        if($file=$request->file('photo_id')){
            $name= time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $photo= Photo::create(['file'=>$name]);
            $user->photo_id=$photo->id;
        }
        $user->password= Hash::make($request['password']);
        $user->save();
        // wegschrijven van tussentabel
        $user->roles()->sync($request->roles, false);
        
        return redirect('/admin/users');
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
        //
        $user= User::findOrFail($id);
        $roles= Role::pluck('name', 'id')->all();
        return view('admin.users.edit', compact('user','roles'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        //
        $user = User::findOrFail($id);
        if(trim($request->password)==''){
            $input = $request->except('password');
        }else{
            $input=$request->all();
            $input['password']= Hash::make($request['password']);
        }

        if($file=$request->file('photo_id')){
            $name=time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $photo= Photo::create(['file'=>$name]);
            $input['photo_id']=$photo->id;
        }

        $user->update($input);
        //wegschrijven  tussentabel
        $user->roles()->sync($request->roles, true);
        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
