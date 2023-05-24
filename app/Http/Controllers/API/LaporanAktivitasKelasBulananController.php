<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Laporan_Aktivitas_Kelas_Bulanan;
use App\Models\Member;
use App\Http\Resources\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Error;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

class LaporanAktivitasKelasBulananController extends Controller
{
    public function index()
    {
        $laporan_kelas_bulanan = Laporan_Aktivitas_Kelas_Bulanan::Join('member', 'laporan__aktivitas__kelas__bulanans.id_member','=','member.id')
            ->Join('kelas', 'laporan__aktivitas__kelas__bulanans.id_kelas','=','kelas.id')
            ->Join('instruktur', 'laporan__aktivitas__kelas__bulanans.id_instruktur','=','instruktur.id')
            ->Join('transaksi__booking__kelas', 'laporan__aktivitas__kelas__bulanans.id_booking_kelas', '=', 'transaksi__booking__kelas.id_booking_kelas' )
            ->select('transaksi__booking__kelas.id_booking_kelas', 'member.nama_member','kelas.jenis_kelas','transaksi__booking__kelas.tanggal_booking_kelas')
            ->get();

        if(count($laporan_kelas_bulanan)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data' =>$laporan_kelas_bulanan,
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
            $laporan_kelas_bulanan = Laporan_Aktivitas_Kelas_Bulanan::get();

            if($laporan_kelas_bulanan!=null){
                return new Response(true, 'Laporan Aktivitas Kelas Bulanan successfully displayed!', $laporan_kelas_bulanan);
            }else{
                return new Response(false, 'Laporan Aktivitas Kelas Bulanan  not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Laporan Aktivitas Kelas Bulanan to display!', []);
        }
    }

    public function show(int $id){
        try{
            $laporan_kelas_bulanan = Laporan_Aktivitas_Kelas_Bulanan::find($id);
            $laporan_kelas_bulanan = Laporan_Aktivitas_Kelas_Bulanan::Join('member', 'laporan__aktivitas__kelas__bulanans.id_member','=','member.id')
            ->Join('kelas', 'laporan__aktivitas__kelas__bulanans.id_kelas','=','kelas.id')
            ->Join('instruktur', 'laporan__aktivitas__kelas__bulanans.id_instruktur','=','instruktur.id')
            ->Join('transaksi__booking__kelas', 'laporan__aktivitas__kelas__bulanans.id_booking_kelas', '=', 'transaksi__booking__kelas.id_booking_kelas' )
            ->select('transaksi__booking__kelas.id_booking_kelas', 'member.nama_member','kelas.jenis_kelas','transaksi__booking__kelas.tanggal_booking_kelas')
            ->first();

            if($laporan_kelas_bulanan!=null){
                return new Response(true, 'Laporan Aktivitas Kelas Bulanan found!', $laporan_bulanan_gym);               
            }else{
                return new Response(false, 'Laporan Aktivitas Kelas Bulanan not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Laporan Aktivitas Kelas Bulanan failed to display!', []);
        }
    }

}