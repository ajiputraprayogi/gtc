<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class JenisjasagtcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('backend.jenis_jasa_gtc.index');
    }

    public function listdata(){
        $data = DB::table('gtc_jenis_jasa')->get();
        return response()->json($data);
    }

    public function caridetailjenisjasa($id){
        $data = DB::table('gtc_jenis_jasa')->where('id', $id)->get();
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
            'pilihan_jasa' => 'required',
            'perhitungan_jasa' => 'required',
            'jangka_waktu_1' => 'required',
            'pengali_kurangdari_satudelapan_1' => 'required',
            'pengali_diatas_dua_1' => 'required',
            'jangka_waktu_2' => 'required',
            'pengali_kurangdari_satudelapan_2' => 'required',
            'pengali_diatas_dua_2' => 'required',
            'jangka_waktu_3' => 'required',
            'pengali_kurangdari_satudelapan_3' => 'required',
            'pengali_diatas_dua_3' => 'required',
            'jangka_waktu_4' => 'required',
            'pengali_kurangdari_satudelapan_4' => 'required',
            'pengali_diatas_dua_4' => 'required',
            'status_1' => 'required',
        ]);
        DB::table('gtc_jenis_jasa')->insert([
            'pilihan_jasa' => $request->pilihan_jasa,
            'perhitungan_jasa' => $request->perhitungan_jasa,
            'jangka_waktu_1' => $request->jangka_waktu_1,
            'pengali_kurangdari_satudelapan_1' => $request->pengali_kurangdari_satudelapan_1,
            'pengali_diatas_dua_1' => $request->pengali_diatas_dua_1,
            'jangka_waktu_2' => $request->jangka_waktu_2,
            'pengali_kurangdari_satudelapan_2' => $request->pengali_kurangdari_satudelapan_2,
            'pengali_diatas_dua_2' => $request->pengali_diatas_dua_2,
            'jangka_waktu_3' => $request->jangka_waktu_3,
            'pengali_kurangdari_satudelapan_3' => $request->pengali_kurangdari_satudelapan_3,
            'pengali_diatas_dua_3' => $request->pengali_diatas_dua_3,
            'jangka_waktu_4' => $request->jangka_waktu_4,
            'pengali_kurangdari_satudelapan_4' => $request->pengali_kurangdari_satudelapan_4,
            'pengali_diatas_dua_4' => $request->pengali_diatas_dua_4,
            'status' => $request->status_1,
        ]);
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
            'edit_pilihan_jasa' => 'required',
            'edit_perhitungan_jasa' => 'required',
            'edit_jangka_waktu_1' => 'required',
            'edit_pengali_kurangdari_satudelapan_1' => 'required',
            'edit_pengali_diatas_dua_1' => 'required',
            'edit_jangka_waktu_2' => 'required',
            'edit_pengali_kurangdari_satudelapan_2' => 'required',
            'edit_pengali_diatas_dua_2' => 'required',
            'edit_jangka_waktu_3' => 'required',
            'edit_pengali_kurangdari_satudelapan_3' => 'required',
            'edit_pengali_diatas_dua_3' => 'required',
            'edit_jangka_waktu_4' => 'required',
            'edit_pengali_kurangdari_satudelapan_4' => 'required',
            'edit_pengali_diatas_dua_4' => 'required',
            'edit_status_1' => 'required',
        ]);
        DB::table('gtc_jenis_jasa')->where('id', $id)->update([
            'pilihan_jasa' => $request->edit_pilihan_jasa,
            'perhitungan_jasa' => $request->edit_perhitungan_jasa,
            'jangka_waktu_1' => $request->edit_jangka_waktu_1,
            'pengali_kurangdari_satudelapan_1' => $request->edit_pengali_kurangdari_satudelapan_1,
            'pengali_diatas_dua_1' => $request->edit_pengali_diatas_dua_1,
            'jangka_waktu_2' => $request->edit_jangka_waktu_2,
            'pengali_kurangdari_satudelapan_2' => $request->edit_pengali_kurangdari_satudelapan_2,
            'pengali_diatas_dua_2' => $request->edit_pengali_diatas_dua_2,
            'jangka_waktu_3' => $request->edit_jangka_waktu_3,
            'pengali_kurangdari_satudelapan_3' => $request->edit_pengali_kurangdari_satudelapan_3,
            'pengali_diatas_dua_3' => $request->edit_pengali_diatas_dua_3,
            'jangka_waktu_4' => $request->edit_jangka_waktu_4,
            'pengali_kurangdari_satudelapan_4' => $request->edit_pengali_kurangdari_satudelapan_4,
            'pengali_diatas_dua_4' => $request->edit_pengali_diatas_dua_4,
            'status' => $request->edit_status_1,
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
