@extends('HomeLayout.app')
@extends('HomeLayout.navbar')
@extends('HomeLayout.navbarProfile')
@extends('HomeLayout.sidebar')
@extends('HomeLayout.footer')
@extends('HomeLayout.footerbranch')
@section('tittle','Forms | Syarat dan Ketentuan')
@section('body','index')


@section('content')
<div class="info-page">
    <div class="container">
        <div class="title">
            About Forms Living
            <br>
              <img style=width:30%;height:30%;" src="{{ asset('Home') }}/images/fl-logo.png" alt="FORMS Living">
        </div>
       
        <div class="item">
           <h6>Apa itu Forms Living</h6>
            <p>
            Forms Living adalah Aplikasi penjualan properti Multi Project internal berbasis web.
               Forms Living memiliki fitur penjualan direct selling end-customer, agent property dan sales inhouse masing masing project.
                Forms Living sendiri juga merupakan salah satu bagian dari aplikasi penunjang bisnis properti terpusat FORMS.
            </p>
            
          <h6>Sejarah Form Living di Malang</h6>
            <p>
                Form Living memulai kegiatan operasionalnya di Malang pada tahun 2014. saat itu. Proyek yang dilakukan adalah perumahan Greenland at At Tidar dan telah berhasil membangun proyek perumahan yang berkualitas dan terjangkau di daerah Tidar.
            </p>
            <h6>Lokasi Proyek Form Living di Malang
            </h6>
            <p>Form Living memiliki beberapa proyek perumahan di Malang yang tersebar di beberapa lokasi strategis seperti di daerah Tidar. Setiap lokasi proyek dirancang sedemikian rupa agar mudah diakses dan dekat dengan fasilitas umum seperti pusat perbelanjaan, pusat kesehatan, dan sekolah.
            </p>
            <h6>Jenis Properti yang Ditawarkan
            </h6>
            <p>Form Living menawarkan berbagai jenis properti di kota Malang, mulai dari rumah stok, rumah cluster, hingga kedepannya apartemen. Setiap jenis properti yang ditawarkan didesain dengan konsep- konsep yang modern dan fungsional, serta menggunakan bahan-bahan yang berkualitas.
            </p>

 </div>
       
    </div>
</div>

@endsection
