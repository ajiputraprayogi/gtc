<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use DataTables;
use File;

class AktifgtcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('gtc_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
        ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','anggota.*','anggota.id as ida')
        ->where('status_akhir', 'Aktif')
        ->get();
        return view('backend.aktif_gtc.index', compact('data'));
    }

    public function transaksi($id)
    {
        $data = DB::table('gtc_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
        ->leftjoin('gtc_transaksi', 'gtc_transaksi.kode_transaksi', 'gtc_pengajuan.kode_transaksi')
        ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','anggota.*','anggota.id as ida','gtc_transaksi.*','gtc_transaksi.id as idt')
        ->where('gtc_pengajuan.id', $id)
        ->get();

        $ceklastTransaksi = DB::table('gtc_transaksi')->where('sbte', '!=', '')->orderby('created_at', 'desc')->first();
        if(empty($ceklastTransaksi->sbte)){
            $lastTransaksi = '062.13.11000000-04';
        }else{
            $lastTransaksi = $ceklastTransaksi->sbte;
        }
        // dd($lastTransaksi);
        $sbte = $lastTransaksi;
        $kode = explode(".", $sbte);
        $kode2 = explode("-", $kode[2]);
        $kode3 = substr($kode2[0], -5);
        $kode3++;
        $kode4 = str_pad($kode3, 5, '0', STR_PAD_LEFT);
        // ==============
        $kodeperwada = "062";
        $kodedefault = "13";
        $carigender = DB::table("anggota")->where('id', '1')->first();
        $gender = $carigender->jenis_kelamin;
        if($gender == 'Laki-laki'){
            $kodegender = '12';
        }else if($gender == 'Perempuan'){
            $kodegender = '11';
        }
        $kodesistem = '0';
        $kodedefault2 = '04';
        $finalkode = $kodeperwada.'.'.$kodedefault.'.'.$kodegender.$kodesistem.$kode4.'-'.$kodedefault2;
        // dd($data);
        
        return view('backend.aktif_gtc.transaksi', compact('data'));
    }

    public function listtransaksi($id)
    {
        return Datatables::of(DB::table('gtc_transaksi')
        ->leftjoin('gtc_pengajuan', 'gtc_pengajuan.kode_pengajuan', 'gtc_transaksi.kode_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
        ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','anggota.*','anggota.id as ida','gtc_transaksi.*','gtc_transaksi.id as idt')
        ->where('gtc_transaksi.kode_pengajuan', $id)
        ->orderby('gtc_transaksi.kode_pengajuan', 'desc')
        ->get())->make(true);
    }

    public function listtambahtransaksi($id)
    {
        $data = DB::table('gtc_transaksi')
        ->leftjoin('gtc_pengajuan', 'gtc_pengajuan.kode_pengajuan', 'gtc_transaksi.kode_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
        ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','anggota.*','anggota.id as ida','gtc_transaksi.*','gtc_transaksi.id as idt')
        ->where('gtc_transaksi.kode_pengajuan', $id)
        ->orderby('gtc_transaksi.kode_pengajuan', 'desc')
        ->get();
        
        $kodetransaksi = explode('.', $id);
        $kodetransaksi2 = 'B'.'.'.$kodetransaksi[1].'.'.$kodetransaksi[2];
        $carikodetransaksi = DB::table('gtc_transaksi')
        ->where('kode_transaksi','like','%'.$kodetransaksi2.'%')
        ->max('kode_transaksi');
        if(!$carikodetransaksi){
            $finalkodetransaksi = $kodetransaksi2.'.1';
        }else{
            $getnumbertransaksi = explode('.', $carikodetransaksi);
            $jumlahtransaksi = count($getnumbertransaksi);
            $newnotransaksi = $getnumbertransaksi[$jumlahtransaksi-1]+1;
            $finalkodetransaksi = $kodetransaksi2.'.'.$newnotransaksi;
        }
        
        $pembayaran_pinjaman = DB::table('gtc_histori_transaksi')->where('kode_pengajuan', $id)->groupby('kode_transaksi')->get();
        $pengajuan = 0;
        foreach($data as $row){
            $pengajuan = $row->pengajuan;
        }
        $fpembayaran_pinjaman = 0;
        foreach($pembayaran_pinjaman as $row){
            $fpembayaran_pinjaman += $row->pembayaran_pinjaman;
        }
        $nominalpinjaman = $pengajuan-$fpembayaran_pinjaman;

        $print = [
            'data' => $data,
            'finalkodetransaksi' => $finalkodetransaksi,
            'nominalpinjaman' => $nominalpinjaman,
        ];
        return response()->json($print);
    }

    public function tambahtransaksi(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        if(!$_FILES["tambah_upload_bukti_transfer"]["error"] == 4) {
            File::delete('img/bukti_transfer/'.$request->old_tambah_upload_bukti_transfer);
            $nameland=$request->file('tambah_upload_bukti_transfer')->getClientOriginalname();
            $lower_file_name=strtolower($nameland);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $finalname=time().'-'.$replace_space;
            $destination=public_path('img/bukti_transfer');
            $request->file('tambah_upload_bukti_transfer')->move($destination,$finalname);
        }else{
            $finalname = $request->old_tambah_upload_bukti_transfer;
        }
        if($request->tambah_jenis_transaksi == 'Perpanjangan'){
            DB::table('gtc_transaksi')->insert([
                'kode_pengajuan' => $request->tambah_kode_pengajuan,
                'kode_transaksi' => $request->tambah_kode_transaksi,
                'jenis_transaksi' =>$request->tambah_jenis_transaksi,
                'pilihan_jasa' => $request->tambah_pilihan_jasa,
                'perhitungan_jasa' => $request->tambah_perhitungan_jasa,
                'jangka_waktu_permohonan' => $request->tambah_jangka_waktu_permohonan,
                'jasa_gtc' => str_replace(".","",$request->tambah_jasa_gtc),
                'pembayaran_jasa' => $request->tambah_pembayaran_jasa,
                'upload_bukti_transfer' => $finalname,
                'jumlah_transfer' => str_replace(".","",$request->tambah_pembayaran),
                "created_at" => \Carbon\Carbon::now(),  # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ]);
            $index = 0;
            foreach($request->id_emas as $id){
                $historitransaksi = DB::table('gtc_histori_transaksi')->insert([
                    'kode_pengajuan' => $request->tambah_kode_pengajuan,
                    'kode_transaksi' => $request->tambah_kode_transaksi,
                    'id_emas' => $request->id_emas[$index],
                    'keping' => "0",
                    'pembayaran_pinjaman' => "0",
                    "created_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                ]);
                $index++;
            }
        }else if($request->tambah_jenis_transaksi == 'Pelunasan Sebagian'){
            $pembayaran = str_replace(".","",$request->tambah_pembayaran);
            $pembayaranpinjaman = str_replace(".","",$request->tambah_pembayaran_pinjaman);
            $jumlahtransfer = $pembayaran-$pembayaranpinjaman;
            DB::table('gtc_transaksi')->insert([
                'kode_pengajuan' => $request->tambah_kode_pengajuan,
                'kode_transaksi' => $request->tambah_kode_transaksi,
                'jenis_transaksi' =>$request->tambah_jenis_transaksi,
                'pilihan_jasa' => $request->tambah_pilihan_jasa,
                'perhitungan_jasa' => $request->tambah_perhitungan_jasa,
                'jangka_waktu_permohonan' => $request->tambah_jangka_waktu_permohonan,
                'jasa_gtc' =>str_replace(".","",$request->tambah_jasa_gtc),
                'pembayaran_jasa' => $request->tambah_pembayaran_jasa,
                'upload_bukti_transfer' => $finalname,
                'jumlah_transfer' => $jumlahtransfer,
                "created_at" => \Carbon\Carbon::now(),  # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ]);
            $index = 0;
            foreach($request->id_emas as $id){
                $historitransaksi = DB::table('gtc_histori_transaksi')->insert([
                    'kode_pengajuan' => $request->tambah_kode_pengajuan,
                    'kode_transaksi' => $request->tambah_kode_transaksi,
                    'id_emas' => $request->id_emas[$index],
                    'keping' => $request->pengurangan[$index],
                    'pembayaran_pinjaman' => str_replace(".","",$request->tambah_pembayaran_pinjaman),
                    "created_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                ]);
                $index++;
            }
        }else if($request->tambah_jenis_transaksi == 'Pelunasan'){
            $pembayaran = str_replace(".","",$request->tambah_pembayaran);
            $pembayaranpinjaman = str_replace(".","",$request->tambah_pembayaran_pinjaman);
            $jumlahtransfer = $pembayaran-$pembayaranpinjaman;
            DB::table('gtc_transaksi')->insert([
                'kode_pengajuan' => $request->tambah_kode_pengajuan,
                'kode_transaksi' => $request->tambah_kode_transaksi,
                'jenis_transaksi' =>$request->tambah_jenis_transaksi,
                'pilihan_jasa' => $request->tambah_pilihan_jasa,
                'perhitungan_jasa' => $request->tambah_perhitungan_jasa,
                'jangka_waktu_permohonan' => '0',
                'jasa_gtc' =>str_replace(".","",$request->tambah_jasa_gtc),
                'pembayaran_jasa' => $request->tambah_pembayaran_jasa,
                'upload_bukti_transfer' => $finalname,
                'jumlah_transfer' => '0',
                "created_at" => \Carbon\Carbon::now(),  # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ]);
            $index = 0;
            foreach($request->id_emas as $id){
                $historitransaksi = DB::table('gtc_histori_transaksi')->insert([
                    'kode_pengajuan' => $request->tambah_kode_pengajuan,
                    'kode_transaksi' => $request->tambah_kode_transaksi,
                    'id_emas' => $request->id_emas[$index],
                    'keping' => $request->pengurangan[$index],
                    'pembayaran_pinjaman' => str_replace(".","",$request->tambah_pembayaran_pinjaman),
                    "created_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                ]);
                $index++;
            }
        }
    }

    public function edittransaksi($id, Request $request){
        $data = DB::table('gtc_transaksi')->where('id', $id)->first();
        date_default_timezone_set('Asia/Jakarta');
        if(!$_FILES["edit_upload_bukti_transfer"]["error"] == 4) {
            File::delete('img/bukti_transfer/'.$request->old_edit_upload_bukti_transfer);
            $nameland=$request->file('edit_upload_bukti_transfer')->getClientOriginalname();
            $lower_file_name=strtolower($nameland);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $finalname=time().'-'.$replace_space;
            $destination=public_path('img/bukti_transfer');
            $request->file('edit_upload_bukti_transfer')->move($destination,$finalname);
        }else{
            $finalname = $request->old_edit_upload_bukti_transfer;
        }
        if($request->edit_jenis_transaksi == 'Perpanjangan'){
            DB::table('gtc_transaksi')->where('id', $id)->update([
                'jenis_transaksi' =>$request->edit_jenis_transaksi,
                'pilihan_jasa' => $request->edit_pilihan_jasa,
                'perhitungan_jasa' => $request->edit_perhitungan_jasa,
                'jangka_waktu_permohonan' => $request->edit_jangka_waktu_permohonan,
                'jasa_gtc' => str_replace(".","",$request->edit_jasa_gtc),
                'pembayaran_jasa' => $request->edit_pembayaran_jasa,
                'upload_bukti_transfer' => $finalname,
                'jumlah_transfer' => str_replace(".","",$request->edit_pembayaran),
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ]);
            $data2 = DB::table('gtc_histori_transaksi')->where('kode_transaksi', $data->kode_transaksi)->get();
            foreach($data2 as $row){
                $idemas[] = $row->id; 
                $no = 0;
                $index = 0;
                foreach($idemas as $id){
                    $historitransaksi = DB::table('gtc_histori_transaksi')->where('id', $id)->update([
                        'id_emas' => $request->editid_emas[$index],
                        'keping' => $request->editpengurangan[$index],
                        'pembayaran_pinjaman' => str_replace(".","",$request->edit_pembayaran_pinjaman),
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                    $index++;
                }
            }
        }else if($request->edit_jenis_transaksi == 'Pelunasan Sebagian'){
            $pembayaran = str_replace(".","",$request->edit_pembayaran);
            $pembayaranpinjaman = str_replace(".","",$request->edit_pembayaran_pinjaman);
            $jumlahtransfer = $pembayaran-$pembayaranpinjaman;
            DB::table('gtc_transaksi')->where('id', $id)->update([
                'jenis_transaksi' =>$request->edit_jenis_transaksi,
                'pilihan_jasa' => $request->edit_pilihan_jasa,
                'perhitungan_jasa' => $request->edit_perhitungan_jasa,
                'jangka_waktu_permohonan' => $request->edit_jangka_waktu_permohonan,
                'jasa_gtc' =>str_replace(".","",$request->edit_jasa_gtc),
                'pembayaran_jasa' => $request->edit_pembayaran_jasa,
                'upload_bukti_transfer' => $finalname,
                'jumlah_transfer' => $jumlahtransfer,
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ]);
            $data2 = DB::table('gtc_histori_transaksi')->where('kode_transaksi', $data->kode_transaksi)->get();
            foreach($data2 as $row){
                $idemas[] = $row->id; 
                $no = 0;
                $index = 0;
                foreach($idemas as $id){
                    $historitransaksi = DB::table('gtc_histori_transaksi')->where('id', $id)->update([
                        'id_emas' => $request->editid_emas[$index],
                        'keping' => $request->editpengurangan[$index],
                        'pembayaran_pinjaman' => str_replace(".","",$request->edit_pembayaran_pinjaman),
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                    $index++;
                }
            }
        }else if($request->edit_jenis_transaksi == 'Pelunasan'){
            $pembayaran = str_replace(".","",$request->edit_pembayaran);
            $pembayaranpinjaman = str_replace(".","",$request->edit_pembayaran_pinjaman);
            $jumlahtransfer = $pembayaran-$pembayaranpinjaman;
            DB::table('gtc_transaksi')->where('id', $id)->update([
                'jenis_transaksi' =>$request->edit_jenis_transaksi,
                'pilihan_jasa' => $request->edit_pilihan_jasa,
                'perhitungan_jasa' => $request->edit_perhitungan_jasa,
                'jangka_waktu_permohonan' => '0',
                'jasa_gtc' => '0',
                'pembayaran_jasa' => '',
                'upload_bukti_transfer' => $finalname,
                'jumlah_transfer' => '0',
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ]);
            $data2 = DB::table('gtc_histori_transaksi')->where('kode_transaksi', $data->kode_transaksi)->get();
            foreach($data2 as $row){
                $idemas[] = $row->id; 
                $no = 0;
                $index = 0;
                foreach($idemas as $id){
                    $historitransaksi = DB::table('gtc_histori_transaksi')->where('id', $id)->update([
                        'id_emas' => $request->editid_emas[$index],
                        'keping' => $request->editpengurangan[$index],
                        'pembayaran_pinjaman' => str_replace(".","",$request->edit_pembayaran_pinjaman),
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                    $index++;
                }
            }
        }
    }

    public function listedittransaksi($id, $kode2){
        $data = DB::table('gtc_transaksi')
        ->leftjoin('gtc_pengajuan', 'gtc_pengajuan.kode_pengajuan', 'gtc_transaksi.kode_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
        ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','anggota.*','anggota.id as ida','gtc_transaksi.*','gtc_transaksi.id as idt')
        ->where('gtc_transaksi.id', $id)
        ->orderby('gtc_transaksi.kode_pengajuan', 'desc')
        ->get();
        $data2 = DB::table('gtc_transaksi')->where('id', $id)->first();
        $tanggal = DB::table('gtc_histori_transaksi')->where('kode_transaksi', $data2->kode_transaksi)->first();
        $retanggal = explode(":", $tanggal->created_at);
        $newtanggal = $retanggal[2]-1;
        $finaltanggal = $retanggal[0].":".$retanggal[1].":".$newtanggal;
        $pembayaran_pinjaman = DB::table('gtc_histori_transaksi')
        ->whereBetween('created_at', array('0000-00-00 00:00:00', $finaltanggal))
        ->where('kode_pengajuan', $kode2)
        ->groupby('kode_transaksi')->get();

        $pengajuan = 0;
        foreach($data as $row){
            $pengajuan = $row->pengajuan;
        }
        $fpembayaran_pinjaman = 0;
        foreach($pembayaran_pinjaman as $row){
            $fpembayaran_pinjaman += $row->pembayaran_pinjaman;
        }
        $nominalpinjaman = $pengajuan-$fpembayaran_pinjaman;

        $pembayaran_pinjaman2 = DB::table('gtc_histori_transaksi')
        ->where('kode_transaksi', $data2->kode_transaksi)
        ->groupby('kode_transaksi')->get();
        $fpembayaran_pinjaman2 = 0;
        foreach($pembayaran_pinjaman2 as $row){
            $fpembayaran_pinjaman2 += $row->pembayaran_pinjaman;
        }

        $sisapinjaman = $nominalpinjaman-$fpembayaran_pinjaman2;

        $print = [
            'data' => $data,
            'nominalpinjaman' => $nominalpinjaman,
            'fpembayaran_pinjaman' => $fpembayaran_pinjaman,
            'fpembayaran_pinjaman2' => $fpembayaran_pinjaman2,
            'sisapinjaman' => $sisapinjaman
        ];
        return response()->json($print);
    }

    public function listemasgtc($kode)
    {
        $data = DB::table('gtc_emas')->where('kode_pengajuan', $kode)->get();
        $transaksi = DB::table('gtc_histori_transaksi')->select(DB::raw('sum(keping) as total'))->where('kode_pengajuan', $kode)->groupby('id_emas')->get();
        $jenisjasagtc = DB::table('gtc_jenis_jasa')->where('status', 'Active')->get();
        $totalkeping = DB::table('gtc_emas')->where('kode_pengajuan', $kode)->sum('keping');
        $tkeping = 0;
        foreach($transaksi as $row){
            $tkeping += $row->total;
        }
        $fkeping = $totalkeping-$tkeping;
        $gramasi = DB::table('gtc_emas')->where('kode_pengajuan', $kode)->get();
        $i = 0;
        $fgramasi = 0;
        foreach($gramasi as $row){
            $i += 1;
            $a = $transaksi[$i-1]->total;
            $b = $gramasi[$i-1]->keping;
            $ab = $b-$a;
            $fgramasi += $ab*$row->gramasi;
        }
        // dd($fgramasi);
        $hargaharian = DB::table('gtc_harga_harian')->where('status', 'Active')->first();
        $totalbuyback = 0;
        if(count($data)>0){
            $i = 0;
            foreach($data as $row){
                $i += 1;
                if($row->gramasi == '0.1'){
                    $a = $transaksi[$i-1]->total;
                    $b = $row->keping;
                    $ab = $b-$a;
                    $totalbuyback += $hargaharian->nolsatu_gram*$ab;
                }else if($row->gramasi == '0.2'){
                    $a = $transaksi[$i-1]->total;
                    $b = $row->keping;
                    $ab = $b-$a;
                    $totalbuyback += $hargaharian->noldua_gram*$ab;
                }else if($row->gramasi == '0.5'){
                    $a = $transaksi[$i-1]->total;
                    $b = $row->keping;
                    $ab = $b-$a;
                    $totalbuyback += $hargaharian->nollima_gram*$ab;
                }else if($row->gramasi == '1'){
                    $a = $transaksi[$i-1]->total;
                    $b = $row->keping;
                    $ab = $b-$a;
                    $totalbuyback += $hargaharian->satu_gram*$ab;
                }else if($row->gramasi == '2'){
                    $a = $transaksi[$i-1]->total;
                    $b = $row->keping;
                    $ab = $b-$a;
                    $totalbuyback += $hargaharian->dua_gram*$ab;
                }else if($row->gramasi == '5'){
                    $a = $transaksi[$i-1]->total;
                    $b = $row->keping;
                    $ab = $b-$a;
                    $totalbuyback += $hargaharian->lima_gram*$ab;
                }else if($row->gramasi == '10'){
                    $a = $transaksi[$i-1]->total;
                    $b = $row->keping;
                    $ab = $b-$a;
                    $totalbuyback += $hargaharian->sepuluh_gram*$ab;
                }
            }
        }
        $print = [
            'emas' => $data,
            'transaksi' => $transaksi,
            'fkeping' => $fkeping,
            'fgramasi' => $fgramasi,
            'jenisjasagtc' => $jenisjasagtc,
            'totalbuyback' => $totalbuyback,
            'hargaharian' => $hargaharian
        ];
        return response()->json($print);
    }

    public function listeditemasgtc($kode, $kode2)
    {
        $data = DB::table('gtc_emas')->where('kode_pengajuan', $kode)->get();
        $tanggal = DB::table('gtc_histori_transaksi')->where('kode_transaksi', $kode2)->first();
        $retanggal = explode(":", $tanggal->created_at);
        $newtanggal = $retanggal[2]-1;
        $finaltanggal = $retanggal[0].":".$retanggal[1].":".$newtanggal;
        $transaksi = DB::table('gtc_histori_transaksi')
        ->select(DB::raw('sum(keping) as total'))
        ->whereBetween('created_at', array('0000-00-00 00:00:00', $finaltanggal))
        ->where('kode_pengajuan', $kode)
        ->groupby('id_emas')
        ->get();
        $jenisjasagtc = DB::table('gtc_jenis_jasa')->where('status', 'Active')->get();
        $totalkeping = DB::table('gtc_emas')->where('kode_pengajuan', $kode)->sum('keping');
        $tkeping = 0;
        foreach($transaksi as $row){
            $tkeping += $row->total;
        }
        $fkeping = $totalkeping-$tkeping;
        $gramasi = DB::table('gtc_emas')->where('kode_pengajuan', $kode)->get();
        $i = 0;
        $fgramasi = 0;
        foreach($gramasi as $row){
            $i += 1;
            $a = $transaksi[$i-1]->total;
            $b = $gramasi[$i-1]->keping;
            $ab = $b-$a;
            $fgramasi += $ab*$row->gramasi;
        }
        // dd($fgramasi);
        $hargaharian = DB::table('gtc_harga_harian')->where('status', 'Active')->first();
        $totalbuyback = 0;
        if(count($data)>0){
            $i = 0;
            foreach($data as $row){
                $i += 1;
                if($row->gramasi == '0.1'){
                    $a = $transaksi[$i-1]->total;
                    $b = $row->keping;
                    $ab = $b-$a;
                    $totalbuyback += $hargaharian->nolsatu_gram*$ab;
                }else if($row->gramasi == '0.2'){
                    $a = $transaksi[$i-1]->total;
                    $b = $row->keping;
                    $ab = $b-$a;
                    $totalbuyback += $hargaharian->noldua_gram*$ab;
                }else if($row->gramasi == '0.5'){
                    $a = $transaksi[$i-1]->total;
                    $b = $row->keping;
                    $ab = $b-$a;
                    $totalbuyback += $hargaharian->nollima_gram*$ab;
                }else if($row->gramasi == '1'){
                    $a = $transaksi[$i-1]->total;
                    $b = $row->keping;
                    $ab = $b-$a;
                    $totalbuyback += $hargaharian->satu_gram*$ab;
                }else if($row->gramasi == '2'){
                    $a = $transaksi[$i-1]->total;
                    $b = $row->keping;
                    $ab = $b-$a;
                    $totalbuyback += $hargaharian->dua_gram*$ab;
                }else if($row->gramasi == '5'){
                    $a = $transaksi[$i-1]->total;
                    $b = $row->keping;
                    $ab = $b-$a;
                    $totalbuyback += $hargaharian->lima_gram*$ab;
                }else if($row->gramasi == '10'){
                    $a = $transaksi[$i-1]->total;
                    $b = $row->keping;
                    $ab = $b-$a;
                    $totalbuyback += $hargaharian->sepuluh_gram*$ab;
                }
            }
        }

        $historikeping = DB::table('gtc_histori_transaksi')->where('kode_transaksi', $kode2)->get();

        $print = [
            'emas' => $data,
            'transaksi' => $transaksi,
            'fkeping' => $fkeping,
            'fgramasi' => $fgramasi,
            'jenisjasagtc' => $jenisjasagtc,
            'totalbuyback' => $totalbuyback,
            'hargaharian' => $hargaharian,
            'historikeping' => $historikeping,
        ];
        return response()->json($print);
    }

    public function listviewemasgtc($kode, $kode2)
    {
        $data = DB::table('gtc_emas')->where('kode_pengajuan', $kode)->get();
        $tanggal = DB::table('gtc_histori_transaksi')->where('kode_transaksi', $kode2)->first();
        $retanggal = explode(":", $tanggal->created_at);
        $newtanggal = $retanggal[2]-1;
        $finaltanggal = $retanggal[0].":".$retanggal[1].":".$newtanggal;
        $transaksi = DB::table('gtc_histori_transaksi')
        ->select(DB::raw('sum(keping) as total'))
        ->whereBetween('created_at', array('0000-00-00 00:00:00', $finaltanggal))
        ->where('kode_pengajuan', $kode)
        ->groupby('id_emas')
        ->get();
        $jenisjasagtc = DB::table('gtc_jenis_jasa')->where('status', 'Active')->get();
        $totalkeping = DB::table('gtc_emas')->where('kode_pengajuan', $kode)->sum('keping');
        $tkeping = 0;
        foreach($transaksi as $row){
            $tkeping += $row->total;
        }
        $fkeping = $totalkeping-$tkeping;
        $gramasi = DB::table('gtc_emas')->where('kode_pengajuan', $kode)->get();
        $i = 0;
        $fgramasi = 0;
        foreach($gramasi as $row){
            $i += 1;
            $a = $transaksi[$i-1]->total;
            $b = $gramasi[$i-1]->keping;
            $ab = $b-$a;
            $fgramasi += $ab*$row->gramasi;
        }
        // dd($fgramasi);
        $hargaharian = DB::table('gtc_harga_harian')->where('status', 'Active')->first();
        $totalbuyback = 0;
        if(count($data)>0){
            $i = 0;
            foreach($data as $row){
                $i += 1;
                if($row->gramasi == '0.1'){
                    $a = $transaksi[$i-1]->total;
                    $b = $row->keping;
                    $ab = $b-$a;
                    $totalbuyback += $hargaharian->nolsatu_gram*$ab;
                }else if($row->gramasi == '0.2'){
                    $a = $transaksi[$i-1]->total;
                    $b = $row->keping;
                    $ab = $b-$a;
                    $totalbuyback += $hargaharian->noldua_gram*$ab;
                }else if($row->gramasi == '0.5'){
                    $a = $transaksi[$i-1]->total;
                    $b = $row->keping;
                    $ab = $b-$a;
                    $totalbuyback += $hargaharian->nollima_gram*$ab;
                }else if($row->gramasi == '1'){
                    $a = $transaksi[$i-1]->total;
                    $b = $row->keping;
                    $ab = $b-$a;
                    $totalbuyback += $hargaharian->satu_gram*$ab;
                }else if($row->gramasi == '2'){
                    $a = $transaksi[$i-1]->total;
                    $b = $row->keping;
                    $ab = $b-$a;
                    $totalbuyback += $hargaharian->dua_gram*$ab;
                }else if($row->gramasi == '5'){
                    $a = $transaksi[$i-1]->total;
                    $b = $row->keping;
                    $ab = $b-$a;
                    $totalbuyback += $hargaharian->lima_gram*$ab;
                }else if($row->gramasi == '10'){
                    $a = $transaksi[$i-1]->total;
                    $b = $row->keping;
                    $ab = $b-$a;
                    $totalbuyback += $hargaharian->sepuluh_gram*$ab;
                }
            }
        }

        $historikeping = DB::table('gtc_histori_transaksi')->where('kode_transaksi', $kode2)->get();

        $print = [
            'emas' => $data,
            'transaksi' => $transaksi,
            'fkeping' => $fkeping,
            'fgramasi' => $fgramasi,
            'jenisjasagtc' => $jenisjasagtc,
            'totalbuyback' => $totalbuyback,
            'hargaharian' => $hargaharian,
            'historikeping' => $historikeping,
        ];
        return response()->json($print);
    }

    public function caridatatransaksi($id)
    {
        $data = DB::table('gtc_transaksi')->where('id', $id)->get();
        return response()->json($data);
    }

    public function uploadbuktitrf(Request $request, $id)
    {
        if(!$_FILES["buktitrf_upload"]["error"] == 4) {
            File::delete('img/buktitrf_upload/'.$request->old_buktitrf_upload);
            $nameland=$request->file('buktitrf_upload')->getClientOriginalname();
            $lower_file_name=strtolower($nameland);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $finalname=time().'-'.$replace_space;
            $destination=public_path('img/buktitrf_upload');
            $request->file('buktitrf_upload')->move($destination,$finalname);
        }else{
            $finalname = $request->old_buktitrf_upload;
        }
        DB::table('gtc_transaksi')->where('id', $id)->update([
            'buktitrf_tgl' => $request->buktitrf_tgl,
            'buktitrf_nominal' => $request->buktitrf_nominal,
            'buktitrf_upload' => $finalname
        ]);
    }

    public function aprovalopr($id)
    {
        DB::table('gtc_transaksi')->where('id', $id)->update([
            'aproval_opr' => 'Y',
            'aproval_opr_tgl' => \Carbon\Carbon::now(),  # new \Datetime()
        ]);
    }

    public function aprovalkeu($id, $id_anggota)
    {
        $ceklastTransaksi = DB::table('gtc_transaksi')->where('sbte', '!=', '')->orderby('created_at', 'desc')->first();
        if(empty($ceklastTransaksi->sbte)){
            $lastTransaksi = '062.13.11000000-04';
        }else{
            $lastTransaksi = $ceklastTransaksi->sbte;
        }
        // dd($lastTransaksi);
        $sbte = $lastTransaksi;
        $kode = explode(".", $sbte);
        $kode2 = explode("-", $kode[2]);
        $kode3 = substr($kode2[0], -5);
        $kode3++;
        $kode4 = str_pad($kode3, 5, '0', STR_PAD_LEFT);
        // ==============
        $kodeperwada = "062";
        $kodedefault = "13";
        $carigender = DB::table("anggota")->where('id', '1')->first();
        $gender = $carigender->jenis_kelamin;
        if($gender == 'Laki-laki'){
            $kodegender = '12';
        }else if($gender == 'Perempuan'){
            $kodegender = '11';
        }
        $kodesistem = '0';
        $kodedefault2 = '04';
        $finalkode = $kodeperwada.'.'.$kodedefault.'.'.$kodegender.$kodesistem.$kode4.'-'.$kodedefault2;
        DB::table('gtc_transaksi')->where('id', $id)->update([
            'sbte' => $finalkode,
            'aproval_keu' => 'Y',
            'aproval_keu_tgl' => \Carbon\Carbon::now(),  # new \Datetime()
        ]);
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
