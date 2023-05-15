<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi_Booking_Kelas;
use App\Models\Member;
use App\Models\Pegawai;
use App\Http\Resources\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Error;
use Illuminate\Validation\Rule;

class TransaksiBookingKelasController extends Controller
{
    public function index()
    {
        $transaksi_booking_kelas = Transaksi_Booking_Kelas::Join('member', 'transaksi__booking__gyms.id_member','=','member.id')
            ->Join('pegawai', 'transaksi__booking__gyms.id_pegawai','=','pegawai.id')
            ->select('member.nama_member','pegawai.nama_pegawai','transaksi__booking__gyms.sesi_gym', 'transaksi__booking__gyms.tanggal_booking_gym')
            ->get();

        if(count($transaksi_booking_kelas)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data' =>$transaksi_booking_kelas,
                'success' => true
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],400);
    }

    // public function store(Request $request){

    //     $id = IdGenerator::generate(['table' => 'todos', 'length' => 6, 'prefix' => date('y')]);
    
    //     $todo = new Todo();
    //     $todo->id = $id;
    //     $todo->title = $request->get('title');
    //     $todo->save();
    
    // }

    public function showList(){
        try{
            $transaksi_booking_kelas = Transaksi_Booking_Kelas::get();

            if($transaksi_booking_kelas!=null){
                return new Response(true, 'Presensi Booking Gym successfully displayed!', $transaksi_booking_kelas);
            }else{
                return new Response(false, 'Presensi Booking Gym not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Presensi Booking Gym failed to display!', []);
        }
    }

    public function show(int $id){
        try{
            $transaksi_booking_kelas = Transaksi_Booking_Kelas::find($id);
            $transaksi_booking_kelas = Transaksi_Booking_Kelas::Join('member', 'transaksi__booking__gyms.id_member','=','member.id')
            ->Join('pegawai', 'transaksi__booking__gyms.id_pegawai','=','pegawai.id')
            ->select('member.nama_member','pegawai.nama_pegawai','transaksi__booking__gyms.sesi_gym', 'transaksi__booking__gyms.tanggal_booking_gym')
            ->where('transaksi__booking__gyms.id',$id )
            ->first();

            if($transaksi_booking_kelas!=null){
                return new Response(true, 'Presensi Booking Gym found!', $transaksi_booking_kelas);               
            }else{
                return new Response(false, 'Presensi Booking Gym not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Presensi Booking Gym failed to display!', []);
        }
    }

    public function add(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'id_jadwal_harian' => 'required',
                'id_istruktur'=> 'required',
                'tanggal_perijinan_instruktur' => 'required',
                'sesi_perijinan_instruktur' => 'required',
                'keterangan_perijinan_instruktur' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            Transaksi_Booking_Kelas::create([
                'id_jadwal_harian' => $request->id_jadwal_harian,
                'id_instruktur' => $request->id_instruktur,
                'tanggal_perijinan_instruktur' => $request->tanggal_perijinan_instruktur,
                'sesi_perijinan_instruktur' => $request->sesi_perijinan_instruktur,
                'keterangan_perijinan_instruktur' => $request->keterangan_perijinan_instruktur,                
            ]);
    
            return new Response(true, 'Presensi Booking Gym successfully added!', []);            
        }catch (Error $message){
            return new Response(false, 'Presensi Booking Gym failed to added!', []);
        }
    }

    public function update(Request $request, int $id){
        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'id_kelas' => 'required',
            'id_instruktur'=> 'required',
            'id_jadwal_harian'=> 'required',
            'tanggal_kelas_harian' => 'required',
        ]);

       // $nama_pengganti = Instruktur::where('instruktur.id', $updateData['id_instruktur'])->value('nama_instruktur');

        
        if($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        // Transaksi_Booking_Gym::where('transaksi__s.id',$id )
        //     ->update([
        //         'konfirmasi_perijinan' => 1, 
        //     ]);
        
        // $jadwal_harian = Jadwal_Harian::select('jadwal_harian.*')->where('jadwal_harian.id',$updateData['id_jadwal_harian'])->first();
        // $jadwal_harian->id_kelas = $updateData['id_kelas'];
        // $jadwal_harian->id_instruktur = $updateData['id_instruktur'];
        // $jadwal_harian->status_kelas_harian = 'Kelas ini digantikan oleh instruktur '.$nama_pengganti;
        // $jadwal_harian->tanggal_kelas_harian = $updateData['tanggal_kelas_harian'];
        
        // if($jadwal_harian->save()){
        //     return response([
        //         'message' => 'Jadwal Harian successfully updated, Perijinan Berhasil!',
        //         'data' =>$jadwal_harian,
        //         'success' => true
        //     ],200);      
        // }
    }

    public function destroy(int $id){
        try{
            $transaksi_booking_kelas = Transaksi_Booking_Kelas::find($id);

            if($transaksi_booking_kelas->isNotEmpty()){
                $transaksi_booking_kelas->update([
                    'isdelete' => true,
                ]);
                
                return new Response(true, 'Presensi Booking Gym successfully deleted!', []);
            }else{
                return new Response(false, 'Presensi Booking Gym not found', []);
            }
        }catch (Error $message){
            return new Response(true, 'Presensi Booking Gym failed to delete!', []);
        }
    }

}