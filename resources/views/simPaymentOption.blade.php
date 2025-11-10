@extends('HomeLayout.app')
@extends('HomeLayout.navbar')
@extends('HomeLayout.sidebar')
@extends('HomeLayout.footer')
@section('tittle', 'Forms | Simulasi Pembayaran')
@section('body', '')


@section('content')
    <style>
        .collapsible {
            border: 1px solid #ccc;
            margin-bottom: 10px;
            border-radius: 15px;

        }

        .collapsible-btn {
            background-color: #198754;
            border: none;
            padding: 10px;
            border-radius: 15px;
            cursor: pointer;
            width: 100%;
            text-align: left;
            color: white;
        }

        .collapsible-content {
            display: none;
            padding: 10px;
            border-radius: 15px;


        }
    </style>
    <div class="cluster">
        <div class="header-simulation mobile-only">
            <div class="ornament one">
                <img src="{{ asset('Home') }}/images/img-ornament1.png" alt="">
            </div>
            <div class="nav-header">
                <!--<div class="ic-back">-->
                <!--    <img src="{{ asset('Home') }}/images/ic-back-sim.png" alt="">-->
                <!--</div>-->
                <h2 class="title">
                    Miliki Unit
                </h2>
                <div></div>
            </div>
            <div class="steps">
                <div class="step done">1</div>
                <div class="step done">2</div>
                <div class="step done">3</div>
                <div class="step active">4</div>
                <div class="step ">5</div>
                <div class="step last">6</div>


            </div>

        </div>
        <div class="container">
            <div class="steps">
                <div class="step done">1</div>
                <div class="step done">2</div>
                <div class="step done">3</div>
                <div class="step active">4</div>
                <div class="step ">5</div>
                <div class="step last">6</div>


            </div>

            <div class="container">




                <div>
                    {{-- FORM --}}

                    <div class="second-layout">

                        <div class="row">
                            <div class="col-12 order-2 order-lg-1">
                                <h2 class="title">
                                    Metode Pembayaran
                                </h2>
                            </div>
                            <div class="col-12 col-lg-4 left-column order-1 order-lg-2">
                                <div class="mod-type">
                                    <div class="type-image">
                                        <img src="{{ asset('Home') }}/images/tipe/{{ $tipeRumah->img_tr }}" alt="">
                                    </div>
                                    <div class="items">

                                        <div class="type-item">
                                            <p>Blok</p>
                                            <h5>{{ $rumah->blok }} - {{ $rumah->nomor }}</h5>
                                        </div>
                                        <div class="type-item">
                                            <p>Cluster</p>
                                            <h5>{{ $rumah->nama_cluster }}</h5>
                                        </div>
                                        <div class="type-item">
                                            <p>Harga Jual</p>

                                            <h5>Rp {{ rupiah($tipeRumah->harga_tr) }}</h5>
                                        </div>
                                        <div class="type-item">
                                            <p>Luas Tanah</p>

                                            <h5>{{ $rumah->luas_tanah }} m<sup>2</sup></h5>
                                        </div>
                                        <div class="type-item">
                                            <p>Type</p>
                                            <h5>{{ $tipeRumah->jenis_tr }}</h5>
                                        </div>
                                        <div class="type-item">
                                            <p>Luas Bangunan</p>
                                            <h5>{{ $tipeRumah->luas_bangunan_tr }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-8 right-column order-3">
                                <div class="card">
                                    <div class="card-header" style="background-color: #198754; color: white;">
                                        <label for="gender" class="form-label">Pakai Promo</label>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <button type="button" id="openModal" class="btn btn-form"
                                                    data-bs-toggle="modal" data-bs-target="#modelId">
                                                    <div class="promo-text"><img
                                                            src="{{ asset('Home') }}/images/ic-promo.png" alt="">
                                                        <div id="textPromo">Pilih promo di sini</div>
                                                    </div>
                                                    <div><i class="bi-chevron-right"></i></div>
                                                </button>
                                                <br>
                                                <div id="myAlert" role="alert">

                                                </div>

                                                <br>
                                                <div class="form-group">
                                                    <input type="text" name="promo" value="Tidak Ada Promo"
                                                        id="selectedPromoCode" class="form-control" readonly>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <br>

                                {{--
                            =================================================================================================================================================
                            --}}

                                {{-- KPR --}}
                                <div class="collapsible">
                                    <button class="collapsible-btn">
                                        KPR
                                    </button>
                                    <div class="collapsible-content">
                                        <div id="collapse-card-cluster" class="card-body collapse-item">
                                            <div class="row">
                                                <form
                                                    action="{{ route('simulationPaymentOptionAction', [$rumah->id_rumah, $tipeRumah->id_tipe_rumah]) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="card-shadow">

                                                        <label for="">Booking Fee </label><br>

                                                        <input type="text" name="jenis" readonly hidden value="KPR">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" name="bookingFeeKPR" id="bookingFeeKPR"
                                                            class="form-control" value="10000000">
                                                        <div id="warningMessageKPR" style="color: red;"></div>
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <label for="">Persentase Uang Muka <input type="checkbox"
                                                                name="" id="RupiahCheck"> Rupiah </label>
                                                    </div>
                                                    <div class="">
                                                        <div class="form-group">

                                                            <input type="text" name="persentase" id="persentase"
                                                                class="form form-control" value="10">
                                                            <small id="errorPersentase" style="color: red">Persentase
                                                                Minimal 10%</small>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">

                                                        <input type="number" value="1" readonly hidden
                                                            class="form form-control" id="sukuBunga" value="">

                                                    </div>

                                                    <br>
                                                    <div class="card-shadow">
                                                        <label for="">Harga Rumah</label>
                                                        <div class="">
                                                            <div class="form-group">
                                                                <label for="" id="textjumlahKPR">Rp.
                                                                    {{ rupiah($tipeRumah->harga_tr) }}</label>
                                                                <input type="text" class="form form-control"
                                                                    id="jumlahKPR" name="jumlah" readonly hidden
                                                                    value="{{ $tipeRumah->harga_tr }}">

                                                            </div>
                                                        </div>
                                                    </div>



                                                    <br>
                                                    @php
                                                        $cicilan = 7;
                                                    @endphp
                                                    @if ($rumah->status_stock == 'Inden')
                                                        <div class="card-shadow">
                                                            <label for="">Cicilan Uang Muka</label>
                                                        </div>
                                                        <div class="">
                                                            <div class="form-group">
                                                                <select name="cicilanUM" id="cicilanUM" required
                                                                    class="form-control">
                                                                    <option value="" selected>--Pilih Cicilan Uang
                                                                        Muka--
                                                                    </option>
                                                                    @for ($i = 1; $i < $cicilan; $i++)
                                                                        <option value="{{ $i }}">
                                                                            {{ $i }} kali
                                                                        </option>
                                                                    @endfor
                                                                </select>


                                                            </div>
                                                        </div>
                                                    @else
                                                        <select name="cicilanUM" id="cicilanUM" hidden required
                                                            class="form-control">
                                                            <option value="1">1</option>
                                                        </select>

                                                    @endif

                                                    <div class="form-group">

                                                        <input type="text" name="promoKPR" id="kdPromo1"
                                                            value="Tidak Ada Promo" hidden readonly class="form-control"
                                                            placeholder="" aria-describedby="helpId">

                                                    </div>
                                                    <div class="btn-groups">
                                                        <a type="button"
                                                            onclick="hitung('jumlahKPR','persentase','sukuBunga','hasil','hasil2','hasil3','hasil4', 'cicilanUM','sisaPembayaran')"
                                                            id="hitungBtn" class="btn btn-primary">Hitung Simulasi</a>


                                                    </div>
                                                    <div class="price-total">
                                                        <p>Perkiraan pembayaran KPR Anda:</p>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <h5 id="hasil"></h5>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <h5 id="hasil2"></h5>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <h5 id="hasil3"></h5>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <h5 id="hasil4"></h5>
                                                                </td>
                                                            </tr>


                                                        </table>


                                                        <h5 id="sisaPembayaran"></h5>
                                                    </div>
                                                    <input type="text" id="diskonInputKPR" hidden readonly
                                                        name="diskonInputKPR" class="form-control">

                                                    <div class="btn-groups">
                                                        <button type="submit" type="button" id="nextKPR" disabled
                                                            style="opacity: 10%"
                                                            class="btn btn-primary">Lanjutkan</button>
                                                    </div>

                                                    {{ $tipeRumah->harga_freeppn_tr }}


                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--
                            =================================================================================================================================================
                            --}}

                                {{-- CICILAN --}}
                                <div class="collapsible">
                                    <button class="collapsible-btn">
                                        Cicilan
                                    </button>
                                    <div class="collapsible-content">
                                        <div id="collapse-card-cluster" class="card-body collapse-item">
                                            <div class="row">
                                                <form
                                                    action="{{ route('simulationPaymentOptionAction', [$rumah->id_rumah, $tipeRumah->id_tipe_rumah]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="simulation-price">


                                                        <div class="card-shadow">

                                                            <label for="">Booking Fee </label><br>
                                                            <input type="text" name="bookingFeeCicilan"
                                                                id="bookingFeeCicilan" class="form form-control"
                                                                value="10000000">
                                                            <br>
                                                            <div id="warningMessageCicilan" style="color: red;"></div>
                                                            <input type="text" name="jenis" value="Cicilan" readonly
                                                                hidden id="">

                                                        </div>



                                                        <div class="card-shadow" id='cardDiskon2' style="display: none">
                                                            <label for="" id="diskon2"></label>
                                                        </div>

                                                        <div class="collapse-item" id="cicilan">
                                                            @for ($i = 1; $i <= 8; $i++)
                                                                <?php $thn = ($tipeRumah->harga_tr - 10000000) / $i;
                                                                
                                                                ?>


                                                                <div class="card-shadow">
                                                                    <input type="radio" id="age1" name="cicilan"
                                                                        value="{{ $i }}">
                                                                    <label class="form-check-label">
                                                                        Cicilan {{ $i }} bulan dengan cicilan Rp
                                                                        {{ rupiah($thn) }} per bulan

                                                                    </label>

                                                                </div>


                                                                <br>
                                                            @endfor
                                                        </div>

                                                    </div>
                                                    <div class="form-group">

                                                        <input type="text" name="promoCicilan" id="kdPromo2"
                                                            value="Tidak Ada Promo" hidden readonly class="form-control"
                                                            placeholder="" aria-describedby="helpId">

                                                    </div>
                                                    <div class="card-shadow">
                                                        <label for="" id="jumlahHargaCicilan">Jumlah harga Rp.
                                                            {{ rupiah($tipeRumah->harga_tr) }}</label>
                                                    </div>
                                                    <input type="text" id="diskonInputCicilan" hidden readonly
                                                        name="diskonInputCicilan" class="form-control">
                                                    <div class="">

                                                        <input type="text" readonly class="form-control card-shadow"
                                                            name="jumlah" id="jumlahHarga" aria-describedby="helpId"
                                                            placeholder="" onkeyup="getValue('jumlahHarga')"
                                                            value="{{ $tipeRumah->harga_tr }}" hidden>
                                                    </div>

                                                    <div class="btn-groups">

                                                        <button type="submit" type="button" id=""
                                                            class="btn btn-primary">Lanjutkan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="btn-groups">
                        <a href="{{ route('simulationDetailTipe', [$rumah->id_rumah, $tipeRumah->id_tipe_rumah]) }}"
                            type="button" class="btn btn-grey">Kembali</a>

                    </div>
                </div>
            </div>
        </div>

        {{-- -------------------------------------------------------------------------------------- --}}
        {{-- modal-popup promo --}}
        <div class="modal fade promo" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body promo-modal">
                        <h5 class="promo-title">
                            Pakai Promo
                        </h5>

                        <div class="promo-input">
                            <input type="text" class="form-control" name="promo" id="promo"
                                placeholder="Masukkan kode promo">

                            <a id="cariPromo" class="btn">Terapkan</a>
                        </div>
                        <!-- STATE PROMO -->
                        <div class=" d-block ">

                            <h5 class="mb-4">Pilih Promo</h5>

                            @if (empty($promoRumah))
                                <h5>Promo Rumah</h5>
                                Tidak ada promo Rumah
                            @else
                                <h5>Promo Rumah</h5>
                                @foreach ($promoRumah as $promoRumah)
                                    <div class="promo-item" style="width: 100%">
                                        <div class="row " style="width: 100%">
                                            <div class="promo-icon col-md-1">
                                                <img src="{{ asset('Home') }}/images/ic-promo.png" alt="Promo">
                                            </div>
                                            <div class="promo-text col-md-7">

                                                <h6 id='keteranganPromo'>{{ $promoRumah->promo }}</h6>
                                                <p>Berlaku hingga:
                                                    {{ date('d M Y', strtotime($promoRumah->tgl_berakhir)) }}
                                                </p>
                                                <div class="hemat">
                                                    <p class="light-grey-color">Anda bisa hemat
                                                    </p>
                                                    <h5>
                                                        @if ($promoRumah->jenis_promo == 'KPR')
                                                            @if ($promoRumah->status_diskon == 'persen')
                                                                Diskon Uang Muka {{ $promoRumah->diskon_promo }} %
                                                            @else
                                                                Rp. {{ rupiah($promoRumah->diskon_promo) }}
                                                            @endif
                                                        @else
                                                            @if ($promoRumah->status_diskon == 'persen')
                                                                Diskon {{ $promoRumah->diskon_promo }} %
                                                            @else
                                                                Rp. {{ rupiah($promoRumah->diskon_promo) }}
                                                            @endif
                                                        @endif
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="promo-button col-md-2">

                                                <a class="promoCodeBtn btn btn-outline-success"
                                                    data-promo-code="{{ $promoRumah->kode_promo }}"
                                                    data-jenis-promo="{{ $promoRumah->jenis_promo }}"
                                                    data-status-diskon="{{ $promoRumah->status_diskon }}"
                                                    data-jumlah-promo="{{ $promoRumah->diskon_promo }}"
                                                    data-status-max-diskon="{{ $promoRumah->status_max_diskon }}"
                                                    data-max-diskon="{{ $promoRumah->max_diskon }}"
                                                    data-promo="{{ $promoRumah->promo }}"
                                                    data-bphtb-promo="{{ $promoRumah->bphtb_promo }}"
                                                    data-freekpr-promo="{{ $promoRumah->freekpr_promo }}"
                                                    data-freeppn-promo="{{ $promoRumah->free_ppn_promo }}">{{ $promoRumah->kode_promo }}

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif



                        </div>
                        <!-- STATE NO PROMO -->
                        <div class="no-promo text-center d-none">
                            <img src="{{ asset('Home') }}/images/img-illustration4.png" class="w-100" alt="">
                        </div>
                    </div>

                    <div class="modal-footer promo-footer">

                    </div>
                </div>
            </div>
        </div>

