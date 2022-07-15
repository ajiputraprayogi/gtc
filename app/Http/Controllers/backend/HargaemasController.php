<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class HargaemasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.harga_emas.index');
    }

    public function listdata(){
        $data = DB::table('gtc_harga_harian')->orderby('tgl_rilis','desc')->get();
        return response()->json($data);
    }

    public function caridetailhargaharian($id){
        $data = DB::table('gtc_harga_harian')->where('id', $id)->get();
        return response()->json($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'tgl_rilis'=>'required',
            'nolsatu_gram'=>'required',
            'noldua_gram'=>'required',
            'nollima_gram'=>'required',
            'satu_gram'=>'required',
            'dua_gram'=>'required',
            'lima_gram'=>'required',
            'sepuluh_gram'=>'required',
        ]);
        $id = [];
        $data = DB::table('gtc_harga_harian')->get();
        if(count($data)>0){
            foreach($data as $row){
                array_push($id, $row->id);
            }
        }
        DB::table('gtc_harga_harian')->whereIn('id', $id)->update([
            'status' => 'Nonactive'
        ]);
        DB::table('gtc_harga_harian')->insert([
            'tgl_rilis'=>$request->tgl_rilis,
            'nolsatu_gram'=>str_replace(".","",$request->nolsatu_gram),
            'noldua_gram'=>str_replace(".","",$request->noldua_gram),
            'nollima_gram'=>str_replace(".","",$request->nollima_gram),
            'satu_gram'=>str_replace(".","",$request->satu_gram),
            'dua_gram'=>str_replace(".","",$request->dua_gram),
            'lima_gram'=>str_replace(".","",$request->lima_gram),
            'sepuluh_gram'=>str_replace(".","",$request->sepuluh_gram),
            'status'=>'Active'
        ]);
        // return redirect('backend/harga-emas');
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
            'edit_tgl_rilis'=>'required',
            'edit_nolsatu_gram'=>'required',
            'edit_noldua_gram'=>'required',
            'edit_nollima_gram'=>'required',
            'edit_satu_gram'=>'required',
            'edit_dua_gram'=>'required',
            'edit_lima_gram'=>'required',
            'edit_sepuluh_gram'=>'required',
        ]);
        DB::table('gtc_harga_harian')->where('id', $id)->update([
            'tgl_rilis'=>$request->edit_tgl_rilis,
            'nolsatu_gram'=>str_replace(".","",$request->edit_nolsatu_gram),
            'noldua_gram'=>str_replace(".","",$request->edit_noldua_gram),
            'nollima_gram'=>str_replace(".","",$request->edit_nollima_gram),
            'satu_gram'=>str_replace(".","",$request->edit_satu_gram),
            'dua_gram'=>str_replace(".","",$request->edit_dua_gram),
            'lima_gram'=>str_replace(".","",$request->edit_lima_gram),
            'sepuluh_gram'=>str_replace(".","",$request->edit_sepuluh_gram),
        ]);
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
