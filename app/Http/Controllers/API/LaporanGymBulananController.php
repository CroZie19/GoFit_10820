<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Laporan_Aktivitas_Gym_Bulanan;
use App\Models\Member;
use App\Models\Pegawai;
use App\Http\Resources\Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Error;
use Illuminate\Validation\Rule;

class LaporanGymBulananController extends Controller
{
    public function index()
    {
        $laporan_bulanan_gym = Laporan_Aktivitas_Gym_Bulanan::Join('member', 'laporan__aktivitas__gym__bulanans.id_member','=','member.id')
            ->join('transaksi__booking__gyms', 'laporan__aktivitas__gym__bulanans.id_transaksi_booking_gym', '=', 'transaksi__booking__gyms.id_booking_gym')
            ->select('member.nama_member','transaksi__booking__gyms.sesi_gym', 'transaksi__booking__gyms.tanggal_booking_gym')
            ->get();

        if(count($laporan_bulanan_gym)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data' =>$laporan_bulanan_gym,
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
            $laporan_bulanan_gym = Laporan_Aktivitas_Gym_Bulanan::get();

            if($laporan_bulanan_gym!=null){
                return new Response(true, 'Laporan Aktivitas GYM Bulanan successfully displayed!', $laporan_bulanan_gym);
            }else{
                return new Response(false, 'Laporan Aktivitas GYM Bulanan  not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Laporan Aktivitas GYM Bulanan  failed to display!', []);
        }
    }

    public function show(int $id){
        try{
            $laporan_bulanan_gym = Laporan_Aktivitas_Gym_Bulanan::find($id);
            $laporan_bulanan_gym = Laporan_Aktivitas_Gym_Bulanan::Join('member', 'laporan__aktivitas__gym__bulanans.id_member','=','member.id')
            ->join('transaksi__booking__gyms', 'laporan__aktivitas__gym__bulanans.id_transaksi_booking_gym', '=', 'transaksi__booking__gyms.id_booking_gym')
            ->select('member.nama_member','transaksi__booking__gyms.sesi_gym', 'transaksi__booking__gyms.tanggal_booking_gym')
            ->first();

            if($laporan_bulanan_gym!=null){
                return new Response(true, 'Laporan Aktivitas GYM Bulanan found!', $laporan_bulanan_gym);               
            }else{
                return new Response(false, 'Laporan Aktivitas GYM Bulanan  not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Laporan Aktivitas GYM Bulanan  failed to display!', []);
        }
    }

}