<script>
    $(document).ready(function() {
        var inputElementKPR = $('#bookingFeeKPR');
        var inputElementCicilan = $('#bookingFeeCicilan');
        formatInputValue(inputElementKPR);
        checkBookingFee(inputElementKPR, '#warningMessageKPR');

        formatInputValue(inputElementCicilan);
        checkBookingFee(inputElementCicilan, '#warningMessageCicilan');

        // KPR
        inputElementKPR.on('input', function() {
            formatInputValue($(this));
            checkBookingFee($(this), '#warningMessageKPR');
        });
        
        // CICILAN
        inputElementCicilan.on('input', function() {
            formatInputValue($(this));
            checkBookingFee($(this), '#warningMessageCicilan');
        });
    });

    function formatInputValue(inputElement) {
        var inputValue = inputElement.val().replace(/\./g, ''); // Remove thousands separators

        // Replace null or empty value with 0
        if (!inputValue) {
            inputValue = '';
            inputElement.val(inputValue);
        }

        // Format the value with thousands separators
        var formattedValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        inputElement.val(formattedValue);
    }

    function checkBookingFee(inputElement, textWarning) {
        var bookingFee = parseFloat(inputElement.val().replace(/[\.,]/g, ''));
        bookingFee = parseInt(bookingFee);
        if (isNaN(bookingFee)) {
            bookingFee = 0; // Handle non-numeric input
        }

        if (bookingFee < 5000000) {
            $(textWarning).text('Booking fee harus di atas Rp. 5.000.000').show();
        } else {
            $(textWarning).text('').hide();
        }
    }

    var jenisDiskon, jumlahDiskon, statusJumlahDiskon, jumlahMaxDiskon, statusJumlahMaxDiskon;

    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll(".collapsible-btn");

        buttons.forEach(button => {
            button.addEventListener("click", function() {
                const content = this.nextElementSibling;
                content.style.display = content.style.display === "block" ? "none" : "block";
            });
        });
    });
