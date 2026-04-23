@extends('V_Admin.app')

@extends('flashdata')
@section('title', 'Form One | Pemesanan')
@section('pageTitle', 'Pemesanan')
@section('back', route('suratPemesananRumah.admin', [$getProjek->nama_projek]))
@section('breadcrumb', 'Pemesanan')

@section('content')

    <style>
        @media (max-width: 500px) {
            #fpMobile {
                display: block;
            }

            #fpPC {
                display: none;
            }
        }

        @media (min-width: 501px) {
            #fpMobile {
                display: none;
            }

            #fpPC {
                display: block;
            }
        }
    </style>
    <!-- start: main -->


    <!-- start: navbar -->

    <!-- end: navbar -->

    <!-- start: content -->
    <div id="fpPC">
        <div class="card mb-3">
            <div class="card-body">
                <div class="card-title">
                    <div class="">
                        <i class="bi bi-map"></i>
                        <span>Surat Pemesanan Rumah {{ $getProjek->nama_projek }}</span>

                    </div>

                </div>
                <div class="table-responsive">
                    <table id="formulirPesanan" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No FP</th>
                                <th>Pelanggan & Unit</th>
                                <th>Kontak</th>
                                <th>Tanggal Order</th>
                                <th>Approval</th>
                                <th>Pengaturan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
    $no = 1;
                                                        ?>
                            @foreach ($getFormulirPesanan as $fp)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $fp->no_fp }}</td>
                                    <td>
                                        <span class="client__name"><strong>{{ $fp->nama_plgn }}</strong></span><br>
                                        <span class="badge badge-secondary">{{ $fp->blok }}-{{ $fp->nomor }}</span><br>
                                        <span class="text-muted">Handled by: {{ $fp->nama_ua }} ({{ $fp->nama_ktgr }})</span>
                                    </td>
                                    <td>
                                        <div class="mb-1">
                                            <span>Telp: {{ $fp->no_telp_plgn }}</span>
                                            <a href="tel:{{ $fp->no_telp_plgn }}" class="btn btn-xs btn-outline-info"><i
                                                    class="fa fa-phone"></i></a>
                                        </div>
                                        <div>
                                            <span>WA: {{ $fp->no_wa_plgn }}</span>
                                            <a href="https://wa.me/{{ $fp->no_wa_plgn }}"
                                                class="btn btn-xs btn-outline-success"><i class="mdi mdi-whatsapp"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        {{ date('d M Y', strtotime($fp->tgl_input_fp)) }}
                                    </td>

                                    <td class="text-center">
                                        @php
                                            $statusMap = [
                                                0 => ['label' => 'Menunggu Lead Sales', 'btn' => 'warning'],
                                                1 => ['label' => 'Menunggu Admin Accounting', 'btn' => 'success'],
                                                2 => ['label' => 'Menunggu Head Accounting', 'btn' => 'info'],
                                                3 => ['label' => 'Menunggu Admin Legal', 'btn' => 'primary'],
                                                4 => ['label' => 'Menunggu Manager Legal', 'btn' => 'success'],
                                                5 => ['label' => 'Menunggu CEO', 'btn' => 'dark'],
                                                6 => ['label' => 'Approved (Final)', 'btn' => 'success'],
                                            ];
                                            $currentStatus = $statusMap[$fp->status_approval ?? 0];
                                        @endphp
                                        <span class="badge badge-{{ $currentStatus['btn'] }} px-2 py-1">
                                            {{ $currentStatus['label'] }}
                                        </span>
                                    </td>

                                    <td>
                                        <a class="btn btn-outline-info" data-target="#seeFormulir{{ $fp->id_formulir }}"
                                            data-toggle="modal">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        @if($user->kategori == 'LeadSales' && $fp->status_approval == 0)
                                            <form
                                                action="{{ route('approveSuratPemesananRumah.admin', Crypt::encrypt($fp->id_formulir)) }}"
                                                method="POST" class="d-inline">
                                                @csrf <input type="hidden" name="level" value="1">
                                                <button type="submit" class="btn btn-success" title="Approve as Lead Sales"><i
                                                        class="fa fa-check"></i></button>
                                            </form>
                                        @elseif(in_array($user->kategori, ['AdminAccounting', 'StafAcc']) && $fp->status_approval == 1)
                                            <form
                                                action="{{ route('approveSuratPemesananRumah.admin', Crypt::encrypt($fp->id_formulir)) }}"
                                                method="POST" class="d-inline">
                                                @csrf <input type="hidden" name="level" value="2">
                                                <button type="submit" class="btn btn-info" title="Approve as Accounting"><i
                                                        class="fa fa-check"></i></button>
                                            </form>
                                        @elseif(in_array($user->kategori, ['HeadAccounting']) && $fp->status_approval == 2)
                                            <form
                                                action="{{ route('approveSuratPemesananRumah.admin', Crypt::encrypt($fp->id_formulir)) }}"
                                                method="POST" class="d-inline">
                                                @csrf <input type="hidden" name="level" value="3">
                                                <button type="submit" class="btn btn-info" title="Approve as Accounting"><i
                                                        class="fa fa-check"></i></button>
                                            </form>
                                        @elseif($user->kategori == 'AdminLegal' && $fp->status_approval == 3)
                                            <form
                                                action="{{ route('approveSuratPemesananRumah.admin', Crypt::encrypt($fp->id_formulir)) }}"
                                                method="POST" class="d-inline">
                                                @csrf <input type="hidden" name="level" value="4">
                                                <button type="submit" class="btn btn-primary" title="Approve as Legal"><i
                                                        class="fa fa-check"></i></button>
                                            </form>
                                        @elseif($user->kategori == 'ManagerLegal' && $fp->status_approval == 4)
                                            <form
                                                action="{{ route('approveSuratPemesananRumah.admin', Crypt::encrypt($fp->id_formulir)) }}"
                                                method="POST" class="d-inline">
                                                @csrf <input type="hidden" name="level" value="5">
                                                <button type="submit" class="btn btn-primary" title="Approve as Legal"><i
                                                        class="fa fa-check"></i></button>
                                            </form>
                                        @elseif($user->kategori == 'CEO' && $fp->status_approval == 5)
                                            <form
                                                action="{{ route('approveSuratPemesananRumah.admin', Crypt::encrypt($fp->id_formulir)) }}"
                                                method="POST" class="d-inline">
                                                @csrf <input type="hidden" name="level" value="6">
                                                <button type="submit" class="btn btn-primary" title="Final Approve (CEO)"><i
                                                        class="fa fa-check"></i></button>
                                            </form>
                                        @endif

                                        @if (
                                                in_array($user->kategori, [
                                                    'SuperAdmin',
                                                    'AdminAccounting',
                                                    'LeadSales',
                                                    'StafAcc',
                                                    'CEO',
                                                    'HeadAccounting',
                                                    'AdminLegal',
                                                    'ManagerLegal'
                                                ])
                                            )
                                            @if($fp->status_approval < 4) {{-- Sembunyikan edit jika sudah disetujui CEO --}}
                                                <a href="{{ route('editSuratPemesananRumah.admin', [$getProjek->nama_projek, Crypt::encrypt($fp->id_formulir)]) }}"
                                                    class="btn btn-outline-warning">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            @endif

                                            <a href="{{ route('listPembayaranRumah.admin', [$getProjek->nama_projek, Crypt::encrypt($fp->id_formulir)]) }}"
                                                class="btn btn-outline-info">
                                                <i class="fas fa-edit"></i>
                                                Pembayaran
                                            </a>
                                        @endif

                                        @if($fp->status_approval == 6)
                                            <a href="{{ route('cetakSuratPemesananRumah.admin', Crypt::encrypt($fp->id_formulir)) }}"
                                                class="btn btn-outline-secondary" target="_blank">
                                                <i class="fa fa-print"></i>
                                            </a>
                                        @endif

                                        <div class="modal modal-form fade" id="seeFormulir{{ $fp->id_formulir }}"
                                            data-backdrop="static" tabindex="-1">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Pesanan: {{ $fp->nama_plgn }}</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h6>Data Pelanggan</h6>
                                                                <table class="table table-sm borderless">
                                                                    <tr>
                                                                        <td>Nama</td>
                                                                        <td>: {{ $fp->nama_plgn }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>KTP</td>
                                                                        <td>: {{ $fp->no_ktp_plgn }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Alamat</td>
                                                                        <td>: {{ $fp->alamat_plgn }}</td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6>Data Unit</h6>
                                                                <table class="table table-sm borderless">
                                                                    <tr>
                                                                        <td>Unit</td>
                                                                        <td>: {{ $fp->blok }} - {{ $fp->nomor }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Harga Netto</td>
                                                                        <td>: Rp. {{ rupiah($fp->harga_netto_kkpr ?? 0) }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Status Saat Ini</td>
                                                                        <td>: <strong>{{ $currentStatus['label'] }}</strong>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>


            </div>
        </div>
    </div>
    <div id="fpMobile">
        <div class="card mb-3">
            <div class="card-body">
                <div class="card-title">
                    <div class="">
                        <i class="bi bi-map"></i>
                        <span>Surat Pemesanan Rumah {{ $getProjek->nama_projek }}</span>

                    </div>

                </div>
                <div class="table-responsive">
                    <center>
                        <table id="formulirPemesananMobileTable" class="table">
                            <thead>
                                <tr>
                                    <th></th>

                                </tr>
                            </thead>
                            @foreach ($getFormulirPesananMobile as $fpMobile)
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title">
                                                        <h4>{{ $fpMobile->no_fp }} / {{ $fpMobile->blok }}-{{ $fpMobile->nomor
                                                                                                                }}</h4>
                                                        <span>Nama : {{ $fpMobile->nama_plgn }}</span>
                                                        <span>Dari {{ $fpMobile->nama_ktgr }} ({{ $fpMobile->nama_ua }})</span>
                                                    </div>
                                                    <div>
                                                        <p class="mb-1">

                                                            No. telp {{ $fpMobile->no_telp_plgn }} <a
                                                                href="tel:{{ $fpMobile->no_telp_plgn }}"
                                                                class="btn btn-outline-info"><i class="fa fa-phone"
                                                                    aria-hidden="true"></i></a>
                                                            <br>
                                                        </p>
                                                        <p>

                                                            No. WA {{ $fpMobile->no_wa_plgn }} <a
                                                                href="https://wa.me/{{ $fpMobile->no_wa_plgn }}"
                                                                class="btn btn-outline-info"> <i
                                                                    class="mdi mdi-whatsapp    "></i></a>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        Tanggal : {{ date('d M Y', strtotime($fpMobile->tgl_input_fp)) }}
                                                    </div>

                                                </div>
                                                <div>
                                                    <center>
                                                        <div class="row">
                                                            @if (
                                                                    $user->kategori == 'SuperAdmin' || $user->kategori ==
                                                                    'AdminAccounting' || $user->kategori == 'StafAcc'
                                                                )
                                                                <div class="col-md-4 m-10">
                                                                    <a href="{{ route('editSuratPemesananRumah.admin', [$getProjek->nama_projek, Crypt::encrypt($fpMobile->id_formulir)]) }}"
                                                                        class="btn btn-outline-info">
                                                                        <i class="fas fa-edit    "></i>
                                                                    </a>
                                                                </div>

                                                                <div class="col-md-4 ">
                                                                    <a href="{{ route('listPembayaranRumah.admin', [$getProjek->nama_projek, Crypt::encrypt($fpMobile->id_formulir)]) }}"
                                                                        class="btn btn-outline-info">
                                                                        <i class="fas fa-edit    "></i>Pembayaran
                                                                    </a>
                                                                </div>
                                                                <br>


                                                            @else
                                                            @endif
                                                            <div class="col-md-3 m-10">
                                                                <a href="{{ route('cetakSuratPemesananRumah.admin', Crypt::encrypt($fpMobile->id_formulir)) }}"
                                                                    class="btn btn-outline-info">
                                                                    <i class="fa fa-print" aria-hidden="true"></i>

                                                                    </i>
                                                                </a>
                                                            </div>
                                                            <br>
                                                            <div class="col-md-3 ">
                                                                @if (
                                                                        $user->kategori == 'SuperAdmin' || $user->kategori ==
                                                                        'AdminAccounting' || $user->kategori == 'StafAcc'
                                                                    )
                                                                    <a href="" class="btn btn-outline-info"><i class="fa fa-plus"
                                                                            aria-hidden="true"></i>SPP</a>
                                                                @else
                                                                @endif

                                                            </div>

                                                        </div>
                                                    </center>
                                                </div>
                                            </div>


                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </center>

                </div>


            </div>
        </div>
    </div>
    <!-- end: content -->


    <script>
        function updateTime() {
            const now = new Date();
            const hours = now.getHours();
            const minutes = now.getMinutes();
            const seconds = now.getSeconds();
            const timeString = `${hours}:${minutes}:${seconds}`;
            document.getElementById('clock').textContent = timeString;
        }
        setInterval(updateTime, 1000);
    </script>

    <script>
        $(document).ready(function () {
            $('#formulirPesanan').DataTable({
                lengthMenu: [
                    [25, 50, 100, -1],
                    [25, 50, 100, 'All'],
                ],
                searching: true, // Enable global search bar
                searchCols: [
                    null, // Column 1 (No) - No search input field
                    null, // Column 2 (Rumah) - No search input field
                    null, // Column 3 (Status) - No search input field
                    null, // Column 4 (Tipe) - No search input field
                    null // Column 5 (Tanggal Pre Order) - No search input field
                ],
                autoWidth: true
            });
        });
        $(document).ready(function () {
            $("#formulirPemesananMobileTable").DataTable({
                responsive: true
            });
        });

    </script>

@endsection