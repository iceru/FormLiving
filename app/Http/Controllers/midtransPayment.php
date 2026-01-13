<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Mail;
use PDF;

class midtransPayment extends Controller
{
    public function successPayment()
    {

        return view('congratulation-payment');
    }

    public function paymentSummary($id_fp)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $pelanggan = DB::table('formulir_pesanan')
            ->join('user_pelanggan', 'formulir_pesanan.id_pelanggan', '=', 'user_pelanggan.id_pelanggan')->where([
                'id_formulir' => $id_fp,
            ])->first();

        $payment = DB::table('pembayaran_rumah')->where([
            'id_formulir' => $id_fp
        ])->first();

        $key_rumah = $pelanggan->id_rumah;
        $key_tipe = $pelanggan->id_tipe_rumah;

        $tipeRumah = DB::table('tipe_rumah')->where([
            'id_tipe_rumah' => $key_tipe,
        ])->first();

        $rumah = DB::table('rumah')
            ->join('cluster', 'rumah.codecluster', '=', 'cluster.codecluster')
            ->where('id_rumah', '=', $key_rumah)
            ->first();
        $currentDate = Carbon::now()->format("ymd");
        $orderID = "GL-" . $pelanggan->id_formulir . Carbon::now()->format("h") . Carbon::now()->format("i") . "-" . $currentDate . $rumah->blok . "-" . $payment->id_pem_rumah . Carbon::now()->format("m");

        $params = array(
            'transaction_details' => array(
                'order_id' => $orderID,
                'gross_amount' => $payment->harga_pr,
            ),
            'customer_details' => array(
                'first_name' => $pelanggan->nama_plgn,
                'email' => $pelanggan->email_plgn,
                'phone' => $pelanggan->no_telp_plgn,
            ),
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('paymentSummary', compact('tipeRumah', 'rumah', 'payment', 'pelanggan', 'snapToken'));
    }
}
