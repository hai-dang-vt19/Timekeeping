<?php

namespace App\Http\Controllers;

use App\Models\calender;
use App\Models\group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = DB::table('calender')
                ->join('users', 'calender.id_user','=','users.id_user')
                ->join('group', 'users.id_group','=','group.id_group')
                ->select('calender.*','users.email','users.name','group.name_group')
                ->get();
        return view('home', compact('data'));
    }

    public function read_qrcode(Request $request){
        $id_user = Auth::user()->id_user;
        $ip = request()->ip();
        
        $query = @unserialize(file_get_contents('http://ip-api.com/php/?fields=status,message,country,region,city,district,lat,lon,isp,org,as,query'));
        // $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip.'/?fields=status,message,country,regionName,city,district,lat,lon,isp,org,as,query'));
        if($query && $query['status'] == 'success')
        {            
            $check_ip = calender::where('ip',$ip)->get();
            if($check_ip == '[]'){
                if($request->telecom == $query['as']){
                    calender::create([
                        'id_user'=>$id_user,
                        'ip'=>$ip,
                        'address'=>$query['city'].' ('.$query['region'].'), '.$query['country'],
                        'telecom_operator'=>$query['as'],
                        'lat_lon'=>$query['lat'].'-'.$query['lon']
                    ]);
                    session()->flash('success','Success');
                    return redirect()->route('home');
                }
            }
            // return 2;
        }
        
        session()->flash('error','Unsuccessful');
        return back();
    }

    public function destroy_user_calen(Request $request){
        // dd($request->id);
        calender::find($request->id)->delete();
        session()->flash('success', 'Delete Success');
        return back();
    }

    public function trun_calen(){
        calender::truncate();
        session()->flash('success', 'Truncate Success');
        return back();
    }
}
