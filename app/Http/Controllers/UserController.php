<?php

namespace App\Http\Controllers;

use App\Models\group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index_user(){
        $data = DB::table('users')
                ->where('users.email','!=','admin@gmail.com')
                ->join('group','users.id_group','=','group.id_group')
                ->select('users.*','group.*')
                ->get();
        $group = group::all();
        return view('user', compact('data','group'));
    }

    public function create_user(Request $request){
        User::updateOrCreate([
            'id_user'=>rand(1,99).time()
        ],[
            'name'=>$request->name_user,
            'email'=>$request->email_user,
            'roles'=>$request->roles,
            'id_group'=>$request->id_group,
            'gender'=>$request->gender,
            'password' => Hash::make('12345678')
        ]);
        session()->flash('success','Create Success');
        return back();
    }
    public function update_user(Request $request){
        User::updateOrCreate([
            'id'=>$request->id_up
            
        ],[
            'name'=>$request->name_user_up,
            'email'=>$request->email_user_up,
            'roles'=>$request->roles_up,
            'id_group'=>$request->id_group_up,
            'gender'=>$request->gender_up
        ]);
        session()->flash('success','Update Success');
        return back();
    }
    public function destroy_user(Request $request){
        User::find($request->id)->delete();
        session()->flash('success', 'Delete Success');
        return back();
    }
    public function search(Request $request){
        $data = DB::table('users')
                ->where('users.name','Like',"%$request->search%")
                // ->orwhere('users.id_user','Like',"%$request->search%")
                ->join('group','users.id_group','=','group.id_group')
                ->select('users.*','group.*')
                ->get();
        $group = group::all();
        return view('user', compact('data','group'));
    }
}
