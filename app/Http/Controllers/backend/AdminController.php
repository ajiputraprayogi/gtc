<?php
namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\User;
use File;
use Hash;
use DB;

class AdminController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view-users', ['only' => ['index','show','listdata']]);
        $this->middleware('permission:create-users', ['only' => ['create']]);
        $this->middleware('permission:edit-users', ['only' => ['edit']]);
        $this->middleware('permission:delete-users', ['only' => ['destroy']]);
    }

    //=================================================================
    public function index()
    {
        $data = DB::table('users')->orderby('id','desc')->get();
        return view('backend.admin.index',['data'=>$data]);
    }

    //=================================================================
    public function listdata()
    {
        $users = DB::table('users')
        ->leftjoin('roles','roles.id','=','users.role')
        ->leftjoin('perwada','perwada.id','=','users.kantor')
        ->select([
            'users.*','users.id as idu','users.status as sts',
            'roles.*','roles.id as idr','roles.name as grup',
            'perwada.*','perwada.id as idp','perwada.nama as kantor'
        ])
        ->get();
        return Datatables::of($users)->make(true);
    }

    public function caripengaturanakun($id)
    {
        $data = DB::table('users')->where('id', $id)->get();
        $print = [
            'data' => $data,
        ];
        return response()->json($print);
    }
    
    //=================================================================
    public function create()
    {
        $roles = DB::table('roles')->orderby('id','desc')->get();
        return view('backend.admin.create',compact('roles'));
    }

    //=================================================================
    public function store(Request $request)
    {
        // $request->validate([
        //     'username' => ['required', 'unique:users'],
        //     'email' => ['required', 'unique:users'],
        // ]);
        // $nameland=$request->file('gambar')->getClientOriginalname();
        // $lower_file_name=strtolower($nameland);
        // $replace_space=str_replace(' ', '-', $lower_file_name);
        // $finalname=time().'-'.$replace_space;
        // $destination=public_path('img/admin');
        // $request->file('gambar')->move($destination,$finalname);
        
        $usr = User::create([
            'nama'=>$request->tambah_namakaryawan,
            'username'=>$request->tambah_userid,
            'email'=>$request->tambah_email,
            'jabatan'=>$request->tambah_jabatan,
            'kantor'=>$request->tambah_kantor,
            'role'=>$request->tambah_grup,
            'password'=>Hash::make($request->tambah_password),
            'status'=>$request->tambah_status,
        ]);
        $usr->assignRole($request->tambahrole);
    }

    //=================================================================
    public function show($id)
    {
        //
    }

    //=================================================================
    public function edit($id)
    {
        $roles = DB::table('roles')->orderby('id','desc')->get();
        $data = User::find($id);
        return view('backend.admin.edit',compact('data','roles'));
    }

    //=================================================================
    public function update(Request $request, $id)
    {
        // if($request->edit_userid!=$request->old_edit_userid){
        //     $request->validate([
        //         'username' => ['required', 'unique:users'],
        //     ]);
        // }

        // if($request->edit_email!=$request->old_edit_email){
        //     $request->validate([
        //         'email' => ['required', 'unique:users'],
        //     ]);
        // }

        if($request->edit_password==''){
            User::find($id)
            ->update([
                'nama'=>$request->edit_namakaryawan,
                'username'=>$request->edit_userid,
                'email'=>$request->edit_email,
                'jabatan'=>$request->edit_jabatan,
                'kantor'=>$request->edit_kantor,
                'role'=>$request->edit_grup,
                'status'=>$request->edit_status,
            ]);
            $usr = User::find($id);
            $usr->assignRole($request->edit_grup);
        }else{
            User::find($id)
            ->update([
                'nama'=>$request->edit_namakaryawan,
                'username'=>$request->edit_userid,
                'email'=>$request->edit_email,
                'jabatan'=>$request->edit_jabatan,
                'kantor'=>$request->edit_kantor,
                'role'=>$request->edit_grup,
                'password'=>Hash::make($request->edit_password),
                'status'=>$request->edit_status,
            ]);
            $usr = User::find($id);
            $usr->assignRole($request->edit_grup);
        }
    }

    //=================================================================
    public function destroy($id)
    {
        $data = User::find($id);
        if($data->gambar !=''){
            File::delete('img/admin/'.$data->gambar);
        }
        User::destroy($id);
        //return redirect('/backend/admin')->with('status','Sukses menghapus data');
    }
}
