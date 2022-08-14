@extends('layouts.base')
@section('content')
    @php
        $user_id = Auth::user()->kantor;
    @endphp
    <div class="container-fluid">
                        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Get The Cash</a></li>
                            <li class="breadcrumb-item active">History Transaksi</li>
                        </ol>
                    </div>
                    <h4 class="page-title">History Transaksi</h4>
                </div>
            </div>
        </div>
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="tab-content">
                            <div class="tab-pane show active" id="scroll-horizontal-preview">
                                <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Kode Pengajuan</th>
                                            <th>Kode Transaksi</th>
                                            <th>Jenis Transaksi</th>
                                            <th>Nomor BA</th>
                                            <th>Tanggal Sebelumnya</th>
                                            <th>Jangka Waktu</th>
                                            <th>Tanggal Jatuh Tempo</th>
                                            <th>Nomor SBTE</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach($data as $row)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            @php
                                                $tanggal = $row->created_att;
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
                                                $pecahkanjam = explode(':', $pecahkandata[1]);
                                                $tgltransaksi = $pecahkantgl[2] . ' ' . $bulan[(int)$pecahkantgl[1]] . ' ' . $pecahkantgl[0] . ' ' . $pecahkanjam[0] . ':' . $pecahkanjam[1];;
                                            @endphp
                                            <td>{{$tgltransaksi}}</td>
                                            <td>{{$row->kode_pengajuan}}</td>
                                            <td>{{$row->kode_transaksit}}</td>
                                            <td>{{$row->jenis_transaksi}}</td>
                                            <td>{{$row->nomor_ba}}</td>
                                            @php
                                                $tanggal2 = $row->tanggal_sebelumnya;
                                                $bulan2 = array (
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
                                                $pecahkandata2 = explode(' ', $tanggal2);
                                                $pecahkantgl2 = explode('-', $pecahkandata2[0]);
                                                $pecahkanjam2 = explode(':', $pecahkandata2[1]);
                                                $tglsebelumnya = $pecahkantgl2[2] . ' ' . $bulan2[(int)$pecahkantgl2[1]] . ' ' . $pecahkantgl2[0];
                                            @endphp
                                            <td>{{$tglsebelumnya}}</td>
                                            <td>{{$row->jangka_waktu_permohonan . ' Bulan'}}</td>
                                            @php
                                                $tanggal3 = $row->tanggal_jatuh_tempot;
                                                $bulan3 = array (
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
                                                $pecahkandata3 = explode(' ', $tanggal3);
                                                $pecahkantgl3 = explode('-', $pecahkandata3[0]);
                                                $pecahkanjam3 = explode(':', $pecahkandata3[1]);
                                                $tgljatuhtempo = $pecahkantgl3[2] . ' ' . $bulan3[(int)$pecahkantgl3[1]] . ' ' . $pecahkantgl3[0];
                                            @endphp
                                            <td>{{$tgljatuhtempo}}</td>
                                            <td>{{$row->sbte}}</td>
                                            <td><a href="{{url('backend/transaksi-gtc/'.$row->idp)}}">Detail</a></td>
                                        </tr>
                                        @endforeach
                                        <!-- <tr>
                                            <td>1</td>
                                            <td>17 Mei 2022 13:30</td>
                                            <td>A.0000001.1</td>
                                            <td>B.0000001.1.1</td>
                                            <td>Perpajagan</td>
                                            <td>0.123.1234567</td>
                                            <td>11 Agustus 2022</td>
                                            <td>1 Bulan</td>
                                            <td>10 September 2022</td>
                                            <td>062.13.12000006-04</td>
                                            <td>Detail</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>17 Mei 2022 13:30</td>
                                            <td>A.0000001.1</td>
                                            <td>B.0000001.1.1</td>
                                            <td>Pengajuan baru</td>
                                            <td>0.123.1234567</td>
                                            <td>11 Agustus 2022</td>
                                            <td>1 Bulan</td>
                                            <td>10 September 2022</td>
                                            <td>062.13.12000006-04</td>
                                            <td>Detail</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>17 Mei 2022 13:30</td>
                                            <td>A.0000001.1</td>
                                            <td>B.0000001.1.1</td>
                                            <td>Pelunasan</td>
                                            <td>0.123.1234567</td>
                                            <td>11 Agustus 2022</td>
                                            <td>1 Bulan</td>
                                            <td>10 September 2022</td>
                                            <td>062.13.12000006-04</td>
                                            <td>Detail</td>
                                        </tr> -->
                                    </tbody>
                                </table>                                          
                            </div> <!-- end preview-->
                        
                            <div class="tab-pane" id="scroll-horizontal-code">
                                <pre class="mb-0">
                                    <span class="html escape">
                                        &lt;table id=&quot;scroll-horizontal-datatable&quot; class=&quot;table w-100 nowrap&quot;&gt;
                                            &lt;thead&gt;
                                                &lt;tr&gt;
                                                    &lt;th&gt;No&lt;/th&gt;
                                                    &lt;th&gt;Pengajuan&lt;/th&gt;
                                                    &lt;th&gt;Perwada&lt;/th&gt;
                                                    &lt;th&gt;Office&lt;/th&gt;
                                                    &lt;th&gt;Age&lt;/th&gt;
                                                    &lt;th&gt;Start date&lt;/th&gt;
                                                    &lt;th&gt;Salary&lt;/th&gt;
                                                    &lt;th&gt;Extn.&lt;/th&gt;
                                                    &lt;th&gt;E-mail&lt;/th&gt;
                                                &lt;/tr&gt;
                                            &lt;/thead&gt;
                                            &lt;tbody&gt;
                                                &lt;tr&gt;
                                                    &lt;td&gt;Tiger&lt;/td&gt;
                                                    &lt;td&gt;Nixon&lt;/td&gt;
                                                    &lt;td&gt;System Architect&lt;/td&gt;
                                                    &lt;td&gt;Edinburgh&lt;/td&gt;
                                                    &lt;td&gt;61&lt;/td&gt;
                                                    &lt;td&gt;2011/04/25&lt;/td&gt;
                                                    &lt;td&gt;$320,800&lt;/td&gt;
                                                    &lt;td&gt;5421&lt;/td&gt;
                                                    &lt;td&gt;t.nixon@datatables.net&lt;/td&gt;
                                                &lt;/tr&gt;
                                                &lt;tr&gt;
                                                    &lt;td&gt;Garrett&lt;/td&gt;
                                                    &lt;td&gt;Winters&lt;/td&gt;
                                                    &lt;td&gt;Accountant&lt;/td&gt;
                                                    &lt;td&gt;Tokyo&lt;/td&gt;
                                                    &lt;td&gt;63&lt;/td&gt;
                                                    &lt;td&gt;2011/07/25&lt;/td&gt;
                                                    &lt;td&gt;$170,750&lt;/td&gt;
                                                    &lt;td&gt;8422&lt;/td&gt;
                                                    &lt;td&gt;g.winters@datatables.net&lt;/td&gt;
                                                &lt;/tr&gt;
                                            &lt;/tbody&gt;
                                        &lt;/table&gt; 
                                    </span>
                                </pre> <!-- end highlight-->
                            </div> <!-- end preview code-->
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>

    </div> <!-- container -->

@endsection
@push('script')
<script>
   $('#list-data').DataTable({
        scrollX:!0,
        language:{
        paginate:{
            previous:"<i class='mdi mdi-chevron-left'>",
            next:"<i class='mdi mdi-chevron-right'>",
        }
        },
        // drawCallback:function(){
        //     $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        // }
        order: [[8, "desc"]],
        pageLength: 10,
        lengthMenu: [[5, 10, 20], [5, 10, 20]]
    });
</script>
@endpush
