<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Z0YJJK1HQ7"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-Z0YJJK1HQ7');
    </script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('tittle')</title>

    <!--trial costum css-->
    <style>
        .balloon {
            position: relative;
            background: white;
            /* Your desired background color */
            /* other styling for your dropdown item */
        }

        .balloon:after {
            content: '';
            position: absolute;
            top: 100%;
            /* Positioning the triangle at the bottom of the balloon */
            left: 50%;
            /* Centering the triangle */
            margin-left: -10px;
            /* Adjust as necessary */
            border-width: 10px;
            /* Adjust size of the triangle */
            border-style: solid;
            border-color: white transparent transparent transparent;
            /* The first value is the color of the triangle */
        }
    </style>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.2/font/bootstrap-icons.min.css"
        integrity="sha512-YzwGgFdO1NQw1CZkPoGyRkEnUTxPSbGWXvGiXrWk8IeSqdyci0dEDYdLLjMxq1zCoU0QBa4kHAFiRhUL3z2bow=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"
        integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"
        integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Home') }}/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
        integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-vTWYJF0ArZJ0ikwB"></script>
</head>

<body>
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
        </div>
        <div class="container">
            <div>
                <div class="second-layout">
                    <div class="row">
                        <div class="col-12 order-2 order-lg-1" style="margin-top: 3rem;">
                            <h2 class="title">
                                Detail Pembayaran
                            </h2>
                        </div>
                        <div class="col-12 col-lg-4 left-column order-1 order-lg-2">
                            <div class="mod-type">
                                <div class="type-image">
                                    <?php
                                            if(!empty($rumah->img_tr)){
                                                ?>
                                    <img src="{{ asset('Home') }}/images/rumah/{{ $rumah->img_tr }}" alt="">
                                    <?php
                                            }else{
                                            ?>

                                    <img src="{{ asset('Home') }}/images/img-cluster-large3.png" alt="">
                                    <?php
                                            }
                                        ?>
                                </div>
                                <div class="items">
                                    <div class="type-item">
                                        <p>Type</p>
                                        <h5>{{ $tipeRumah->jenis_tr }}</h5>
                                    </div>
                                    <div class="type-item">
                                        <p>Blok</p>
                                        <h5>{{ $rumah->blok }} - {{ $rumah->nomor }}</h5>
                                    </div>
                                    <div class="type-item">
                                        <p>Cluster</p>
                                        <h5>{{ $rumah->nama_cluster }}</h5>
                                    </div>
                                    <div class="type-item">
                                        <p>Luas Tanah</p>
                                        <h5>{{ $rumah->luas_tanah }} m<sup>2</sup></h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-8 right-column order-3">
                            @csrf
                            <div class="row summary">
                                <div class="col-5 col-lg-4">
                                    <p>Nama (Sesuai KTP)</p>
                                </div>
                                <div class="col-7 col-lg-8">
                                    <p>{{ $pelanggan->nama_plgn }}</p>
                                </div>
                                <div class="col-5 col-lg-4">
                                    <p>NIK</p>
                                </div>
                                <div class="col-7 col-lg-8">
                                    <p>{{ $pelanggan->no_ktp_plgn }}</p>
                                </div>
                                <div class="col-5 col-lg-4">
                                    <p>No. Whatsapp (Aktif)</p>
                                </div>
                                <div class="col-7 col-lg-8">
                                    <p>{{ $pelanggan->no_wa_plgn }}</p>
                                </div>
                                <div class="col-5 col-lg-4">
                                    <p>Alamat</p>
                                </div>
                                <div class="col-7 col-lg-8">
                                    <p>{{ $pelanggan->alamat_plgn }}</p>
                                </div>
                                <div class="col-5 col-lg-4">
                                    <p>Email</p>
                                </div>
                                <div class="col-7 col-lg-8">
                                    <p>{{ $pelanggan->email_plgn }}</p>
                                </div>
                                <div class="col-5 col-lg-4">
                                    <p>Cluster / Blok</p>
                                </div>
                                <div class="col-7 col-lg-8">
                                    <p>{{ $rumah->nama_cluster }} / {{ $rumah->blok }} - {{ $rumah->nomor }}</p>
                                </div>
                                <div class="col-5 col-lg-4">
                                    <p>Luas Tanah</p>
                                </div>
                                <div class="col-7 col-lg-8">
                                    <p>{{ $rumah->luas_tanah }} m2</p>
                                </div>
                                <div class="col-5 col-lg-4">
                                    <p>Tipe Rumah</p>
                                </div>
                                <div class="col-7 col-lg-8">
                                    <p>{{ $tipeRumah->jenis_tr }}</p>
                                </div>
                                <div class="col-5 col-lg-4">
                                    <p>Pembayaran untuk </p>
                                </div>
                                <div class="col-7 col-lg-8">
                                    <p>{{ $payment->detail_pr }}</p>
                                </div>

                                <div class="col-5 col-lg-4">
                                    <p>Harga yang perlu dibayar</p>
                                </div>
                                <div class="col-7 col-lg-8">
                                    <p>Rp. {{ rupiah($payment->harga_pr) }},-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-groups">
                    <button type="submit" id="pay-button" class="btn btn-success">Bayar</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    window.location.href = "/payment-success";
                    console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });
    </script>
</body>

</html>
