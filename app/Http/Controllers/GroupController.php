<?php

namespace App\Http\Controllers;

use App\Models\group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index_group(){
        $data = group::all();
        return view('group', compact('data'));
    }

    public function create_group(Request $request){
        group::updateOrCreate([
            'id_group'=>$request->id_group,
            'name_group'=>$request->name_group
        ]);
        session()->flash('success', 'Create Success');
        return back();
    }
    public function destroy_group(Request $request){
        group::where('id_group',$request->id)->delete();
        session()->flash('success', 'Delete Success');
        return back();
    }
}