</script>

<script>
    // Initialize variables
    const valueInput = document.getElementById('persentase');
    const alertMessage = document.getElementById('errorPersentase');
    const uangMuka10 = {{ $tipeRumah->harga_tr }} * (10 / 100);
    const hargaRumah = document.getElementById('jumlah');
    const persentaseInput = document.getElementById('persentase');
    var priceFinal = {{ $tipeRumah->harga_tr }};

    // Initialize uangMukaAsli with the initial value of the input
    let uangMukaAsli = 10;

    // Handle persentase input changes
    if (persentaseInput) {
        persentaseInput.addEventListener('input', function() {
            const rupiahCheck = document.getElementById('RupiahCheck');
            const isRupiah = rupiahCheck && rupiahCheck.checked;
            
            if (isRupiah) {
                // If checkbox is checked, treat as rupiah amount
                const rupiahValue = parseFloat(this.value.replace(/\./g, '')) || 0;
                // Convert to percentage of house price
                uangMukaAsli = (rupiahValue / priceFinal) * 100;
            } else {
                // If not checked, treat as percentage
                uangMukaAsli = parseFloat(this.value) || 10;
            }
            
            console.log('Uang Muka:', isRupiah ? 'Rp ' + this.value : this.value + '%');
            console.log('Percentage:', uangMukaAsli + '%');
        });
    }

    // Handle Rupiah checkbox
    const rupiahCheck = document.getElementById('RupiahCheck');
    if (rupiahCheck) {
        rupiahCheck.addEventListener('change', function() {
            if (persentaseInput) {
                if (this.checked) {
                    // Switch to Rupiah mode
                    persentaseInput.value = '';
                    persentaseInput.placeholder = 'Masukkan jumlah rupiah';
                } else {
                    // Switch to Percentage mode
                    persentaseInput.value = '10';
                    persentaseInput.placeholder = 'Masukkan persentase';
                }
                // Trigger input event to update uangMukaAsli
                persentaseInput.dispatchEvent(new Event('input'));
            }
        });
    }

    // Unified promo data structure
    class PromoHandler {
        constructor() {
            this.selectedPromoCodeInput = document.getElementById("selectedPromoCode");
            this.initializeEventListeners();
        }

        initializeEventListeners() {
            // Handle promo code buttons
            const promoCodeBtns = document.querySelectorAll(".promoCodeBtn");
            promoCodeBtns.forEach(btn => {
                btn.addEventListener("click", (e) => this.handlePromoSelection(e.target));
            });

            // Handle manual promo search
            const cariPromoBtn = document.getElementById('cariPromo');
            if (cariPromoBtn) {
                cariPromoBtn.addEventListener('click', () => this.handleManualPromoSearch());
            }
        }

        // Extract promo data from button or response
        extractPromoData(source, isFromAPI = false) {
            if (isFromAPI) {
                return {
                    promoCode: source.kode_promo,
                    jenisPromo: source.jenis_promo,
                    statusDiskon: source.status_diskon,
                    diskonPromo: source.diskon_promo,
                    statusMaxDiskon: source.status_max_diskon,
                    maxDiskon: source.max_diskon,
                    promo: source.promo || source.kode_promo,
                    bphtbPromo: source.bphtb_promo || 'no',
                    freeKPRPromo: source.freekpr_promo || 'no',
                    freePPNPromo: source.free_ppn_promo || 'no'
                };
            } else {
                return {
                    promoCode: source.getAttribute('data-promo-code') || source.dataset.promoCode,
                    jenisPromo: source.getAttribute('data-jenis-promo') || source.dataset.jenisPromo,
                    statusDiskon: source.getAttribute('data-status-diskon') || source.dataset.statusDiskon,
                    diskonPromo: source.getAttribute('data-jumlah-promo') || source.dataset.jumlahPromo,
                    statusMaxDiskon: source.getAttribute('data-status-max-diskon') || source.dataset.statusMaxDiskon,
                    maxDiskon: source.getAttribute('data-max-diskon') || source.dataset.maxDiskon,
                    promo: source.getAttribute('data-promo') || source.dataset.promo,
                    bphtbPromo: source.getAttribute('data-bphtb-promo') || source.dataset.bphtbPromo || 'no',
                    freeKPRPromo: source.getAttribute('data-freekpr-promo') || source.dataset.freekprPromo || 'no',
                    freePPNPromo: source.getAttribute('data-freeppn-promo') || source.dataset.freeppnPromo || 'no'
                };
            }
        }

        // Handle promo selection from buttons
        handlePromoSelection(button) {
            const promoData = this.extractPromoData(button);
            this.applyPromo(promoData);
            this.closeModal();
        }

        // Handle manual promo search via AJAX
        handleManualPromoSearch() {
            const kodePromo = document.getElementById('promo').value;
            const spaceAlert = document.getElementById('myAlert');

            if (!kodePromo.trim()) {
                this.showAlert(spaceAlert, 'Masukkan kode promo terlebih dahulu', 'danger');
                return;
            }

            $.ajax({
                url: '{{ route('findKuponSpesial', [$tipeRumah->id_rumah, $tipeRumah->id_tipe_rumah]) }}',
                type: 'GET',
                dataType: 'json',
                data: { kodePromo: kodePromo },
                success: (response) => {
                    if (response.promo != null) {
                        const promoData = this.extractPromoData(response, true);
                        this.applyPromo(promoData);
                        this.closeModal();
                    } else {
                        this.showAlert(spaceAlert, 'Promo tidak ada', 'danger');
                        this.closeModal();
                    }
                },
                error: (error) => {
                    console.error('Error fetching promo:', error);
                    this.showAlert(spaceAlert, 'Terjadi kesalahan saat mencari promo', 'danger');
                }
            });
        }

        // Apply promo based on data
        applyPromo(promoData) {
            // Set promo code input
            if (this.selectedPromoCodeInput) {
                this.selectedPromoCodeInput.value = promoData.promoCode;
            }

            // Set global variables for promo
            jenisDiskon = promoData.jenisPromo;
            statusJumlahDiskon = promoData.statusDiskon;
            jumlahDiskon = promoData.diskonPromo;
            statusJumlahMaxDiskon = promoData.statusMaxDiskon;
            jumlahMaxDiskon = promoData.maxDiskon;

            // Set specific promo code fields
            this.setPromoCodeField(promoData);

            // Handle free PPN promo
            if (promoData.freePPNPromo === "yes") {
                this.handleFreePPNPromo();
            }

            // Update promo text display
            this.updatePromoDisplay(promoData.promo);

            // Apply discount based on promo type
            this.processPromoDiscount(promoData);
        }

        // Set the appropriate promo code field based on type
        setPromoCodeField(promoData) {
            const field = promoData.jenisPromo === "KPR" ? 'kdPromo1' : 'kdPromo2';
            const element = document.getElementById(field);
            if (element) {
                element.value = promoData.promoCode;
            }
        }

        // Handle free PPN promo price adjustment
        handleFreePPNPromo() {
            priceFinal = '{{ $tipeRumah->harga_free_ppn_tr }}' || '{{ $tipeRumah->harga_tr }}';
            console.log("Harga Baru = " + priceFinal);

            // Update display elements
            this.updateElement('textjumlahKPR', "Rp. " + formatRupiah2(priceFinal));
            this.updateElement('jumlahHargaCicilan', "Jumlah harga Rp. " + formatRupiah2(priceFinal));

            // Update hidden input fields
            this.updateInputField('jumlahKPR', priceFinal);
            this.updateInputField('jumlahHarga', priceFinal);
        }

        // Update display element content
        updateElement(id, content) {
            const element = document.getElementById(id);
            if (element) {
                element.innerText = content;
            }
        }

        // Update input field value
        updateInputField(id, value) {
            const existingInput = document.getElementById(id);
            if (existingInput) {
                existingInput.value = value;
            }
        }

        // Update promo display text
        updatePromoDisplay(promoText) {
            const textPromoElement = document.getElementById('textPromo');
            if (textPromoElement) {
                textPromoElement.innerText = promoText;
            }
        }

        // Process discount based on promo type
        processPromoDiscount(promoData) {
            switch (promoData.jenisPromo) {
                case "KPR":
                    this.processKPRDiscount(promoData);
                    break;
                case "Cicilan":
                    this.processCicilanDiscount(promoData);
                    break;
                default:
                    this.processGeneralDiscount(promoData);
            }
        }

        // Process KPR discount
        processKPRDiscount(promoData) {
            let totalDiskon = 0;

            if (promoData.statusDiskon === 'persen' && promoData.diskonPromo > 0) {
                const persentase = uangMukaAsli / 100;
                const diskonPercentage = Math.round(priceFinal * persentase);
                totalDiskon = Math.round(diskonPercentage - (diskonPercentage * (promoData.diskonPromo / 100)));
            } else if (promoData.statusDiskon === "rupiah" && promoData.diskonPromo > 0) {
                totalDiskon = Math.round(promoData.diskonPromo);
            }

            const finalDiskon = this.applyMaxDiskon(totalDiskon, promoData.maxDiskon, promoData.statusMaxDiskon);
            return finalDiskon;
        }

        // Process Cicilan discount
        processCicilanDiscount(promoData) {
            const diskonCicilan = document.getElementById('diskon2');
            const diskonCard2 = document.getElementById('cardDiskon2');
            let totalDiskon = 0;

            if (promoData.statusDiskon === "persen") {
                totalDiskon = priceFinal * (promoData.diskonPromo / 100);
            } else if (promoData.statusDiskon === "rupiah") {
                totalDiskon = promoData.diskonPromo;
            }

            // Apply maximum discount limit
            let maxTotalDiskon = 0;
            if (promoData.statusMaxDiskon === "persen") {
                maxTotalDiskon = priceFinal * (promoData.maxDiskon / 100);
            } else {
                maxTotalDiskon = promoData.maxDiskon;
            }

            if (promoData.maxDiskon > 0 && totalDiskon > maxTotalDiskon) {
                totalDiskon = maxTotalDiskon;
            }

            // Update UI
            this.createCicilan(totalDiskon);
            if (diskonCicilan) {
                diskonCicilan.textContent = "Kamu mendapatkan promo sebesar : Rp " + formatRupiah2(totalDiskon);
                diskonCicilan.style.color = "green";
            }
            if (diskonCard2) {
                diskonCard2.style.display = "block";
            }

            // Set discount input
            const diskonInput = document.getElementById('diskonInputCicilan');
            if (diskonInput) {
                diskonInput.value = totalDiskon;
            }
        }

        // Process general discount
        processGeneralDiscount(promoData) {
            const cardDiskon2 = document.getElementById('cardDiskon2');
            const diskon2 = document.getElementById('diskon2');

            if (cardDiskon2) {
                cardDiskon2.style.display = "block";
            }
            if (diskon2) {
                diskon2.innerText = "Sudah dipotong Diskon : Rp. " + formatRupiah2(promoData.diskonPromo);
            }
        }

        // Apply maximum discount constraint
        applyMaxDiskon(diskonPromo, maxDiskon, status) {
            if (maxDiskon == 0) {
                return diskonPromo;
            }

            if (status === 'persen') {
                const maxDiskonValue = (maxDiskon / 100) * priceFinal;
                return Math.min(diskonPromo, maxDiskonValue);
            } else if (status === 'rupiah') {
                return Math.min(diskonPromo, maxDiskon);
            }

            return diskonPromo;
        }

        // Create cicilan options
        createCicilan(totalDiskon) {
            const jumlahHarga = document.getElementById('jumlahHarga');
            if (jumlahHarga) {
                jumlahHarga.value = priceFinal - 10000000 - totalDiskon;
            }

            const cicilanContainer = document.getElementById('cicilan');
            if (!cicilanContainer) return;

            cicilanContainer.innerHTML = ''; // Clear existing content

            const baseAmount = priceFinal - 10000000 - totalDiskon;

            // Update display elements
            this.updateElement('jumlahHargaCicilan', "Jumlah harga Rp. " + formatRupiah2(baseAmount + 10000000));

            // Update hidden input fields
            this.updateInputField('jumlahHarga', (baseAmount + 10000000));

            // Create cicilan options (1-8 months)
            for (let k = 1; k <= 8; k++) {
                const monthlyAmount = k === 1 ? baseAmount : baseAmount / k;
                const formattedAmount = formatRupiah2(monthlyAmount);
                
                const cicilanDiv = document.createElement('div');
                cicilanDiv.className = 'collapse-item';
                cicilanDiv.innerHTML = `
                    <div class="card-shadow">
                        <input type="radio" name="cicilan" value="${k}">
                        <label class="form-check-label">
                            Cicilan ${k} bulan dengan cicilan Rp ${formattedAmount} per bulan
                        </label>
                    </div>
                `;
                cicilanContainer.appendChild(cicilanDiv);
            }
        }

        // Show alert message
        showAlert(container, message, type = 'info') {
            if (container) {
                container.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
            }
        }

        // Close modal
        closeModal() {
            const modal = $('#modelId');
            if (modal.length) {
                modal.modal('hide');
            }
        }
    }

    // Initialize the promo handler when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        new PromoHandler();
    });

    // Legacy support - if jQuery is being used for DOM ready
    $(document).ready(function() {
        if (typeof PromoHandler !== 'undefined') {
            new PromoHandler();
        }
    });
