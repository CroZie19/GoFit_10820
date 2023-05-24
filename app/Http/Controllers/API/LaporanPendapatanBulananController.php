<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi_Aktivasi_Tahunan;
use App\Models\Transaksi_Deposit_Uang;
use App\Models\Transaksi_Deposit_Kelas;
use App\Models\Laporan_Pendapatan_Bulanan; 
use App\Models\Member;
use App\Models\Pegawai;
use App\Http\Resources\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Error;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

class LaporanPendapatanBulananController extends Controller
{
    public function index()
    {
        $laporan_pendapatan_bulanan = Laporan_Pendapatan_Bulanan::Join('transaksi__aktivasi__tahunan', 'laporan__pendapatan__bulanans.id_aktivasi_tahunan','=','transaksi__aktivasi__tahunans.id')
            ->Join('transaksi__deposit__kelas', 'laporan__pendapatan__bulanans.id_transaksi_deposit_kelas','=','transaksi__deposit__kelas.id')
            ->Join('transaksi__deposit__uangs', 'laporan__pendapatan__bulanans.id_transaksi_deposit_uang','=','transaksi__deposit__uangs.id')
            ->select('transaksi__aktivasi__tahunans.id', 'transaksi__aktivasi__tahunans.tanggal_transaksi_aktivasi', 'transaksi__aktivasi__tahunans.jumlah_pembayaran_aktivasi', 'transaksi__deposit__kelas.id','transaksi__deposit__kelas.tanggal_transaksi_deposit_kelas', 'tanggal_transaksi_deposit_kelas.total_pembayaran_deposit_kelas', 'transaksi__deposit__uangs.id', 'transaksi__deposit__uangs.total_pembayaran_deposit_uang', 'transaksi__deposit__uangs.tanggal_transaksi_deposit_uang', 'laporan__pendapatan__bulanans.*')
            ->get();

        if(count($laporan_pendapatan_bulanan)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data' =>$laporan_pendapatan_bulanan,
                'success' => true
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],400);
    }

    public function showList(){
        try{
            $laporan_pendapatan_bulanan = Laporan_Pendapatan_Bulanan::get();

            if($laporan_pendapatan_bulanan!=null){
                return new Response(true, 'Laporan Pendapatan Bulanan successfully displayed!', $laporan_pendapatan_bulanan);
            }else{
                return new Response(false, 'Laporan Pendapatan Bulanan not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Laporan Pendapatan Bulanan to display!', []);
        }
    }

    public function show($id){
        //ini untuk menampilkan jumlah pendapatan aktivasi member
        $Aktivasi  = Transaksi_Aktivasi_Tahunan::selectRaw('MONTH(transaksi__aktivasi__tahunans.created_at) as bulan, SUM(transaksi__aktivasi__tahunans.jumlah_pembayaran_aktivasi) as jumlah_aktivasi')
            ->groupBy('bulan')
            ->whereYear('transaksi__aktivasi__tahunans.created_at', $id)
            ->get();

        //Ini untuk menampilkan jumlah pendapatan deposit kelas menggunakan tabel transaksi deposit kelas dengan komen Raw untuk mengambil perintah mentah yang tidak disediakan laravel seperti month dan sum
        $DepositKelas  = Transaksi_Deposit_Kelas::selectRaw('MONTH(transaksi__deposit__kelas.created_at) as bulan, SUM(transaksi__deposit__kelas.jumlah_deposit_kelas) as jumlah_deposit_kelas')
            ->groupBy('bulan')
            ->whereYear('transaksi__deposit__kelas.created_at', $id)
            ->get();

        $DepositUang  = Transaksi_Deposit_Uang::selectRaw('MONTH(transaksi__deposit__uangs.created_at) as bulan, SUM(transaksi__deposit__uangs.jumlah_deposit_uang) as jumlah_deposit_uang')
            ->groupBy('bulan')
            ->whereYear('transaksi__deposit__uangs.created_at', $id)
            ->get();

        $ItemToShow['Jumlah_Aktivasi'] = $Aktivasi;
        $ItemToShow['Jumlah_Deposit_Kelas'] = $DepositKelas;
        $ItemToShow['Jumlah_Deposit_Uang'] = $DepositUang;

        if(count($ItemToShow['Jumlah_Aktivasi'])<=0 || count($ItemToShow['Jumlah_Deposit_Kelas'])<=0 || count($ItemToShow['Jumlah_Deposit_Uang'])<=0){
            return response([
                'message' => 'Pendapatan Bulanan Tidak Ditemukan!',
                'success' => false
            ],400);      
        }
        return response([
            'message' => 'Pendapatan Bulanan Berhasil Ditampilkan!',
            'data' =>$ItemToShow,
            'success' => true
        ],200);      


    }

}