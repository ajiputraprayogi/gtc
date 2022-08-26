<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use DataTables;
use File;
use Auth;

class AktifgtcController extends Controller
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
        $perwada = Auth::user()->kantor;
        if($perwada !='1'){
            $data = DB::table('gtc_pengajuan')
            ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
            ->leftjoin('gtc_transaksi','gtc_transaksi.kode_pengajuan','=','gtc_pengajuan.kode_pengajuan')
            ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','gtc_pengajuan.created_at as created_atp',
            'anggota.*','anggota.id as ida',
            'gtc_transaksi.*','gtc_transaksi.id as idt','gtc_transaksi.tanggal_jatuh_tempo as tanggal_jatuh_tempot')
            ->groupby('gtc_transaksi.kode_pengajuan')
            ->where('gtc_pengajuan.status_akhir','Aktif')
            ->where('gtc_transaksi.status','Aktif')
            ->where('gtc_pengajuan.id_perwada', $perwada)
            ->orderby('gtc_pengajuan.created_at', 'asc')
            ->get();
            return view('backend.aktif_gtc.index', compact('data'));
        }else{
            $data = DB::table('gtc_pengajuan')
            ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
            ->leftjoin('gtc_transaksi','gtc_transaksi.kode_pengajuan','=','gtc_pengajuan.kode_pengajuan')
            ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','gtc_pengajuan.created_at as created_atp',
            'anggota.*','anggota.id as ida',
            'gtc_transaksi.*','gtc_transaksi.id as idt','gtc_transaksi.tanggal_jatuh_tempo as tanggal_jatuh_tempot')
            ->where('gtc_pengajuan.status_akhir','Aktif')
            ->where('gtc_transaksi.status','Aktif')
            ->groupby('gtc_transaksi.kode_pengajuan')
            ->orderby('gtc_pengajuan.created_at', 'asc')
            ->get();
            return view('backend.aktif_gtc.index', compact('data'));
        }
    }

    public function transaksi($id)
    {
        $kodepengajuan = DB::table('gtc_pengajuan')->where('id', $id)->first();
        $data = DB::table('gtc_transaksi')
        ->leftjoin('gtc_pengajuan', 'gtc_pengajuan.kode_pengajuan', 'gtc_transaksi.kode_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
        ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','anggota.*','anggota.id as ida','gtc_transaksi.*','gtc_transaksi.id as idt')
        ->where('gtc_transaksi.kode_pengajuan', $kodepengajuan->kode_pengajuan)
        ->where('gtc_transaksi.status', 'Aktif')
        ->get();
        // dd($data);

        $data2 =  DB::table('gtc_transaksi')
        ->leftjoin('gtc_pengajuan', 'gtc_pengajuan.kode_pengajuan', 'gtc_transaksi.kode_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
        ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','anggota.*','anggota.id as ida','gtc_transaksi.*','gtc_transaksi.id as idt')
        ->where('gtc_transaksi.kode_pengajuan', $kodepengajuan->kode_pengajuan)
        ->where('gtc_transaksi.status', 'Aktif')
        ->first();
        $tanggal = DB::table('gtc_histori_transaksi')->where('kode_transaksi', $data2->kode_transaksi)->first();
        $finaltanggal = date('Y-m-d H:i:s', strtotime('-1 seconds', strtotime( $tanggal->created_at )));
        $pembayaran_pinjaman = DB::table('gtc_histori_transaksi')
        ->whereBetween('created_at', array('0000-00-00 00:00:00', $finaltanggal))
        ->where('kode_pengajuan', $kodepengajuan->kode_pengajuan)
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
        
        return view('backend.aktif_gtc.transaksi', compact('data', 'sisapinjaman'));
    }

    public function transaksi2($id){
        $data = DB::table('gtc_transaksi')
        ->leftjoin('gtc_pengajuan', 'gtc_pengajuan.kode_pengajuan', 'gtc_transaksi.kode_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
        ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','anggota.*','anggota.id as ida','gtc_transaksi.*','gtc_transaksi.id as idt')
        ->where('gtc_transaksi.kode_pengajuan', $id)
        ->where('gtc_transaksi.status', 'Aktif')
        ->get();
        $data2 =  DB::table('gtc_transaksi')
        ->leftjoin('gtc_pengajuan', 'gtc_pengajuan.kode_pengajuan', 'gtc_transaksi.kode_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
        ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','anggota.*','anggota.id as ida','gtc_transaksi.*','gtc_transaksi.id as idt')
        ->where('gtc_transaksi.kode_pengajuan', $id)
        ->where('gtc_transaksi.status', 'Aktif')
        ->first();

        $tanggal = DB::table('gtc_histori_transaksi')->where('kode_transaksi', $data2->kode_transaksi)->first();
        $finaltanggal = date('Y-m-d H:i:s', strtotime('-1 seconds', strtotime( $tanggal->created_at )));
        $pembayaran_pinjaman = DB::table('gtc_histori_transaksi')
        ->whereBetween('created_at', array('0000-00-00 00:00:00', $finaltanggal))
        ->where('kode_pengajuan', $id)
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

        $emas = DB::table('gtc_emas')->where('kode_pengajuan', $row->kode_pengajuan)->get();
        $keping = 0;
        $no = 0;
        $pengajuantotalkeping = 0;
        $pengajuantotalgramasi = 0;
        $pengambilantotalkeping = 0;
        $pengambilantotalgramasi = 0;
        $sisatotalkeping = 0;
        $sisatotalgramasi = 0;
        foreach($emas as $row){
            $no++;
            $keping = DB::table('gtc_histori_transaksi')->where('kode_pengajuan', $id)->select(DB::raw('sum(keping) as total'))->groupby('id_emas')->get();

            $pengajuantotalkeping += $row->keping;
            $pengajuantotalgramasi += $row->gramasi;

            $pengambilantotalkeping += $keping[$no-1]->total;
            $pengambilan_a = $keping[$no-1]->total;
            $pengambilantotalgramasi += $pengambilan_a*$row->gramasi;

            $sisatotalkeping += $row->keping-$keping[$no-1]->total;
            $sisa_a = $row->keping-$keping[$no-1]->total;
            $sisatotalgramasi += $sisa_a*$row->gramasi;
        }
        $print = [
            'data' => $data,
            'sisapinjaman' => $sisapinjaman,
            'emas' => $emas,
            'keping' => $keping,
            'pengajuantotalkeping' => $pengajuantotalkeping,
            'pengajuantotalgramasi' => $pengajuantotalgramasi,
            'pengambilantotalkeping' => $pengambilantotalkeping,
            'pengambilantotalgramasi' => $pengambilantotalgramasi,
            'sisatotalkeping' => $sisatotalkeping,
            'sisatotalgramasi' => $sisatotalgramasi,
        ];
        return response()->json($print);
    }

    public function listtransaksi($id)
    {
        $transaksi = DB::table('gtc_transaksi')
        ->leftjoin('gtc_pengajuan', 'gtc_pengajuan.kode_pengajuan', 'gtc_transaksi.kode_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
        ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','anggota.*','anggota.id as ida','gtc_transaksi.*','gtc_transaksi.id as idt','gtc_transaksi.tanggal_jatuh_tempo as jatuh_tempo')
        ->where('gtc_transaksi.kode_pengajuan', $id)
        ->orderby('gtc_transaksi.kode_transaksi', 'desc')
        ->get();
        return Datatables::of($transaksi)->editColumn('jatuh_tempo', function($transaksi)
        {
            $tanggal = $transaksi->jatuh_tempo;
            $bulan = array (
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $pecahkandata = explode(' ', $tanggal);
            $pecahkantgl = explode('-', $pecahkandata[0]);
            $tglpengajuan = $pecahkantgl[2] . ' ' . $bulan[(int)$pecahkantgl[1]] . ' ' . $pecahkantgl[0];
            return $tglpengajuan;
        })->editColumn('tgl_sebelumnya', function($transaksi)
        {
            $tanggal = $transaksi->tanggal_sebelumnya;
            $bulan = array (
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $pecahkandata = explode(' ', $tanggal);
            $pecahkantgl = explode('-', $pecahkandata[0]);
            $tglpengajuan = $pecahkantgl[2] . ' ' . $bulan[(int)$pecahkantgl[1]] . ' ' . $pecahkantgl[0];
            return $tglpengajuan;
        })->make(true);
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
        $idperwada = 0;
        foreach($data as $row){
            $idperwada = $row->id_perwada;
        }
        $namaperwada = DB::table('perwada')->where('id', $idperwada)->first();

        $cekaproval = DB::table('gtc_transaksi')
        ->leftjoin('gtc_pengajuan', 'gtc_pengajuan.kode_pengajuan', 'gtc_transaksi.kode_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
        ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','anggota.*','anggota.id as ida','gtc_transaksi.*','gtc_transaksi.id as idt')
        ->where('gtc_transaksi.kode_pengajuan', $id)
        ->orderby('gtc_transaksi.created_at', 'desc')
        ->first();
        
        $print = [
            'data' => $data,
            'finalkodetransaksi' => $finalkodetransaksi,
            'nominalpinjaman' => $nominalpinjaman,
            'namaperwada' => $namaperwada,
            'cekaproval' => $cekaproval,
        ];
        return response()->json($print);
    }

    public function tambahtransaksi(Request $request){
        $kode = $request->tambah_kode_pengajuan;
        $pengajuan = DB::table('gtc_transaksi')->where('kode_pengajuan', $kode)->orderby('created_at', 'desc')->first();
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
        $id = [];
        $data = DB::table('gtc_transaksi')->where('kode_pengajuan', $kode)->get();
        if(count($data)>0){
            foreach($data as $row){
                array_push($id, $row->id);
            }
        }
        date_default_timezone_set('Asia/Jakarta');
        // tambah bulan ===========================
        $date = $pengajuan->tanggal_jatuh_tempo;
        $transaksi = DB::table('gtc_transaksi')->where('kode_pengajuan', $pengajuan->kode_pengajuan)->orderby('created_at','asc')->first();
        if($request->tambah_jangka_waktu_permohonan == 'Pilih'){
            $jatuhtempo = \Carbon\Carbon::now();
        }else{
            $months = $request->tambah_jangka_waktu_permohonan;
            foreach(explode(",", $months) as $month) {
                $hours = $month * 24 * 30;
                date_default_timezone_set('Asia/Jakarta');
                $jatuhtempo = date("Y-m-d H:i:s", strtotime("{$date} +{$hours} hours"));
            }
        }
        DB::table('gtc_transaksi')->whereIn('id', $id)->update([
            'status' => 'Non Aktif'
        ]);
        if($request->tambah_jenis_transaksi == 'Perpanjangan'){
            DB::table('gtc_transaksi')->insert([
                'kode_pengajuan' => $request->tambah_kode_pengajuan,
                'kode_transaksi' => $request->tambah_kode_transaksi,
                'jenis_transaksi' =>$request->tambah_jenis_transaksi,
                'id_jenis_jasa' => $request->tambah_id_jenis_jasa,
                'pilihan_jasa' => $request->tambah_pilihan_jasa,
                'perhitungan_jasa' => $request->tambah_perhitungan_jasa,
                'jangka_waktu_permohonan' => $request->tambah_jangka_waktu_permohonan,
                'jasa_gtc' => str_replace(".","",$request->tambah_jasa_gtc),
                'pembayaran_jasa' => $request->tambah_pembayaran_jasa,
                'upload_bukti_transfer' => $finalname,
                'jumlah_transfer' => str_replace(".","",$request->tambah_pembayaran),
                'status' => 'Aktif',
                'tanggal_sebelumnya' => $pengajuan->tanggal_jatuh_tempo,
                'tanggal_jatuh_tempo' => $jatuhtempo,
                'sisa_pembayaran' => str_replace(".","",$request->tambah_sisa_pembayaran),
                'catatan2' => $request->tambah_catatan,
                "created_at" => \Carbon\Carbon::now(),  # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                // default
                'pembayaran_jasa_manual' => $pengajuan->pembayaran_jasa_manual,
                'ket_simpwa' => $pengajuan->ket_simpwa,
                'nominal_potongan' => $pengajuan->nominal_potongan,
                'jumlah_yang_di_transfer' => $pengajuan->jumlah_yang_di_transfer,
                'tipe_transaksi' => $pengajuan->tipe_transaksi,
                'upload_foto_gold' => $pengajuan->upload_foto_gold,
                'upload_surat_terima_transfer' => $pengajuan->upload_surat_terima_transfer,
                'upload_form_pengajuan' => $pengajuan->upload_form_pengajuan,
                'surat_kuasa_penjualan_jaminan_marhum' => $pengajuan->surat_kuasa_penjualan_jaminan_marhum,
                'catatan' => $pengajuan->catatan,
                'tanda_tangan' => $pengajuan->tanda_tangan,
                'buktitrf_tgl' => $pengajuan->buktitrf_tgl,
                'buktitrf_nominal' => $pengajuan->buktitrf_nominal,
                'buktitrf_upload' => $pengajuan->buktitrf_upload,
            ]);
            $index = 0;
            foreach($request->id_emas as $id){
                $historitransaksi = DB::table('gtc_histori_transaksi')->insert([
                    'kode_pengajuan' => $request->tambah_kode_pengajuan,
                    'kode_transaksi' => $request->tambah_kode_transaksi,
                    'id_emas' => $request->id_emas[$index],
                    'keping' => "0",
                    'harga_buyback' => "0",
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
                'id_jenis_jasa' => $request->tambah_id_jenis_jasa,
                'pilihan_jasa' => $request->tambah_pilihan_jasa,
                'perhitungan_jasa' => $request->tambah_perhitungan_jasa,
                'jangka_waktu_permohonan' => $request->tambah_jangka_waktu_permohonan,
                'jasa_gtc' =>str_replace(".","",$request->tambah_jasa_gtc),
                'pembayaran_jasa' => $request->tambah_pembayaran_jasa,
                'upload_bukti_transfer' => $finalname,
                'jumlah_transfer' => $jumlahtransfer,
                'status' => 'Aktif',
                'tanggal_sebelumnya' => $pengajuan->tanggal_jatuh_tempo,
                'tanggal_jatuh_tempo' => $jatuhtempo,
                'sisa_pembayaran' => str_replace(".","",$request->tambah_sisa_pembayaran),
                'catatan2' => $request->tambah_catatan,
                "created_at" => \Carbon\Carbon::now(),  # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                // default
                'pembayaran_jasa_manual' => $pengajuan->pembayaran_jasa_manual,
                'ket_simpwa' => $pengajuan->ket_simpwa,
                'nominal_potongan' => $pengajuan->nominal_potongan,
                'jumlah_yang_di_transfer' => $pengajuan->jumlah_yang_di_transfer,
                'tipe_transaksi' => $pengajuan->tipe_transaksi,
                'upload_foto_gold' => $pengajuan->upload_foto_gold,
                'upload_surat_terima_transfer' => $pengajuan->upload_surat_terima_transfer,
                'upload_form_pengajuan' => $pengajuan->upload_form_pengajuan,
                'surat_kuasa_penjualan_jaminan_marhum' => $pengajuan->surat_kuasa_penjualan_jaminan_marhum,
                'catatan' => $pengajuan->catatan,
                'tanda_tangan' => $pengajuan->tanda_tangan,
                'buktitrf_tgl' => $pengajuan->buktitrf_tgl,
                'buktitrf_nominal' => $pengajuan->buktitrf_nominal,
                'buktitrf_upload' => $pengajuan->buktitrf_upload,
            ]);
            $index = 0;
            foreach($request->id_emas as $id){
                $historitransaksi = DB::table('gtc_histori_transaksi')->insert([
                    'kode_pengajuan' => $request->tambah_kode_pengajuan,
                    'kode_transaksi' => $request->tambah_kode_transaksi,
                    'id_emas' => $request->id_emas[$index],
                    'keping' => $request->pengurangan[$index],
                    'harga_buyback' => $request->hargabuyback[$index],
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
                'id_jenis_jasa' => $request->tambah_id_jenis_jasa,
                'pilihan_jasa' => $request->tambah_pilihan_jasa,
                'perhitungan_jasa' => $request->tambah_perhitungan_jasa,
                'jangka_waktu_permohonan' => '0',
                'jasa_gtc' => '0',
                'pembayaran_jasa' => $request->tambah_pembayaran_jasa,
                'upload_bukti_transfer' => $finalname,
                'jumlah_transfer' => '0',
                'status' => 'Aktif',
                'tanggal_sebelumnya' => $pengajuan->tanggal_jatuh_tempo,
                'tanggal_jatuh_tempo' => \Carbon\Carbon::now(),
                'sisa_pembayaran' => str_replace(".","",$request->tambah_sisa_pembayaran),
                'catatan2' => $request->tambah_catatan,
                "created_at" => \Carbon\Carbon::now(),  # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                // default
                'pembayaran_jasa_manual' => $pengajuan->pembayaran_jasa_manual,
                'ket_simpwa' => $pengajuan->ket_simpwa,
                'nominal_potongan' => $pengajuan->nominal_potongan,
                'jumlah_yang_di_transfer' => $pengajuan->jumlah_yang_di_transfer,
                'tipe_transaksi' => $pengajuan->tipe_transaksi,
                'upload_foto_gold' => $pengajuan->upload_foto_gold,
                'upload_surat_terima_transfer' => $pengajuan->upload_surat_terima_transfer,
                'upload_form_pengajuan' => $pengajuan->upload_form_pengajuan,
                'surat_kuasa_penjualan_jaminan_marhum' => $pengajuan->surat_kuasa_penjualan_jaminan_marhum,
                'catatan' => $pengajuan->catatan,
                'tanda_tangan' => $pengajuan->tanda_tangan,
                'buktitrf_tgl' => $pengajuan->buktitrf_tgl,
                'buktitrf_nominal' => $pengajuan->buktitrf_nominal,
                'buktitrf_upload' => $pengajuan->buktitrf_upload,
            ]);
            $index = 0;
            foreach($request->id_emas as $id){
                $historitransaksi = DB::table('gtc_histori_transaksi')->insert([
                    'kode_pengajuan' => $request->tambah_kode_pengajuan,
                    'kode_transaksi' => $request->tambah_kode_transaksi,
                    'id_emas' => $request->id_emas[$index],
                    'keping' => $request->pengurangan[$index],
                    'harga_buyback' => $request->hargabuyback[$index],
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
        date_default_timezone_set('Asia/Jakarta');
        // tambah bulan ===========================
        $date = $data->tanggal_sebelumnya;
        $months = $request->edit_jangka_waktu_permohonan;
        foreach(explode(",", $months) as $month) {
            $hours = $month * 24 * 30;
            date_default_timezone_set('Asia/Jakarta');
            $jatuhtempo = date("Y-m-d H:i:s", strtotime("{$date} +{$hours} hours"));
        }
        if($request->edit_jenis_transaksi == 'Perpanjangan'){
            DB::table('gtc_transaksi')->where('id', $id)->update([
                'jenis_transaksi' =>$request->edit_jenis_transaksi,
                'id_jenis_jasa' => $request->edit_id_jenis_jasa,
                'pilihan_jasa' => $request->edit_pilihan_jasa,
                'perhitungan_jasa' => $request->edit_perhitungan_jasa,
                'jangka_waktu_permohonan' => $request->edit_jangka_waktu_permohonan,
                'jasa_gtc' => str_replace(".","",$request->edit_jasa_gtc),
                'pembayaran_jasa' => $request->edit_pembayaran_jasa,
                'upload_bukti_transfer' => $finalname,
                'jumlah_transfer' => str_replace(".","",$request->edit_pembayaran),
                'tanggal_jatuh_tempo' => $jatuhtempo,
                'sisa_pembayaran' => str_replace(".","",$request->edit_sisa_pembayaran),
                'catatan2' => $request->edit_catatan,
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
                'id_jenis_jasa' => $request->edit_id_jenis_jasa,
                'pilihan_jasa' => $request->edit_pilihan_jasa,
                'perhitungan_jasa' => $request->edit_perhitungan_jasa,
                'jangka_waktu_permohonan' => $request->edit_jangka_waktu_permohonan,
                'jasa_gtc' =>str_replace(".","",$request->edit_jasa_gtc),
                'pembayaran_jasa' => $request->edit_pembayaran_jasa,
                'upload_bukti_transfer' => $finalname,
                'jumlah_transfer' => $jumlahtransfer,
                'sisa_pembayaran' => str_replace(".","",$request->edit_sisa_pembayaran),
                'catatan2' => $request->edit_catatan,
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
                'id_jenis_jasa' => $request->edit_id_jenis_jasa,
                'pilihan_jasa' => $request->edit_pilihan_jasa,
                'perhitungan_jasa' => $request->edit_perhitungan_jasa,
                'jangka_waktu_permohonan' => '0',
                'jasa_gtc' => '0',
                'pembayaran_jasa' => '',
                'upload_bukti_transfer' => $finalname,
                'jumlah_transfer' => '0',
                'sisa_pembayaran' => str_replace(".","",$request->edit_sisa_pembayaran),
                'catatan2' => $request->edit_catatan,
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
        $finaltanggal = date('Y-m-d H:i:s', strtotime('-1 seconds', strtotime( $tanggal->created_at )));
        $pembayaran_pinjaman = DB::table('gtc_histori_transaksi')
        ->whereBetween('created_at', array('0000-00-00 00:00:00', $finaltanggal))
        ->where('kode_pengajuan', $kode2)
        ->groupby('kode_transaksi')->get();

        $pengajuan = 0;
        foreach($data as $row){
            $pengajuan = (int) $row->pengajuan;
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

        foreach($data as $row){
            $idperwada = $row->id_perwada;
        }
        $namaperwada = DB::table('perwada')->where('id', $idperwada)->first();

        $print = [
            'data' => $data,
            'nominalpinjaman' => $nominalpinjaman,
            'fpembayaran_pinjaman' => $fpembayaran_pinjaman,
            'fpembayaran_pinjaman2' => $fpembayaran_pinjaman2,
            'sisapinjaman' => $sisapinjaman,
            'namaperwada' => $namaperwada,
        ];
        return response()->json($print);
    }

    public function listemasgtc($kode)
    {
        $data = DB::table('gtc_emas')->where('kode_pengajuan', $kode)->get();
        $transaksi = DB::table('gtc_histori_transaksi')->select(DB::raw('sum(keping) as total'))->where('kode_pengajuan', $kode)->groupby('id_emas')->get();
        $idjenisjasa = DB::table('gtc_pengajuan')->leftjoin('gtc_transaksi','gtc_transaksi.kode_pengajuan','=','gtc_pengajuan.kode_pengajuan')->where('gtc_transaksi.kode_pengajuan', $kode)->first();
        $jenisjasagtc = DB::table('gtc_jenis_jasa')->where('id', $idjenisjasa->id_jenis_jasa)->get();
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
        $finaltanggal = date('Y-m-d H:i:s', strtotime('-1 seconds', strtotime( $tanggal->created_at )));
        $transaksi = DB::table('gtc_histori_transaksi')
        ->select(DB::raw('sum(keping) as total'))
        ->whereBetween('created_at', array('0000-00-00 00:00:00', $finaltanggal))
        ->where('kode_pengajuan', $kode)
        ->groupby('id_emas')
        ->get();
        $idjenisjasa = DB::table('gtc_pengajuan')->leftjoin('gtc_transaksi','gtc_transaksi.kode_pengajuan','=','gtc_pengajuan.kode_pengajuan')->where('gtc_transaksi.kode_pengajuan', $kode)->first();
        $jenisjasagtc = DB::table('gtc_jenis_jasa')->where('id', $idjenisjasa->id_jenis_jasa)->get();
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
        $finaltanggal = date('Y-m-d H:i:s', strtotime('-1 seconds', strtotime( $tanggal->created_at )));
        $transaksi = DB::table('gtc_histori_transaksi')
        ->select(DB::raw('sum(keping) as total'))
        ->whereBetween('created_at', array('0000-00-00 00:00:00', $finaltanggal))
        ->where('kode_pengajuan', $kode)
        ->groupby('id_emas')
        ->get();
        $historitransaksi = DB::table('gtc_histori_transaksi')->where('kode_transaksi', $kode2)->get();
        $idjenisjasa = DB::table('gtc_pengajuan')->leftjoin('gtc_transaksi','gtc_transaksi.kode_pengajuan','=','gtc_pengajuan.kode_pengajuan')->where('gtc_transaksi.kode_pengajuan', $kode)->first();
        $jenisjasagtc = DB::table('gtc_jenis_jasa')->where('id', $idjenisjasa->id_jenis_jasa)->get();
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
            'historitransaksi' => $historitransaksi,
        ];
        return response()->json($print);
    }

    public function caridatatransaksi($id)
    {
        $data = DB::table('gtc_transaksi')->where('id', $id)->get();
        $data2 = DB::table('gtc_transaksi')->where('id', $id)->first();
        $kodepengajuan = $data2->kode_pengajuan;
        $tanggal = $data2->created_at;
        $finaltanggal = date('Y-m-d H:i:s', strtotime('-1 seconds', strtotime( $tanggal )));
        $cekaproval = DB::table('gtc_transaksi')
        ->leftjoin('gtc_pengajuan', 'gtc_pengajuan.kode_pengajuan', 'gtc_transaksi.kode_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
        ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','anggota.*','anggota.id as ida','gtc_transaksi.*','gtc_transaksi.id as idt')
        ->where('gtc_transaksi.kode_pengajuan', $kodepengajuan)
        ->whereBetween('gtc_transaksi.created_at', array('0000-00-00 00:00:00', $finaltanggal))
        ->orderby('gtc_transaksi.created_at', 'desc')
        ->first();

        $print = [
            'data' => $data,
            'cekaproval' => $cekaproval,
        ];
        return response()->json($print);
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
        $ceklastTransaksi = DB::table('gtc_transaksi')->where('sbte', '!=', '')->orderby('aproval_keu_tgl', 'desc')->first();
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
        $transaksi = DB::table('gtc_transaksi')->where('id', $id)->first();
        $pengajuan = DB::table('gtc_pengajuan')->where('kode_pengajuan', $transaksi->kode_pengajuan)->first();
        $perwada = DB::table('perwada')->where('id', $pengajuan->id_perwada)->first();
        $kodeperwada = $perwada->kode;
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

    public function printtransaksi($kode, $kode2){
        $data = DB::table('gtc_transaksi')
        ->leftjoin('gtc_pengajuan', 'gtc_pengajuan.kode_pengajuan', 'gtc_transaksi.kode_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
        ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','anggota.*','anggota.id as ida','gtc_transaksi.*','gtc_transaksi.id as idt')
        ->where('gtc_transaksi.id', $kode)
        ->orderby('gtc_transaksi.kode_pengajuan', 'desc')
        ->get();
        $data2 = DB::table('gtc_transaksi')->where('id', $kode)->first();
        $tanggal = DB::table('gtc_histori_transaksi')->where('kode_transaksi', $data2->kode_transaksi)->first();
        $finaltanggal = date('Y-m-d H:i:s', strtotime('-1 seconds', strtotime( $tanggal->created_at )));
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

        $emas = DB::table('gtc_emas')->where('kode_pengajuan', $kode2)->get();
        // =============
        $kd = DB::table('gtc_transaksi')->where('id', $kode)->first();
        // =============
        $tanggal = DB::table('gtc_histori_transaksi')->where('kode_transaksi', $kd->kode_transaksi)->first();
        $finaltanggal = date('Y-m-d H:i:s', strtotime('-1 seconds', strtotime( $tanggal->created_at )));
        $transaksi = DB::table('gtc_histori_transaksi')
        ->select(DB::raw('sum(keping) as total'))
        ->whereBetween('created_at', array('0000-00-00 00:00:00', $finaltanggal))
        ->where('kode_pengajuan', $kode2)
        ->groupby('id_emas')
        ->get();
        $idjenisjasa = DB::table('gtc_pengajuan')->leftjoin('gtc_transaksi','gtc_transaksi.kode_pengajuan','=','gtc_pengajuan.kode_pengajuan')->where('gtc_transaksi.kode_pengajuan', $kode2)->first();
        $jenisjasagtc = DB::table('gtc_jenis_jasa')->where('id', $idjenisjasa->id_jenis_jasa)->get();
        $totalkeping = DB::table('gtc_emas')->where('kode_pengajuan', $kode2)->sum('keping');
        $tkeping = 0;
        foreach($transaksi as $row){
            $tkeping += $row->total;
        }
        $fkeping = $totalkeping-$tkeping;
        $gramasi = DB::table('gtc_emas')->where('kode_pengajuan', $kode2)->get();
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
        if(count($emas)>0){
            $i = 0;
            foreach($emas as $row){
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

        $historikeping = DB::table('gtc_histori_transaksi')->where('kode_transaksi', $kd->kode_transaksi)->get();
        // dd($historikeping);

        return view('backend.aktif_gtc.print', compact('data','nominalpinjaman','fpembayaran_pinjaman','fpembayaran_pinjaman2','sisapinjaman','emas','transaksi','historikeping','fkeping','fgramasi','hargaharian'));
    }

    public function jasadiakhirtransaksi($kode, $kode2){
        $data = DB::table('gtc_transaksi')
        ->leftjoin('gtc_pengajuan', 'gtc_pengajuan.kode_pengajuan', 'gtc_transaksi.kode_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
        ->leftjoin('gtc_emas','gtc_emas.kode_pengajuan','=','gtc_transaksi.kode_pengajuan')
        ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','anggota.*','anggota.id as ida','gtc_transaksi.*','gtc_transaksi.id as idt',DB::raw('SUM(gtc_emas.gramasi*keping)as total_gramasi'))
        ->where('gtc_transaksi.id', $kode)
        ->orderby('gtc_transaksi.kode_pengajuan', 'desc')
        ->get();
        // dd($data);
        $idjenisjasa = DB::table('gtc_pengajuan')->leftjoin('gtc_transaksi','gtc_transaksi.kode_pengajuan','=','gtc_pengajuan.kode_pengajuan')->where('gtc_transaksi.kode_pengajuan', $kode)->first();
        $jenisjasagtc = DB::table('gtc_jenis_jasa')->where('id', $idjenisjasa->id_jenis_jasa)->get();
        $emas = DB::table('gtc_emas')->where('kode_pengajuan', $kode2)->get();
        $hargaharian = DB::table('gtc_harga_harian')->where('status', 'Active')->first();
        $totalbuyback = 0;
        if(count($emas)>0){
            $i = 0;
            foreach($emas as $row){
                $i += 1;
                if($row->gramasi == '0.1'){
                    $totalbuyback += $hargaharian->nolsatu_gram*$row->keping;
                }else if($row->gramasi == '0.2'){
                    $totalbuyback += $hargaharian->noldua_gram*$row->keping;
                }else if($row->gramasi == '0.5'){
                    $totalbuyback += $hargaharian->nollima_gram*$row->keping;
                }else if($row->gramasi == '1'){
                    $totalbuyback += $hargaharian->satu_gram*$row->keping;
                }else if($row->gramasi == '2'){
                    $totalbuyback += $hargaharian->dua_gram*$row->keping;
                }else if($row->gramasi == '5'){
                    $totalbuyback += $hargaharian->lima_gram*$row->keping;
                }else if($row->gramasi == '10'){
                    $totalbuyback += $hargaharian->sepuluh_gram*$row->keping;
                }
            }
        }

        foreach($data as $row){
            $idperwada = $row->id_perwada;
        }
        $namaperwada = DB::table('perwada')->where('id', $idperwada)->first();

        $print = [
            'data' => $data,
            'jenisjasagtc' => $jenisjasagtc,
            'totalbuyback' => $totalbuyback,
            'namaperwada' => $namaperwada,
        ];
        return response()->json($print);
    }

    public function simpanjasadiakhirtransaksi(Request $request, $id){
        if(!$_FILES["jasadiakhir_upload_bukti_transfer"]["error"] == 4) {
            File::delete('img/bukti_transfer/'.$request->old_jasadiakhir_upload_bukti_transfer);
            $nameland=$request->file('jasadiakhir_upload_bukti_transfer')->getClientOriginalname();
            $lower_file_name=strtolower($nameland);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $finalname=time().'-'.$replace_space;
            $destination=public_path('img/bukti_transfer');
            $request->file('jasadiakhir_upload_bukti_transfer')->move($destination,$finalname);
        }else{
            $finalname = $request->old_jasadiakhir_upload_bukti_transfer;
        }
        DB::table('gtc_transaksi')->where('id', $id)->update([
            'jangka_waktu_permohonan' => $request->jasadiakhir_jangka_waktu_permohonan,
            'jasa_gtc' => str_replace(".","",$request->jasadiakhir_jasa_gtc),
            'pembayaran_jasa' => $request->jasadiakhir_pembayaran_jasa,
            'upload_bukti_transfer' => $finalname,
            'jumlah_transfer' => str_replace(".","",$request->jasadiakhir_pembayaran),
            "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
        ]);
    }

    public function cekpelunasangtc($id)
    {
        $data = DB::table('gtc_pengajuan')->where('id', $id)->first();
        $transaksi = DB::table('gtc_transaksi')->where('kode_pengajuan', $data->kode_pengajuan)->where('jenis_transaksi', 'Pelunasan')->get();
        $pelunasan = 0;
        if(count($transaksi)>0){
            foreach($transaksi as $row){
                $pelunasan = $row->id;
            }
        }
        $print = [
            'pelunasan' => $pelunasan,
        ];
        return response()->json($print);
    }

    public function pelunasangtc($id)
    {
        DB::table('gtc_pengajuan')->where('id', $id)->update([
            'status_akhir' => 'Lunas'
        ]);
    }

    public function cetaksbte($kode, $kode2)
    {
        $data = DB::table('gtc_transaksi')
        ->leftjoin('gtc_pengajuan', 'gtc_pengajuan.kode_pengajuan', 'gtc_transaksi.kode_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
        ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','anggota.*','anggota.id as ida','gtc_transaksi.*','gtc_transaksi.id as idt')
        ->where('gtc_transaksi.id', $kode)
        ->orderby('gtc_transaksi.kode_pengajuan', 'desc')
        ->get();
        $data2 = DB::table('gtc_transaksi')->where('id', $kode)->first();
        $tanggal = DB::table('gtc_histori_transaksi')->where('kode_transaksi', $data2->kode_transaksi)->first();
        $finaltanggal = date('Y-m-d H:i:s', strtotime('-1 seconds', strtotime( $tanggal->created_at )));
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

        $emas = DB::table('gtc_emas')->where('kode_pengajuan', $kode2)->get();
        // =============
        $kd = DB::table('gtc_transaksi')->where('id', $kode)->first();
        // =============
        $tanggal = DB::table('gtc_histori_transaksi')->where('kode_transaksi', $kd->kode_transaksi)->first();
        $finaltanggal = date('Y-m-d H:i:s', strtotime('-1 seconds', strtotime( $tanggal->created_at )));
        $transaksi = DB::table('gtc_histori_transaksi')
        ->select(DB::raw('sum(keping) as total'))
        ->whereBetween('created_at', array('0000-00-00 00:00:00', $finaltanggal))
        ->where('kode_pengajuan', $kode2)
        ->groupby('id_emas')
        ->get();
        $idjenisjasa = DB::table('gtc_pengajuan')->leftjoin('gtc_transaksi','gtc_transaksi.kode_pengajuan','=','gtc_pengajuan.kode_pengajuan')->where('gtc_transaksi.kode_pengajuan', $kode)->first();
        $jenisjasagtc = DB::table('gtc_jenis_jasa')->where('id', $idjenisjasa->id_jenis_jasa)->get();
        $totalkeping = DB::table('gtc_emas')->where('kode_pengajuan', $kode2)->sum('keping');
        $tkeping = 0;
        foreach($transaksi as $row){
            $tkeping += $row->total;
        }
        $fkeping = $totalkeping-$tkeping;
        $gramasi = DB::table('gtc_emas')->where('kode_pengajuan', $kode2)->get();
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
        if(count($emas)>0){
            $i = 0;
            foreach($emas as $row){
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

        $historikeping = DB::table('gtc_histori_transaksi')->where('kode_transaksi', $kd->kode_transaksi)->get();

        return view('backend.aktif_gtc.sbte', compact('data','nominalpinjaman','fpembayaran_pinjaman','fpembayaran_pinjaman2','sisapinjaman','emas','transaksi','historikeping','fkeping','fgramasi','hargaharian'));
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
