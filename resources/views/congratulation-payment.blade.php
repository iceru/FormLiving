@extends('HomeLayout.app')
@extends('HomeLayout.navbar')
@extends('HomeLayout.footer')
@extends('flashdata')
@section('tittle', 'Forms | Congratulation')
@section('body', '')

@section('content')

    <div class="congratulation">
        <div class="header-detail mobile-only">
            <div class="sliders">
                <div class="item">
                    <div class="item-img">
                        <img src="{{ asset('Home') }}/images/img-cluster-large3.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="logo">
                <img src="{{ asset('Home') }}/images/logo-tidar-green-large.png" class="desktop-only"
                    alt="Greenland at Tidar">
                <img src="{{ asset('Home') }}/images/logo-tidar-gray.png" class="mobile-only" alt="Greenland at Tidar">
            </div>
            <div class="logo-check">
                <img src="{{ asset('Home') }}/images/ic-success.png" alt="">
            </div>
            <h1>Berhasil!</h1>
            <p class="light-grey-color">
                Pembayaran telah berhasil dilakukan, mohon menunggu konfirmasi pembayaran melalui email atau whatsapp anda.
            </p>
            <a href="https://formsliving.com" class="btn btn-primary">Kembali ke Beranda</a>
        </div>
    </div>


@endsection
