<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use File;
use Auth;

class PengajuangtcController extends Controller
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
            ->leftjoin('gtc_emas','gtc_emas.kode_pengajuan','=','gtc_pengajuan.kode_pengajuan')
            ->select('gtc_pengajuan.*','anggota.nomor_ba','anggota.nama_lengkap',DB::raw('SUM(gtc_emas.gramasi*keping)as total_gramasi'),DB::raw('SUM(gtc_emas.harga_buyback*keping)as total_buyback'))
            ->where('gtc_pengajuan.id_perwada',$perwada)
            ->groupby('gtc_pengajuan.id')
            ->orderby('gtc_pengajuan.created_at', 'asc')
            ->get();
            return view('backend.pengajuan_gtc.index', compact('data'));
        }else{
            $data = DB::table('gtc_pengajuan')
            ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
            ->leftjoin('gtc_emas','gtc_emas.kode_pengajuan','=','gtc_pengajuan.kode_pengajuan')
            ->select('gtc_pengajuan.*','anggota.nomor_ba','anggota.nama_lengkap',DB::raw('SUM(gtc_emas.gramasi*keping)as total_gramasi'),DB::raw('SUM(gtc_emas.harga_buyback*keping)as total_buyback'))
            ->groupby('gtc_pengajuan.id')
            ->orderby('gtc_pengajuan.created_at', 'asc')
            ->get();
            return view('backend.pengajuan_gtc.index', compact('data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function aprovalbmpengajuangtc($id)
    {
        $data = DB::table('gtc_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
        ->leftjoin('gtc_transaksi','gtc_transaksi.kode_transaksi','=','gtc_pengajuan.kode_transaksi')
        ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','anggota.*','anggota.id as ida','gtc_transaksi.*','gtc_transaksi.id as idt')
        ->where('gtc_pengajuan.id', $id)
        ->get();
        $emas_syirkah = DB::table('item_emas_syirkah')->get();
        $hargaharian = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
        $emas_gtc = DB::table('gtc_emas')->get();
        return view('backend.pengajuan_gtc.aproval-bm-pengajuan-gtc', compact('data','emas_syirkah','hargaharian','emas_gtc'));
    }

    public function editaprovalbmpengajuangtc(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('d');
        $bulan = date('n');
        $tahun = date('Y');
        $jam = date('H:i');
        $bulan_indonesia = array (1 =>   'Januari',
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
        $angkabulan = $bulan;
        $namabulan = $bulan_indonesia[$angkabulan];
        $tanggalaprovalbm = $tgl.' '.$namabulan.' '.$tahun.' '.$jam;
        DB::table('gtc_pengajuan')->where('id', $id)->update([
            'aproval_bm' => $request->status,
            'catatan_bm' => $request->catatan,
            "tgl_aproval_bm" => \Carbon\Carbon::now(),
        ]);
    }

    public function aprovaloprpengajuangtc($id)
    {
        $data = DB::table('gtc_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
        ->leftjoin('gtc_transaksi','gtc_transaksi.kode_transaksi','=','gtc_pengajuan.kode_transaksi')
        ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','anggota.*','anggota.id as ida','gtc_transaksi.*','gtc_transaksi.id as idt')
        ->where('gtc_pengajuan.id', $id)
        ->get();
        $emas_syirkah = DB::table('item_emas_syirkah')->get();
        $hargaharian = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
        $emas_gtc = DB::table('gtc_emas')->get();
        return view('backend.pengajuan_gtc.aproval-opr-pengajuan-gtc', compact('data','emas_syirkah','hargaharian','emas_gtc'));
    }

    public function editaprovaloprpengajuangtc(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('d');
        $bulan = date('n');
        $tahun = date('Y');
        $jam = date('H:i');
        $bulan_indonesia = array (1 =>   'Januari',
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
        $angkabulan = $bulan;
        $namabulan = $bulan_indonesia[$angkabulan];
        $tanggalaprovalopr = $tgl.' '.$namabulan.' '.$tahun.' '.$jam;
        DB::table('gtc_pengajuan')->where('id', $id)->update([
            'aproval_opr' => $request->status,
            'catatan_opr' => $request->catatan,
            "tgl_aproval_opr" => \Carbon\Carbon::now(),
        ]);
    }

    public function aprovalkeupengajuangtc($id)
    {
        $data = DB::table('gtc_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
        ->leftjoin('gtc_transaksi','gtc_transaksi.kode_transaksi','=','gtc_pengajuan.kode_transaksi')
        ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','anggota.*','anggota.id as ida','gtc_transaksi.*','gtc_transaksi.id as idt')
        ->where('gtc_pengajuan.id', $id)
        ->get();
        $emas_syirkah = DB::table('item_emas_syirkah')->get();
        $hargaharian = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
        $emas_gtc = DB::table('gtc_emas')->get();
        return view('backend.pengajuan_gtc.aproval-keu-pengajuan-gtc', compact('data','emas_syirkah','hargaharian','emas_gtc'));
    }

    public function editaprovalkeupengajuangtc(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        // tambah bulan ===========================
        $now = date("Y-m-d H:i:s");
        $date = $now;
        $pengajuan = DB::table('gtc_pengajuan')->where('id', $id)->first();
        $transaksi = DB::table('gtc_transaksi')->where('kode_pengajuan', $pengajuan->kode_pengajuan)->orderby('created_at','asc')->first();
        $months = $transaksi->jangka_waktu_permohonan;
        foreach(explode(",", $months) as $month) {
            $hours = $month * 24 * 30;
            date_default_timezone_set('Asia/Jakarta');
            $jatuhtempo = date("Y-m-d H:i:s", strtotime("{$date} +{$hours} hours"));
        }
        // ========================================
        if($request->status == 'Disetujui'){
            DB::table('gtc_pengajuan')->where('id', $id)->update([
                'aproval_keu' => $request->status,
                'catatan_keu' => $request->catatan,
                'status_akhir' => 'Aktif',
                'tgl_aproval_keu' => \Carbon\Carbon::now(),
                'tanggal_jatuh_tempo' => $jatuhtempo,
            ]);
            DB::table('gtc_transaksi')->where('kode_pengajuan', $pengajuan->kode_pengajuan)->update([
                'tanggal_sebelumnya' => \Carbon\Carbon::now(),
                'tanggal_jatuh_tempo' => $jatuhtempo,
            ]);
        }else{
            DB::table('gtc_pengajuan')->where('id', $id)->update([
                'aproval_keu' => $request->status,
                'catatan_keu' => $request->catatan,
                "tgl_aproval_keu" => \Carbon\Carbon::now(),
            ]);
        }
    }

    public function tambahpengajuangtc()
    {
        $data = DB::table('item_emas_syirkah')->orderby('id','desc')->get();
        $emas_syirkah = DB::table('item_emas_syirkah')->orderby('id', 'desc')->first();
        $hargaharian = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
        $emas_gtc = DB::table('gtc_emas')->get();
        // dd($hargaharian);
        return view('backend.pengajuan_gtc.tambah-pengajuan-gtc', compact('data','hargaharian','emas_gtc','emas_syirkah'));
    }

    public function carinomorba($id)
    {
            $data = DB::table('anggota')
                    ->where('nomor_ba','like','%'.$id.'%')
                    ->get();
            $jenisjasagtc = DB::table('gtc_jenis_jasa')
                            ->where('status', 'Active')
                            ->get();
            // ============================== ambil no ba
            $ambilnoba = DB::table('anggota')->where('nomor_ba', $id)->select('nomor_ba')->get();
            foreach($ambilnoba as $row){
                $ba = $row->nomor_ba;
            }
            // ============================== kode pengajuan
            $a = "A.";
            $kode = $a.substr($ba,-7);
            $pengajuan = DB::table('gtc_pengajuan')
            ->where('kode_pengajuan','like','%'.$kode.'%')
            ->orderby('created_at', 'desc')
            ->first();
            if(!$pengajuan){
                $carikode = '0';
            }else{
                $carikode = $pengajuan->kode_pengajuan;
            }
            if($carikode == '0'){
                $finalkode = $kode.'.1';
            }else{
                $getnumber = explode('.', $carikode);
                $jumlah = count($getnumber);
                $newno = $getnumber[$jumlah-1]+1;
                $finalkode = $kode.'.'.$newno;
            }
            $print = [
                'anggota'=>$data,
                'jenisjasagtc'=>$jenisjasagtc,
                'finalkode'=>$finalkode,
            ];
            return response()->json($print);
    }

    public function carinomorbahasil($id)
    {
        $data = DB::table('anggota')
        ->where('id', $id)
        ->get();
        // ============================== ambil no ba
        $ambilnoba = DB::table('anggota')->where('id', $id)->select('nomor_ba')->first();
        // ============================== kode pengajuan
        $a = "A.";
        $kode = $a.substr($ambilnoba->nomor_ba,-7);
        $carikode = DB::table('gtc_pengajuan')
        ->where('kode_pengajuan','like','%'.$kode.'%')
        ->max('kode_pengajuan');
        if(!$carikode){
            $finalkode = $kode.'.1';
        }else{
            $getnumber = explode('.', $carikode);
            $jumlah = count($getnumber);
            $newno = $getnumber[$jumlah-1]+1;
            $finalkode = $kode.'.'.$newno;
        }
        $print = [
            'anggota'=>$data,
            'finalkode'=>$finalkode,
        ];
        return response()->json($print);
    }

    public function carikodepengajuanhasil($kodetransaksi)
    {
        // ============================== kode transaksi
        $carikodetransaksi = DB::table('gtc_transaksi')
        ->where('kode_transaksi','like','%'.$kodetransaksi.'%')
        ->max('kode_transaksi');
        if(!$carikodetransaksi){
            $finalkodetransaksi = $kodetransaksi.'.1';
        }else{
            $getnumbertransaksi = explode('.', $carikodetransaksi);
            $jumlahtransaksi = count($getnumbertransaksi);
            $newnotransaksi = $getnumbertransaksi[$jumlahtransaksi-1]+1;
            $finalkodetransaksi = $kodetransaksi.'.'.$newnotransaksi;
        }
        // ==============================
        $print = [
            'finalkodetransaksi' => $finalkodetransaksi
        ];
        return response()->json($print);
    }

    public function listemasgtc($kode)
    {
        $data = DB::table('gtc_emas')->where('kode_pengajuan', $kode)->get();
        $hargaharian = DB::table('gtc_harga_harian')->where('status', 'Active')->first();
        $print = [
            'emas' => $data,
            'hargaharian' => $hargaharian
        ];
        return response()->json($print);
    }

    public function addemasgtc(Request $request)
    {
        $request->validate([
            'kode_pengajuan_emasgtc' => 'required',
            'item_emas' => 'required',
            'jenis' => 'required',
            'gramasi' => 'required',
            'harga_buyback' => 'required',
        ]);
        $emas_syirkah = $request->harga_buyback;
        $emas = DB::table('item_emas_syirkah')->where('id' , $emas_syirkah)->get();
        foreach($emas as $row){
            $gramasi = $row->gramasi;
            if($gramasi == '0.1'){
                $ambil_gramasi = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
                foreach($ambil_gramasi as $item){
                    $hasil_gramasi = $item->nolsatu_gram;
                    DB::table('gtc_emas')->insert([
                        'kode_pengajuan' => $request->kode_pengajuan_emasgtc,
                        'item_emas' => $request->item_emas,
                        'jenis' => $request->jenis,
                        'gramasi' => $request->gramasi,
                        'harga_buyback' => $hasil_gramasi,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                }
            }elseif($gramasi == '0.2'){
                $ambil_gramasi = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
                foreach($ambil_gramasi as $item){
                    $hasil_gramasi = $item->noldua_gram;
                    DB::table('gtc_emas')->insert([
                        'kode_pengajuan' => $request->kode_pengajuan_emasgtc,
                        'item_emas' => $request->item_emas,
                        'jenis' => $request->jenis,
                        'gramasi' => $request->gramasi,
                        'harga_buyback' => $hasil_gramasi,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                }
            }elseif($gramasi == '0.5'){
                $ambil_gramasi = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
                foreach($ambil_gramasi as $item){
                    $hasil_gramasi = $item->nollima_gram;
                    DB::table('gtc_emas')->insert([
                        'kode_pengajuan' => $request->kode_pengajuan_emasgtc,
                        'item_emas' => $request->item_emas,
                        'jenis' => $request->jenis,
                        'gramasi' => $request->gramasi,
                        'harga_buyback' => $hasil_gramasi,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                }
            }elseif($gramasi == '1'){
                $ambil_gramasi = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
                foreach($ambil_gramasi as $item){
                    $hasil_gramasi = $item->satu_gram;
                    DB::table('gtc_emas')->insert([
                        'kode_pengajuan' => $request->kode_pengajuan_emasgtc,
                        'item_emas' => $request->item_emas,
                        'jenis' => $request->jenis,
                        'gramasi' => $request->gramasi,
                        'harga_buyback' => $hasil_gramasi,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                }
            }elseif($gramasi == '2'){
                $ambil_gramasi = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
                foreach($ambil_gramasi as $item){
                    $hasil_gramasi = $item->dua_gram;
                    DB::table('gtc_emas')->insert([
                        'kode_pengajuan' => $request->kode_pengajuan_emasgtc,
                        'item_emas' => $request->item_emas,
                        'jenis' => $request->jenis,
                        'gramasi' => $request->gramasi,
                        'harga_buyback' => $hasil_gramasi,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                }
            }elseif($gramasi == '5'){
                $ambil_gramasi = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
                foreach($ambil_gramasi as $item){
                    $hasil_gramasi = $item->lima_gram;
                    DB::table('gtc_emas')->insert([
                        'kode_pengajuan' => $request->kode_pengajuan_emasgtc,
                        'item_emas' => $request->item_emas,
                        'jenis' => $request->jenis,
                        'gramasi' => $request->gramasi,
                        'harga_buyback' => $hasil_gramasi,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                }
            }elseif($gramasi == '10'){
                $ambil_gramasi = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
                foreach($ambil_gramasi as $item){
                    $hasil_gramasi = $item->sepuluh_gram;
                    DB::table('gtc_emas')->insert([
                        'kode_pengajuan' => $request->kode_pengajuan_emasgtc,
                        'item_emas' => $request->item_emas,
                        'jenis' => $request->jenis,
                        'gramasi' => $request->gramasi,
                        'harga_buyback' => $hasil_gramasi,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                }
            }else{
                $ambil_gramasi = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
                foreach($ambil_gramasi as $item){
                    $hasil_gramasi = $item->nolsatu_gram;
                    DB::table('gtc_emas')->insert([
                        'kode_pengajuan' => $request->kode_pengajuan_emasgtc,
                        'item_emas' => $request->item_emas,
                        'jenis' => $request->jenis,
                        'gramasi' => $request->gramasi,
                        'harga_buyback' => $hasil_gramasi,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                }
            }
            // dd($hasil_gramasi);
        }
    }

    public function tambahdatacifanggota(Request $request, $id)
    {
        $nameland=$request->file('tambah_upload_foto_ktp')->getClientOriginalname();
        $lower_file_name=strtolower($nameland);
        $replace_space=str_replace(' ', '-', $lower_file_name);
        $finalname=time().'-'.$replace_space;
        $destination=public_path('img/foto_ktp');
        $request->file('tambah_upload_foto_ktp')->move($destination,$finalname);
        $data = DB::table('anggota')->where('id', $id)->get();
        foreach($data as $row){
            DB::table('gtc_histori_anggota')->insert([
                'id_anggota' => $row->id,
                'nomor_ba' => $row->nomor_ba,
                'nama_lengkap' => $row->nama_lengkap,
                'nomor_hp' => $row->no_hp,
                'email' => $row->email,
                'status' => $row->status,
                'no_ktp' => $row->no_ktp,
                'jenis_kelamin' => $row->jenis_kelamin,
                'tempat_lahir' => $row->tempat_lahir,
                'tanggal_lahir' => $row->tanggal_lahir,
                'status_nikah' => $row->status_nikah,
                'no_npwp' => $row->no_npwp,
                'alamat_ktp' => $row->alamat_ktp,
                'provinsi_ktp' => $row->provinsi_ktp,
                'kota_ktp' => $row->kota_ktp,
                'kecamatan_ktp' => $row->kecamatan_ktp,
                'kelurahan_ktp' => $row->kelurahan_ktp,
                'alamat_tinggal' => $row->alamat_tinggal,
                'alamat_domisili' => $row->alamat_domisili,
                'provinsi_domisili' => $row->provinsi_domisili,
                'kota_domisili' => $row->kota_domisili,
                'kecamatan_domisili' => $row->kecamatan_domisili,
                'kelurahan_domisili' => $row->kelurahan_domisili,
                'created_at' => \Carbon\Carbon::now(),  # new \Datetime(),
                'updated_at' => \Carbon\Carbon::now(),  # new \Datetime()
            ]);
        }
        DB::table('anggota')->where('id', $id)->update([
            'no_ktp' => $request->tambah_nomor_ktp,
            'jenis_kelamin' => $request->tambah_jenis_kelamin,
            'tempat_lahir' => $request->tambah_tempat_lahir,
            'tanggal_lahir' => $request->tambah_tanggal_lahir,
            'status_nikah' => $request->tambah_status_pernikahan,
            'no_npwp' => $request->tambah_nomor_npwp,
            'alamat_ktp' => $request->tambah_alamat_sesuai_ktp,
            'provinsi_ktp' => $request->tambah_provinsi,
            'kota_ktp' => $request->tambah_kota,
            'kecamatan_ktp' => $request->tambah_kecamatan,
            'kelurahan_ktp' => $request->tambah_kelurahan,
            'alamat_tinggal' => $request->tambah_alamat_tinggal,
            'provinsi_domisili' => $request->tambah_provinsi_domisili,
            'kota_domisili' => $request->tambah_kota_kabupaten_domisili,
            'kecamatan_domisili' => $request->tambah_kecamatan_domisili,
            'kelurahan_domisili' => $request->tambah_kelurahan_domisili,
            'updated_at' => \Carbon\Carbon::now(),  # new \Datetime()
        ]);
    }

    public function historianggota($kode)
    {
        $data = DB::table('gtc_histori_anggota')->where('id_anggota', $kode)->get();
        return response()->json($data);
    }

    public function deleteemasgtc($id)
    {
        DB::table('gtc_emas')->where('id', $id)->delete();
    }

    public function viewpengajuangtc($id)
    {
        $data = DB::table('gtc_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
        ->leftjoin('gtc_transaksi','gtc_transaksi.kode_transaksi','=','gtc_pengajuan.kode_transaksi')
        ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','anggota.*','anggota.id as ida','gtc_transaksi.*','gtc_transaksi.id as idt')
        ->where('gtc_pengajuan.id', $id)
        ->get();
        $emas_syirkah = DB::table('item_emas_syirkah')->get();
        $hargaharian = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
        $emas_gtc = DB::table('gtc_emas')->get();
        return view('backend.pengajuan_gtc.view-pengajuan-gtc', compact('data','emas_syirkah','hargaharian','emas_gtc'));
    }

    public function editpengajuangtc($id)
    {
        $data = DB::table('gtc_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_pengajuan.id_anggota')
        ->leftjoin('gtc_transaksi','gtc_transaksi.kode_transaksi','=','gtc_pengajuan.kode_transaksi')
        ->select('gtc_pengajuan.*','gtc_pengajuan.id as idp','anggota.*','anggota.id as ida','gtc_transaksi.*','gtc_transaksi.id as idt')
        ->where('gtc_pengajuan.id', $id)
        ->get();
        $item_emas = DB::table('item_emas_syirkah')->orderby('id','desc')->get();
        $emas_syirkah = DB::table('item_emas_syirkah')->orderby('id', 'desc')->first();
        $hargaharian = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
        $emas_gtc = DB::table('gtc_emas')->get();
        $jenis_jasa = DB::table('gtc_jenis_jasa')->where('status', 'Active')->first();
        // dd($hargaharian);
        return view('backend.pengajuan_gtc.edit-pengajuan-gtc', compact('data','item_emas','hargaharian','emas_gtc','emas_syirkah','jenis_jasa'));
    }

    public function delpengajuangtc()
    {
        $data = DB::table('gtc_histori_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_histori_pengajuan.id_anggota')
        ->leftjoin('gtc_emas','gtc_emas.kode_pengajuan','=','gtc_histori_pengajuan.kode_pengajuan')
        ->select('gtc_histori_pengajuan.*','anggota.nomor_ba','anggota.nama_lengkap',DB::raw('SUM(gtc_emas.gramasi*keping)as total_gramasi'),DB::raw('SUM(gtc_emas.harga_buyback*keping)as total_buyback'))
        ->groupby('gtc_histori_pengajuan.id')
        ->get();
        return view('backend.pengajuan_gtc.del-pengajuan-gtc', compact('data'));
    }

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
        // $request->validate([
        //     'id_anggota' => 'required',
        //     'id_perwada' => 'required',
        //     'kode_pengajuan' => 'required',
        //     'tujuan' => 'required',
        //     'plafond_pinjaman' => 'required',
        //     'pengajuan' => 'required',
        //     'pilihan_bank' => 'required',
        //     'nomor_rekening' => 'required',
        //     'nama_pemilik_rekening' => 'required',
        //     'kode_transaksi' => 'required',
        //     'jenis_transaksi' => 'required',
        //     'pilihan_jasa' => 'required',
        //     'perhitungan_jasa' => 'required',
        //     'jangka_waktu_permohonan' => 'required',
        //     'jasa_gtc' => 'required',
        //     'pembayaran_jasa' => 'required',
        //     'pembayaran_jasa_manual' => 'required',
        //     'ket_simpwa' => 'required',
        //     'nominal_potongan' => 'required',
        //     'jumlah_yang_di_transfer' => 'required',
        //     'tipe_transaksi' => 'required',
        // ]);
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('d');
        $bulan = date('n');
        $tahun = date('Y');
        $jam = date('H:i');
        $bulan_indonesia = array (1 =>   'Januari',
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
        $angkabulan = $bulan;
        $namabulan = $bulan_indonesia[$angkabulan];
        $tanggalpengajuan = $tgl.' '.$namabulan.' '.$tahun.' '.$jam;
        // dd($tanggalpengajuan);
        if(!$request->signed == ''){
            $folderPath = public_path('tandatangan/');
            
            $image_parts = explode(";base64,", $request->signed);
                  
            $image_type_aux = explode("image/", $image_parts[0]);
               
            $image_type = $image_type_aux[1];
               
            $image_base64 = base64_decode($image_parts[1]);
            
            $nama = uniqid().'.'.$image_type;
    
            $file = $folderPath . $nama;
            file_put_contents($file, $image_base64);
        }else{
            $nama = $request->old_tanda_tangan;
        }
        
        if(!$_FILES["upload_bukti_transfer"]["error"] == 4) {
            File::delete('img/bukti_transfer/'.$request->old_upload_bukti_transfer);
            $nameland=$request->file('upload_bukti_transfer')->getClientOriginalname();
            $lower_file_name=strtolower($nameland);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $finalname=time().'-'.$replace_space;
            $destination=public_path('img/bukti_transfer');
            $request->file('upload_bukti_transfer')->move($destination,$finalname);
        }else{
            $finalname = $request->old_upload_bukti_transfer;
        }

        if(!$_FILES["upload_foto_gold"]["error"] == 4){
            File::delete('img/foto_gold/'.$request->old_upload_foto_gold);
            $nameland2=$request->file('upload_foto_gold')->getClientOriginalname();
            $lower_file_name2=strtolower($nameland2);
            $replace_space2=str_replace(' ', '-', $lower_file_name2);
            $finalname2=time().'-'.$replace_space2;
            $destination2=public_path('img/foto_gold');
            $request->file('upload_foto_gold')->move($destination2,$finalname2);
        }else{
            $finalname2 = $request->old_upload_foto_gold;
        }

        if(!$_FILES["upload_form_pengajuan"]["error"] == 4){
            File::delete('img/surat_terima_transfer/'.$request->old_upload_form_pengajuan);
            $nameland3=$request->file('upload_form_pengajuan')->getClientOriginalname();
            $lower_file_name3=strtolower($nameland3);
            $replace_space3=str_replace(' ', '-', $lower_file_name3);
            $finalname3=time().'-'.$replace_space3;
            $destination3=public_path('img/surat_terima_transfer');
            $request->file('upload_form_pengajuan')->move($destination3,$finalname3);
        }else{
            $finalname3 = $request->old_upload_form_pengajuan;
        }

        if(!$_FILES["upload_surat_terima_transfer"]["error"] == 4){
            File::delete('img/form_pengajuan/'.$request->old_upload_surat_terima_transfer);
            $nameland4=$request->file('upload_surat_terima_transfer')->getClientOriginalname();
            $lower_file_name4=strtolower($nameland4);
            $replace_space4=str_replace(' ', '-', $lower_file_name4);
            $finalname4=time().'-'.$replace_space4;
            $destination4=public_path('img/form_pengajuan');
            $request->file('upload_surat_terima_transfer')->move($destination4,$finalname4);
        }else{
            $finalname4 = $request->old_upload_surat_terima_transfer;
        }

        if(!$_FILES["surat_kuasa_penjualan_jaminan_marhum"]["error"] == 4){
            File::delete('img/surat_kuasa/'.$request->old_surat_kuasa_penjualan_jaminan_marhum);
            $nameland5=$request->file('surat_kuasa_penjualan_jaminan_marhum')->getClientOriginalname();
            $lower_file_name5=strtolower($nameland5);
            $replace_space5=str_replace(' ', '-', $lower_file_name5);
            $finalname5=time().'-'.$replace_space5;
            $destination5=public_path('img/surat_kuasa');
            $request->file('surat_kuasa_penjualan_jaminan_marhum')->move($destination5,$finalname5);
        }else{
            $finalname5 = $request->old_surat_kuasa_penjualan_jaminan_marhum;
        }

        $date = \Carbon\Carbon::now();
        if($request->jangka_waktu_permohonan == 'Pilih'){
            $jatuhtempo = \Carbon\Carbon::now();
        }else{
            $months = $request->jangka_waktu_permohonan;
            foreach(explode(",", $months) as $month) {
                $hours = $month * 24 * 30;
                date_default_timezone_set('Asia/Jakarta');
                $jatuhtempo = date("Y-m-d H:i:s", strtotime("{$date} +{$hours} hours"));
            }
        }

        DB::table('gtc_pengajuan')->insert([
            'tanggal_pengajuan' => \Carbon\Carbon::now(), # new \Datetime(),
            'id_anggota' => $request->id_anggota,
            'id_perwada' => $request->id_perwada,
            'kode_pengajuan' => $request->kode_pengajuan,
            'tujuan' => $request->tujuan,
            'plafond_pinjaman' => str_replace(".","",$request->plafond_pinjaman),
            'pengajuan' => str_replace(".","",$request->pengajuan),
            'pilihan_bank' => $request->pilihan_bank,
            'nomor_rekening' => $request->nomor_rekening,
            'nama_pemilik_rekening' => $request->nama_pemilik_rekening,
            'kode_transaksi' => $request->kode_transaksi,
            "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
            "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
        ]);
        DB::table('gtc_transaksi')->insert([
            'kode_pengajuan' => $request->kode_pengajuan,
            'kode_transaksi' => $request->kode_transaksi,
            'jenis_transaksi' => $request->jenis_transaksi,
            'id_jenis_jasa' => $request->id_jenis_jasa,
            'pilihan_jasa' => $request->pilihan_jasa,
            'perhitungan_jasa' => $request->perhitungan_jasa,
            'jangka_waktu_permohonan' => $request->jangka_waktu_permohonan,
            'jasa_gtc' => str_replace(".","",$request->jasa_gtc),
            'pembayaran_jasa' => $request->pembayaran_jasa,
            'upload_bukti_transfer' => $finalname,
            'jumlah_transfer' => str_replace(".","",$request->jumlah_transfer),
            'pembayaran_jasa_manual' => str_replace(".","",$request->pembayaran_jasa_manual),
            'ket_simpwa' => $request->ket_simpwa,
            'nominal_potongan' => str_replace(".","",$request->nominal_potongan),
            'jumlah_yang_di_transfer' => str_replace(".","",$request->jumlah_yang_di_transfer),
            'tipe_transaksi' => $request->tipe_transaksi,
            'upload_foto_gold' => $finalname2,
            'upload_surat_terima_transfer' => $finalname3,
            'upload_form_pengajuan' => $finalname4,
            'surat_kuasa_penjualan_jaminan_marhum' => $finalname5,
            'catatan' => $request->catatan,
            'tanda_tangan' => $nama,
            'status' => 'Aktif',
            'tanggal_sebelumnya' => \Carbon\Carbon::now(), # new \Datetime()
            'tanggal_jatuh_tempo' => $jatuhtempo,
            "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
            "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
        ]);
        $index = 0;
        foreach($request->id_emas as $id){
            $data = DB::table('gtc_emas')->where('id', $id)->update([
                'keping'=>$request->keping[$index],
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ]);
            $historitransaksi = DB::table('gtc_histori_transaksi')->insert([
                'kode_pengajuan' => $request->kode_pengajuan,
                'kode_transaksi' => $request->kode_transaksi,
                'id_emas' => $request->id_emas[$index],
                'keping' => '0',
                "created_at" => \Carbon\Carbon::now(),  # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ]);
            $index++;
        }
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
            'id_anggota' => 'required',
            'id_perwada' => 'required',
            'kode_pengajuan' => 'required',
            'tujuan' => 'required',
            'plafond_pinjaman' => 'required',
            'pengajuan' => 'required',
            'pilihan_bank' => 'required',
            'nomor_rekening' => 'required',
            'nama_pemilik_rekening' => 'required',
            'kode_transaksi' => 'required',
            'jenis_transaksi' => 'required',
            'pilihan_jasa' => 'required',
            'perhitungan_jasa' => 'required',
            'jangka_waktu_permohonan' => 'required',
            'jasa_gtc' => 'required',
            'pembayaran_jasa' => 'required',
            'pembayaran_jasa_manual' => 'required',
            'ket_simpwa' => 'required',
            'nominal_potongan' => 'required',
            'jumlah_yang_di_transfer' => 'required',
            'tipe_transaksi' => 'required',
        ]);
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('d');
        $bulan = date('n');
        $tahun = date('Y');
        $jam = date('H:i');
        $bulan_indonesia = array (1 =>   'Januari',
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
        $angkabulan = $bulan;
        $namabulan = $bulan_indonesia[$angkabulan];
        $tanggalpengajuan = $tgl.' '.$namabulan.' '.$tahun.' '.$jam;
        // dd($tanggalpengajuan);
        if(!$request->signed == ''){
            $folderPath = public_path('tandatangan/');
            
            $image_parts = explode(";base64,", $request->signed);
                  
            $image_type_aux = explode("image/", $image_parts[0]);
               
            $image_type = $image_type_aux[1];
               
            $image_base64 = base64_decode($image_parts[1]);
            
            $nama = uniqid().'.'.$image_type;
    
            $file = $folderPath . $nama;
            file_put_contents($file, $image_base64);
        }else{
            $nama = $request->old_tanda_tangan;
        }
        
        if(!$_FILES["upload_bukti_transfer"]["error"] == 4) {
            File::delete('img/bukti_transfer/'.$request->old_upload_bukti_transfer);
            $nameland=$request->file('upload_bukti_transfer')->getClientOriginalname();
            $lower_file_name=strtolower($nameland);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $finalname=time().'-'.$replace_space;
            $destination=public_path('img/bukti_transfer');
            $request->file('upload_bukti_transfer')->move($destination,$finalname);
        }else{
            $finalname = $request->old_upload_bukti_transfer;
        }

        if(!$_FILES["upload_foto_gold"]["error"] == 4){
            File::delete('img/foto_gold/'.$request->old_upload_foto_gold);
            $nameland2=$request->file('upload_foto_gold')->getClientOriginalname();
            $lower_file_name2=strtolower($nameland2);
            $replace_space2=str_replace(' ', '-', $lower_file_name2);
            $finalname2=time().'-'.$replace_space2;
            $destination2=public_path('img/foto_gold');
            $request->file('upload_foto_gold')->move($destination2,$finalname2);
        }else{
            $finalname2 = $request->old_upload_foto_gold;
        }

        if(!$_FILES["upload_form_pengajuan"]["error"] == 4){
            File::delete('img/surat_terima_transfer/'.$request->old_upload_form_pengajuan);
            $nameland3=$request->file('upload_form_pengajuan')->getClientOriginalname();
            $lower_file_name3=strtolower($nameland3);
            $replace_space3=str_replace(' ', '-', $lower_file_name3);
            $finalname3=time().'-'.$replace_space3;
            $destination3=public_path('img/surat_terima_transfer');
            $request->file('upload_form_pengajuan')->move($destination3,$finalname3);
        }else{
            $finalname3 = $request->old_upload_form_pengajuan;
        }

        if(!$_FILES["upload_surat_terima_transfer"]["error"] == 4){
            File::delete('img/form_pengajuan/'.$request->old_upload_surat_terima_transfer);
            $nameland4=$request->file('upload_surat_terima_transfer')->getClientOriginalname();
            $lower_file_name4=strtolower($nameland4);
            $replace_space4=str_replace(' ', '-', $lower_file_name4);
            $finalname4=time().'-'.$replace_space4;
            $destination4=public_path('img/form_pengajuan');
            $request->file('upload_surat_terima_transfer')->move($destination4,$finalname4);
        }else{
            $finalname4 = $request->old_upload_surat_terima_transfer;
        }

        if(!$_FILES["surat_kuasa_penjualan_jaminan_marhum"]["error"] == 4){
            File::delete('img/surat_kuasa/'.$request->old_surat_kuasa_penjualan_jaminan_marhum);
            $nameland5=$request->file('surat_kuasa_penjualan_jaminan_marhum')->getClientOriginalname();
            $lower_file_name5=strtolower($nameland5);
            $replace_space5=str_replace(' ', '-', $lower_file_name5);
            $finalname5=time().'-'.$replace_space5;
            $destination5=public_path('img/surat_kuasa');
            $request->file('surat_kuasa_penjualan_jaminan_marhum')->move($destination5,$finalname5);
        }else{
            $finalname5 = $request->old_surat_kuasa_penjualan_jaminan_marhum;
        }

        DB::table('gtc_pengajuan')->where('id', $id)->update([
            'tanggal_pengajuan' => $tanggalpengajuan,
            'id_anggota' => $request->id_anggota,
            'id_perwada' => $request->id_perwada,
            'kode_pengajuan' => $request->kode_pengajuan,
            'tujuan' => $request->tujuan,
            'plafond_pinjaman' => str_replace(".","",$request->plafond_pinjaman),
            'pengajuan' => str_replace(".","",$request->pengajuan),
            'pilihan_bank' => $request->pilihan_bank,
            'nomor_rekening' => $request->nomor_rekening,
            'nama_pemilik_rekening' => $request->nama_pemilik_rekening,
            'kode_transaksi' => $request->kode_transaksi,
            "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
            "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
        ]);
        DB::table('gtc_transaksi')->where('kode_transaksi', $request->kode_transaksi)->update([
            'kode_transaksi' => $request->kode_transaksi,
            'jenis_transaksi' => $request->jenis_transaksi,
            'pilihan_jasa' => $request->pilihan_jasa,
            'perhitungan_jasa' => $request->perhitungan_jasa,
            'jangka_waktu_permohonan' => $request->jangka_waktu_permohonan,
            'jasa_gtc' => str_replace(".","",$request->jasa_gtc),
            'pembayaran_jasa' => $request->pembayaran_jasa,
            'upload_bukti_transfer' => $finalname,
            'jumlah_transfer' => str_replace(".","",$request->jumlah_transfer),
            'pembayaran_jasa_manual' => str_replace(".","",$request->pembayaran_jasa_manual),
            'ket_simpwa' => $request->ket_simpwa,
            'nominal_potongan' => str_replace(".","",$request->nominal_potongan),
            'jumlah_yang_di_transfer' => str_replace(".","",$request->jumlah_yang_di_transfer),
            'tipe_transaksi' => $request->tipe_transaksi,
            'upload_foto_gold' => $finalname2,
            'upload_surat_terima_transfer' => $finalname3,
            'upload_form_pengajuan' => $finalname4,
            'surat_kuasa_penjualan_jaminan_marhum' => $finalname5,
            'catatan' => $request->catatan,
            'tanda_tangan' => $nama,
            "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
            "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
        ]);
        $historitransaksihapus = DB::table('gtc_histori_transaksi')->where('kode_transaksi', $request->kode_transaksi)->delete();
        $index = 0;
        foreach($request->id_emas as $id){
            $data = DB::table('gtc_emas')->where('id', $id)->update([
                'keping'=>$request->keping[$index],
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ]);
            $historitransaksi = DB::table('gtc_histori_transaksi')->insert([
                'kode_pengajuan' => $request->kode_pengajuan,
                'kode_transaksi' => $request->kode_transaksi,
                'id_emas' => $request->id_emas[$index],
                'keping' => '0',
                "created_at" => \Carbon\Carbon::now(),  # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ]);
            $index++;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('gtc_pengajuan')->where('id', $id)->get();
        foreach($data as $row){
            $transaksi = DB::table('gtc_transaksi')->where('kode_transaksi', $row->kode_transaksi)->get();
            foreach($transaksi as $item){
                DB::table('gtc_histori_pengajuan')->insert([
                    'tanggal_pengajuan' => $row->tanggal_pengajuan,
                    'id_anggota' => $row->id_anggota,
                    'id_perwada' => $row->id_perwada,
                    'kode_pengajuan' => $row->kode_pengajuan,
                    'tujuan' => $row->tujuan,
                    'plafond_pinjaman' => $row->plafond_pinjaman,
                    'pengajuan' => $row->pengajuan,
                    'pilihan_bank' => $row->pilihan_bank,
                    'nomor_rekening' => $row->nomor_rekening,
                    'nama_pemilik_rekening' => $row->nama_pemilik_rekening,
                    'kode_transaksi' => $item->kode_transaksi,
                    'jenis_transaksi' => $item->jenis_transaksi,
                    'pilihan_jasa' => $item->pilihan_jasa,
                    'perhitungan_jasa' => $item->perhitungan_jasa,
                    'jangka_waktu_permohonan' => $item->jangka_waktu_permohonan,
                    'jasa_gtc' => $item->jasa_gtc,
                    'pembayaran_jasa' => $item->pembayaran_jasa,
                    'upload_bukti_transfer' => $item->upload_bukti_transfer,
                    'pembayaran_jasa_manual' => $item->pembayaran_jasa_manual,
                    'ket_simpwa' => $item->ket_simpwa,
                    'nominal_potongan' => $item->nominal_potongan,
                    'jumlah_yang_di_transfer' => $item->jumlah_yang_di_transfer,
                    'tipe_transaksi' => $item->tipe_transaksi,
                    'upload_foto_gold' => $item->upload_foto_gold,
                    'upload_surat_terima_transfer' => $item->upload_surat_terima_transfer,
                    'upload_form_pengajuan' => $item->upload_form_pengajuan,
                    'surat_kuasa_penjualan_jaminan_marhum' => $item->surat_kuasa_penjualan_jaminan_marhum,
                    'created_at' => \Carbon\Carbon::now(),  # new \Datetime(),
                    'updated_at' => \Carbon\Carbon::now(),  # new \Datetime()
                ]);
            }
        }
        DB::table('gtc_pengajuan')->where('id', $id)->delete();
        foreach($data as $deletetransaksi){
            DB::table('gtc_transaksi')->where('kode_transaksi', $deletetransaksi->kode_transaksi)->delete();
        }
    }

    public function restorehistoripengajuan($id)
    {
        $data = DB::table('gtc_histori_pengajuan')->where('id', $id)->get();
        foreach($data as $row){
            DB::table('gtc_pengajuan')->insert([
                'tanggal_pengajuan' => $row->tanggal_pengajuan,
                'id_anggota' => $row->id_anggota,
                'id_perwada' => $row->id_perwada,
                'kode_pengajuan' => $row->kode_pengajuan,
                'tujuan' => $row->tujuan,
                'plafond_pinjaman' => $row->plafond_pinjaman,
                'pengajuan' => $row->pengajuan,
                'pilihan_bank' => $row->pilihan_bank,
                'nomor_rekening' => $row->nomor_rekening,
                'nama_pemilik_rekening' => $row->nama_pemilik_rekening,
                'kode_transaksi' => $row->kode_transaksi,
                'status_akhir' => 'Pengajuan',
                'created_at' => \Carbon\Carbon::now(),  # new \Datetime(),
                'updated_at' => \Carbon\Carbon::now(),  # new \Datetime()
            ]);
            DB::table('gtc_transaksi')->insert([
                'kode_transaksi' => $row->kode_transaksi,
                'jenis_transaksi' => $row->jenis_transaksi,
                'pilihan_jasa' => $row->pilihan_jasa,
                'perhitungan_jasa' => $row->perhitungan_jasa,
                'jangka_waktu_permohonan' => $row->jangka_waktu_permohonan,
                'jasa_gtc' => $row->jasa_gtc,
                'pembayaran_jasa' => $row->pembayaran_jasa,
                'upload_bukti_transfer' => $row->upload_bukti_transfer,
                'pembayaran_jasa_manual' => $row->pembayaran_jasa_manual,
                'ket_simpwa' => $row->ket_simpwa,
                'nominal_potongan' => $row->nominal_potongan,
                'jumlah_yang_di_transfer' => $row->jumlah_yang_di_transfer,
                'tipe_transaksi' => $row->tipe_transaksi,
                'upload_foto_gold' => $row->upload_foto_gold,
                'upload_surat_terima_transfer' => $row->upload_surat_terima_transfer,
                'upload_form_pengajuan' => $row->upload_form_pengajuan,
                'surat_kuasa_penjualan_jaminan_marhum' => $row->surat_kuasa_penjualan_jaminan_marhum,
                'created_at' => \Carbon\Carbon::now(),  # new \Datetime(),
                'updated_at' => \Carbon\Carbon::now(),  # new \Datetime()
            ]);
        }
        DB::table('gtc_histori_pengajuan')->where('id', $id)->delete();
    }

    public function viewhistoripengajuan($id)
    {
        $data = DB::table('gtc_histori_pengajuan')
        ->leftjoin('anggota','anggota.id','=','gtc_histori_pengajuan.id_anggota')
        ->leftjoin('gtc_transaksi','gtc_transaksi.kode_transaksi','=','gtc_histori_pengajuan.kode_transaksi')
        ->select('gtc_histori_pengajuan.*','gtc_histori_pengajuan.id as idp','anggota.*','anggota.id as ida','gtc_transaksi.*','gtc_transaksi.id as idt')
        ->where('gtc_histori_pengajuan.id', $id)
        ->get();
        $emas_syirkah = DB::table('item_emas_syirkah')->get();
        $hargaharian = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
        $emas_gtc = DB::table('gtc_emas')->get();
        return view('backend.pengajuan_gtc.view-pengajuan-gtc', compact('data','emas_syirkah','hargaharian','emas_gtc'));
    }

    public function emassyirkah($id){
        $data = DB::table('item_emas_syirkah')
        ->where('id', $id)
        ->get();
        $print = [
            'emas_syirkah'=>$data,
        ];
        return response()->json($print);
    }

    public function tabelemasgtc()
    {
        $data = DB::table('item_emas_syirkah')->orderby('nama', 'asc')->orderby('jenis', 'asc')->get();
        $print = [
            'emas_syirkah'=>$data
        ];
        return response()->json($print);
    }

    public function addtabelemasgtc($id, $pengajuan)
    {
        $emas = DB::table('item_emas_syirkah')->where('id' , $id)->get();
        foreach($emas as $row){
            $gramasi = $row->gramasi;
            if($gramasi == '0.1'){
                $ambil_gramasi = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
                foreach($ambil_gramasi as $item){
                    $hasil_gramasi = $item->nolsatu_gram;
                    DB::table('gtc_emas')->insert([
                        'kode_pengajuan' => $pengajuan,
                        'item_emas' => $row->nama,
                        'jenis' => $row->jenis,
                        'gramasi' => $row->gramasi,
                        'harga_buyback' => $hasil_gramasi,
                        'id_item_emas_syirkah' => $row->id,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                }
            }elseif($gramasi == '0.2'){
                $ambil_gramasi = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
                foreach($ambil_gramasi as $item){
                    $hasil_gramasi = $item->noldua_gram;
                    DB::table('gtc_emas')->insert([
                        'kode_pengajuan' => $pengajuan,
                        'item_emas' => $row->nama,
                        'jenis' => $row->jenis,
                        'gramasi' => $row->gramasi,
                        'harga_buyback' => $hasil_gramasi,
                        'id_item_emas_syirkah' => $row->id,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                }
            }elseif($gramasi == '0.5'){
                $ambil_gramasi = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
                foreach($ambil_gramasi as $item){
                    $hasil_gramasi = $item->nollima_gram;
                    DB::table('gtc_emas')->insert([
                        'kode_pengajuan' => $pengajuan,
                        'item_emas' => $row->nama,
                        'jenis' => $row->jenis,
                        'gramasi' => $row->gramasi,
                        'harga_buyback' => $hasil_gramasi,
                        'id_item_emas_syirkah' => $row->id,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                }
            }elseif($gramasi == '1'){
                $ambil_gramasi = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
                foreach($ambil_gramasi as $item){
                    $hasil_gramasi = $item->satu_gram;
                    DB::table('gtc_emas')->insert([
                        'kode_pengajuan' => $pengajuan,
                        'item_emas' => $row->nama,
                        'jenis' => $row->jenis,
                        'gramasi' => $row->gramasi,
                        'harga_buyback' => $hasil_gramasi,
                        'id_item_emas_syirkah' => $row->id,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                }
            }elseif($gramasi == '2'){
                $ambil_gramasi = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
                foreach($ambil_gramasi as $item){
                    $hasil_gramasi = $item->dua_gram;
                    DB::table('gtc_emas')->insert([
                        'kode_pengajuan' => $pengajuan,
                        'item_emas' => $row->nama,
                        'jenis' => $row->jenis,
                        'gramasi' => $row->gramasi,
                        'harga_buyback' => $hasil_gramasi,
                        'id_item_emas_syirkah' => $row->id,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                }
            }elseif($gramasi == '5'){
                $ambil_gramasi = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
                foreach($ambil_gramasi as $item){
                    $hasil_gramasi = $item->lima_gram;
                    DB::table('gtc_emas')->insert([
                        'kode_pengajuan' => $pengajuan,
                        'item_emas' => $row->nama,
                        'jenis' => $row->jenis,
                        'gramasi' => $row->gramasi,
                        'harga_buyback' => $hasil_gramasi,
                        'id_item_emas_syirkah' => $row->id,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                }
            }elseif($gramasi == '10'){
                $ambil_gramasi = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
                foreach($ambil_gramasi as $item){
                    $hasil_gramasi = $item->sepuluh_gram;
                    DB::table('gtc_emas')->insert([
                        'kode_pengajuan' => $pengajuan,
                        'item_emas' => $row->nama,
                        'jenis' => $row->jenis,
                        'gramasi' => $row->gramasi,
                        'harga_buyback' => $hasil_gramasi,
                        'id_item_emas_syirkah' => $row->id,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                }
            }else{
                $ambil_gramasi = DB::table('gtc_harga_harian')->where('status', 'Active')->get();
                foreach($ambil_gramasi as $item){
                    $hasil_gramasi = 0;
                    DB::table('gtc_emas')->insert([
                        'kode_pengajuan' => $pengajuan,
                        'item_emas' => $row->nama,
                        'jenis' => $row->jenis,
                        'gramasi' => $row->gramasi,
                        'harga_buyback' => $hasil_gramasi,
                        'id_item_emas_syirkah' => $row->id,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                }
            }
            // dd($hasil_gramasi);
        }
    }
    public function editkeping(Request $request,$id){
        dd($request->id_emas);
        foreach($request->id_emas as $id){
            $data = DB::table('gtc_emas')->where('id', $id)->update([
                'keping'=>$request->keping[$index],
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ]);
            $index++;
        }
    }
}
