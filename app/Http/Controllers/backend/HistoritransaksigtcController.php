<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class HistoritransaksigtcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perwada = Auth::user()->kantor;
        if($perwada !='1'){
            $data = DB::table('gtc_transaksi')
            ->leftjoin('gtc_pengajuan','gtc_pengajuan.kode_pengajuan','=','gtc_transaksi.kode_pengajuan')
            ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
            ->select([
                // 'gtc_transaksi.*','gtc_transaksi.id as idt','gtc_transaksi.kode_transaksi as kode_transaksit','gtc_transaksi.created_at as created_att',
                'gtc_transaksi.*','gtc_transaksi.id as idt','gtc_transaksi.kode_transaksi as kode_transaksit','gtc_transaksi.created_at as created_att','gtc_transaksi.tanggal_jatuh_tempo as tanggal_jatuh_tempot',
                'gtc_pengajuan.*','gtc_pengajuan.id as idp',
                'anggota.*','anggota.id as ida'
            ])
            ->orderby('gtc_transaksi.created_at','desc')
            ->where('gtc_pengajuan.id_perwada', $perwada)
            ->get();
        }else{
            $data = DB::table('gtc_transaksi')
            ->leftjoin('gtc_pengajuan','gtc_pengajuan.kode_pengajuan','=','gtc_transaksi.kode_pengajuan')
            ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
            ->select([
                'gtc_transaksi.*','gtc_transaksi.id as idt','gtc_transaksi.kode_transaksi as kode_transaksit','gtc_transaksi.created_at as created_att','gtc_transaksi.tanggal_jatuh_tempo as tanggal_jatuh_tempot',
                'gtc_pengajuan.*','gtc_pengajuan.id as idp',
                'anggota.*','anggota.id as ida'
            ])
            ->orderby('gtc_transaksi.created_at','desc')
            ->get();
        }
        return view('backend.histori_transaksi.index', compact('data'));
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
        //
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
        //
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