</script>

<script>
    function CekPromo(jenisPromo, statusDiskon, diskonPromo, statusMaxDiskon, maxDiskon) {
        // Check if promo is applicable
        if (!diskonPromo || diskonPromo <= 0) {
            return 0;
        }

        let totalDiskon = 0;
        const hargaRumah = priceFinal;

        // Calculate discount based on type
        if (statusDiskon === 'persen') {
            if (jenisPromo === 'KPR') {
                // For KPR, calculate based on down payment
                const persentase = uangMukaAsli / 100;
                const uangMukaAmount = hargaRumah * persentase;
                totalDiskon = uangMukaAmount * (diskonPromo / 100);
            } else {
                totalDiskon = hargaRumah * (diskonPromo / 100);
            }
        } else if (statusDiskon === 'rupiah') {
            totalDiskon = parseFloat(diskonPromo);
        }

        // Apply maximum discount limit
        if (maxDiskon && maxDiskon > 0) {
            let maxDiskonValue = 0;
            
            if (statusMaxDiskon === 'persen') {
                maxDiskonValue = hargaRumah * (maxDiskon / 100);
            } else if (statusMaxDiskon === 'rupiah') {
                maxDiskonValue = parseFloat(maxDiskon);
            }
            
            if (totalDiskon > maxDiskonValue) {
                totalDiskon = maxDiskonValue;
            }
        }

        return Math.round(totalDiskon);
    }

    function hitung(jumlah, uangmuka, sukuBunga, result, result2, result3, result4, cicilanUM, sisaPengurangan) {
        // Get house price
        const jml = parseFloat(document.getElementById(jumlah).value) || priceFinal;
        
        // Get down payment percentage
        const um = parseFloat(uangMukaAsli) || 10;
        
        // Get cicilan count
        const cicilanCount = parseInt(document.getElementById(cicilanUM).value) || 1;
        
        // Calculate down payment amount (uang muka)
        const hasilUM = jml * (um / 100);
        
        console.log('House Price:', jml);
        console.log('Down Payment %:', um);
        console.log('Down Payment Amount:', hasilUM);
        
        // Check for promo discount
        let hasilPromo = 0;
        let hasilCicilan = 0;
        
        if (typeof statusJumlahDiskon !== 'undefined' && typeof jumlahDiskon !== 'undefined') {
            hasilPromo = CekPromo('KPR', statusJumlahDiskon, jumlahDiskon, statusJumlahMaxDiskon, jumlahMaxDiskon);
            document.getElementById('diskonInputKPR').value = hasilPromo;
        } else {
            document.getElementById('diskonInputKPR').value = 0;
        }
        
        // Calculate down payment after discount
        const uangMukaFinal = hasilUM - hasilPromo;
        
        // Calculate cicilan amount
        if (cicilanCount > 1) {
            hasilCicilan = uangMukaFinal / cicilanCount;
        } else {
            hasilCicilan = uangMukaFinal;
        }
        
        // Calculate remaining KPR amount
        const sisaPembayaran = jml - hasilUM;
        
        console.log('Promo Discount:', hasilPromo);
        console.log('Final Down Payment:', uangMukaFinal);
        console.log('Cicilan Amount:', hasilCicilan);
        console.log('Remaining KPR:', sisaPembayaran);
        
        // Update display
        const hasil = document.getElementById(result);
        const hasil2 = document.getElementById(result2);
        const hasil3 = document.getElementById(result3);
        const hasil4 = document.getElementById(result4);
        const sisa = document.getElementById(sisaPengurangan);
        
        if (hasil) {
            if (hasilPromo > 0) {
                hasil.innerText = `Uang muka Rp ${formatRupiah2(hasilUM)} menjadi Rp ${formatRupiah2(uangMukaFinal)} dari Rp ${formatRupiah2(jml)} dengan diskon Rp ${formatRupiah2(hasilPromo)}`;
            } else {
                hasil.innerText = `Uang muka Rp ${formatRupiah2(hasilUM)} dari Rp ${formatRupiah2(jml)}`;
            }
        }
        
        if (hasil2 && cicilanCount > 1) {
            hasil2.innerText = `Cicilan ${cicilanCount} kali`;
        } else if (hasil2) {
            hasil2.innerText = '';
        }
        
        if (hasil3 && cicilanCount > 1) {
            hasil3.innerText = `Harga cicilan uang muka Rp ${formatRupiah2(hasilCicilan)} (Rp ${formatRupiah2(uangMukaFinal)} : ${cicilanCount})`;
        } else if (hasil3) {
            hasil3.innerText = '';
        }
        
        if (sisa) {
            sisa.innerText = `Sisa Pembayaran KPR Rp ${formatRupiah2(sisaPembayaran)}`;
        }
        
        // Enable next button
        const nextBtn = document.getElementById('nextKPR');
        if (nextBtn) {
            nextBtn.disabled = false;
            nextBtn.style.opacity = "100%";
        }
    }

    function getValue(id) {
        var dataValue = document.getElementById(id);
        dataValue.value = formatRupiah(dataValue.value, '', id);
    }

    function calculatePMT(P, r, n) {
        // Convert the annual interest rate to a monthly rate
        r = r / 1200;

        // Calculate the PMT using the formula
        var PMT = P * r * Math.pow(1 + r, n) / (Math.pow(1 + r, n) - 1);

        // Round the result to two decimal places
        PMT = Math.round(PMT * 100) / 100;

        // Return the PMT
        return PMT;
    }

    function formatRupiah2(angka) {
        var hasilCicilan = Math.round(parseInt((angka / 1000)) * 1000).toString(),
            sisa = hasilCicilan.length % 3,
            rupiah = hasilCicilan.substr(0, sisa),
            ribuan = hasilCicilan.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return rupiah;
    }

    function formatRupiah(angka, prefix, id) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

        document.getElementById(id).value = rupiah;
        return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
    }
</script>
    @endsection
