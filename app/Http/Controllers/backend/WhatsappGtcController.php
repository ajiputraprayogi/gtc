<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class WhatsappGtcController extends Controller
{
    public function index()
    {
        $wa = DB::table('konten_wa_gtc')->where('id', 1)->get();
    
        return view('backend.whatsapp.index',['wa'=>$wa]);
    }
    public function edit(Request $request)
    {  
        switch ($request->input('action')) {
            case 'pengajuan_gtc':

                $edit = DB::table('konten_wa_gtc')->where('id', 1)->update(['pengajuan_gtc' => $request->pengajuan_gtc]);
                return redirect()->back();

            break ; 
            case 'aproval_keuangan':
                
                $edit = DB::table('konten_wa_gtc')->where('id', 1)->update(['aproval_keuangan' => $request->aproval_keuangan]);
                return redirect()->back();

            break ; 
            case 'aproval_kasir':

                $edit = DB::table('konten_wa_gtc')->where('id', 1)->update(['aproval_kasir' => $request->aproval_kasir]);
                return redirect()->back();
                

            break ;
            case 'save_transaksi':
                
                $edit = DB::table('konten_wa_gtc')->where('id', 1)->update(['save_transaksi' => $request->save_transaksi]);
                return redirect()->back();

            break ;
            case 'pelunasan':
                
                $edit = DB::table('konten_wa_gtc')->where('id', 1)->update(['pelunasan' => $request->pelunasan]);
                return redirect()->back();

            break ; 
            }

      
      
 
    }      
}
