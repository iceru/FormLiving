@extends('V_Admin.app')

@extends('flashdata')
@section('title', 'Form One | User')
@section('pageTitle', 'User')
@section('back', route('userKategori.admin'))
@section('breadcrumb', 'User')
{{-- @section('breadcrumb2', 'Rincian Pekerjaan Termin')
@section('breadcrumb3', 'Rincian Pekerjaan')
@section('breadcrumb4', 'Tambah Rincian Pekerjaan') --}}

@section('content')

    <!-- start: main -->


    <!-- start: navbar -->

    <!-- end: navbar -->

    <!-- start: content -->
    <div class="">


        <div class="card mb-3">
            <div class="card-body">
                <div class="card-title">
                    <div class="card__title">
                        <i class="fa fa-user-secret myicon-color" aria-hidden="true"></i>
                        &nbsp;
                        <span>User Kategori </span>

                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table" id="userAdmin">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>

                                <th>Kategori</th>

                                <th>Pengaturan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($getKategoriAll as $getKategori)
                                <tr>
                                    <td>
                                        {{ $no }}
                                    </td>
                                    <td>
                                        @if ($getKategori->nama_ktgr == null)
                                            {{ $getKategori->kategori }}
                                        @else
                                            {{ $getKategori->nama_ktgr }}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-nowrap">
                                            <button type="button" class="btn btn-outline-info"
                                                data-target="#seeKategori{{ $no }}" data-toggle="modal"
                                                data-target=".bd-example-modal-lg{{ $no }}">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </button>

                                            <div class="modal modal-form fade" id="seeKategori{{ $no }}" data-backdrop="static"
                                                data-keyboard="false" tabindex="-1" aria-labelledby="order-informationLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"> Kategori
                                                                @if ($getKategori->nama_ktgr == null)
                                                                    {{ $getKategori->kategori }}
                                                                @else
                                                                    {{ $getKategori->nama_ktgr }}
                                                                @endif

                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true"><i class="bi bi-x-lg"></i></span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="product-listing">

                                                                <div class="modal-body">

                                                                    <div class="">
                                                                        <center>
                                                                            <h4 class="">
                                                                                Menu
                                                                            </h4>
                                                                        </center>
                                                                        <div class="row">


                                                                            @foreach ($getMenuKategori as $menuKategori)
                                                                                @if ($getKategori->id_kategori == $menuKategori->id_kategori)
                                                                                    @if ($menuKategori->status_um == 'aktif')
                                                                                        <div class="col-md-3 mb-1">
                                                                                            <p
                                                                                                class="badge text-bg-success badge--success mb-1 ">

                                                                                                <i class="{{ $menuKategori->icon_menu }}">
                                                                                                    {{ $menuKategori->menu }}
                                                                                                </i>
                                                                                            </p>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="col-md-3 mb-1">
                                                                                            <p
                                                                                                class="badge text-bg-success badge--danger mb-1 ">

                                                                                                <i class="{{ $menuKategori->icon_menu }}">
                                                                                                    {{ $menuKategori->menu }}
                                                                                                </i>
                                                                                            </p>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach

                                                                        </div>
                                                                    </div>


                                                                    <div class="row pt-4">

                                                                        <div class="col-12 mb-1">
                                                                            <button class="btn-fd-primary bg-danger w-100"
                                                                                data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                            <button type="button" class="btn btn-outline-info"
                                                data-target="#editUserKategori{{ $no }}" data-toggle="modal"
                                                data-target=".bd-example-modal-lg{{ $no }}">
                                                <i class="fas fa-edit    "></i>
                                            </button>
                                            <div class="modal fade" id="editUserKategori{{ $no }}" data-backdrop="static"
                                                data-keyboard="false" tabindex="-1" role="dialog"
                                                aria-labelledby="label{{ $no }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-light">
                                                            <h5 class="modal-title" id="label{{ $no }}">
                                                                <i class="bi bi-pencil-square mr-2"></i>Ubah Detail User
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form
                                                            action="{{ route('updateUserKategoriAction.admin', $getKategori->id_kategori) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body px-4 py-4">

                                                                <div class="text-center mb-4">
                                                                    <h6 class="text-uppercase text-muted font-weight-bold"
                                                                        style="letter-spacing: 1px;">Menu Saat Ini</h6>
                                                                    <hr style="width: 50px; border-top: 2px solid #007bff;">
                                                                </div>

                                                                <div class="row mb-4">
                                                                    @foreach ($getMenuKategori as $menuKategori)
                                                                        @if ($getKategori->id_kategori == $menuKategori->id_kategori)
                                                                            <div class="col-md-4 col-sm-6 mb-2">
                                                                                <div class="btn {{ $menuKategori->status_um == 'aktif' ? 'btn-success' : 'btn-danger' }} btn-sm btn-block d-flex justify-content-between align-items-center py-2 px-3 shadow-sm change-status-link"
                                                                                    id="badge{{ $menuKategori->id_user_menu }}">
                                                                                    <span><i
                                                                                            class="{{ $menuKategori->icon_menu }} mr-2"></i>{{ $menuKategori->menu }}</span>
                                                                                    <i class="bi {{ $menuKategori->status_um == 'aktif' ? 'bi-toggle2-on' : 'bi-toggle2-off' }}"
                                                                                        style="font-size: 1.2rem;"></i>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>

                                                                <div class="text-center mb-4">
                                                                    <h6 class="text-uppercase text-muted font-weight-bold"
                                                                        style="letter-spacing: 1px;">Tambah Menu Baru</h6>
                                                                    <hr style="width: 50px; border-top: 2px solid #28a745;">
                                                                </div>

                                                                <div class="row">
                                                                    @php
                                                                        // Using Laravel Collections to simplify logic and prevent formatter errors
                                                                        $assignedMenuIds = $getMenuKategori
                                                                            ->where(
                                                                                'id_kategori',
                                                                                $getKategori->id_kategori,
                                                                            )
                                                                            ->pluck('id_menu')
                                                                            ->toArray();
                                                                        $availableToAdd = $getMenu->reject(
                                                                            fn($m) => in_array(
                                                                                $m->id_menu,
                                                                                $assignedMenuIds,
                                                                            ),
                                                                        );
                                                                    @endphp

                                                                    @forelse ($availableToAdd as $menu)
                                                                        <div class="col-md-6 col-lg-4 mb-3">
                                                                            <div class="custom-control custom-checkbox border rounded p-3 d-flex align-items-center hover-item"
                                                                                style="min-height: 60px;">
                                                                                <input type="checkbox" name="menu[]"
                                                                                    value="{{ $menu->id_menu }}"
                                                                                    class="custom-control-input"
                                                                                    id="menuCheck{{ $menu->id_menu }}{{ $no }}">
                                                                                <label
                                                                                    class="custom-control-label d-flex align-items-center w-100 cursor-pointer ml-4"
                                                                                    for="menuCheck{{ $menu->id_menu }}{{ $no }}">
                                                                                    <i
                                                                                        class="{{ $menu->icon_menu }} mr-2 text-primary"></i>
                                                                                    <span
                                                                                        class="font-weight-bold text-dark">{{ $menu->menu }}</span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    @empty
                                                                        <div class="col-12 text-center py-3">
                                                                            <div class="alert alert-secondary d-inline-block px-5">
                                                                                <i class="bi bi-info-circle mr-2"></i>Semua
                                                                                menu sudah tersedia.
                                                                            </div>
                                                                        </div>
                                                                    @endforelse
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer bg-light">
                                                                <div class="w-100">
                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-block py-2 mb-2">
                                                                        <i class="bi bi-save mr-2"></i>Simpan Perubahan
                                                                    </button>
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary btn-block py-2"
                                                                        data-dismiss="modal">
                                                                        Batal
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                    </td>
                                </tr>
                                @php
                                    $no++;
                                @endphp
                            @endforeach



                        </tbody>
                    </table>
                </div>

            </div>
        </div>


        <script>
            $(document).ready(function () {
                $('.change-status-link').on('click', function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    var status = $(this).data('status');


                    $.ajax({
                        type: 'GET',
                        url: '{{ route('changeStatusUserKategori.admin', ['id' => ':id']) }}'
                            .replace(':id', id),

                        success: function (data) {
                            // Handle success, update UI or show a success message
                            { { --console.log(data); --} }
                            var badge = document.getElementById('badge' + id);
                            if (data.status_um == 'aktif') {
                                badge.className = "badge text-bg-success badge--success mb-1";
                            } else {
                                badge.className = "badge text-bg-danger badge--danger mb-1";
                            }

                            // Update the toggle class
                            var toggle = document.getElementById('toggle' + id);
                            if (data.status_um == 'aktif') {
                                toggle.className = "bi bi-toggle2-on";
                            } else {
                                toggle.className = "bi bi-toggle2-off";
                            }
                            // Update the toggle class


                        },
                        error: function (error) {
                            // Handle error, show an error message or handle as needed
                            console.log(error);
                        }
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                $('#userAdmin').DataTable({
                    lengthMenu: [
                        [25, 50, 100, -1],
                        [25, 50, 100, 'All'],
                    ],
                });
            });
        </script>

@endsection