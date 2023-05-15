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

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'id_member' => 'required',
            'id_kelas' => 'required',
            'id_instruktur' => 'required',
            'id_transaksi_deposit_kelas' => 'required',
            'id_transaksi_deposit_uang' => 'required',
            'sesi_kelas' => 'required',
            'tanggal_booking_kelas' => 'required',
        ]);
        $id = IdGenerator::generate(['table' => 'transaksi__booking__kelas', 'length' => 10, 'prefix' => 'INV']);
    
        $Transaksi_Booking_Kelas = new Transaksi_Booking_Kelas();
        $Transaksi_Booking_Kelas->id_booking_kelas = $id;
        $Transaksi_Booking_Kelas->id_member = $storeData['id_member'];
        $Transaksi_Booking_Kelas->id_kelas = $storeData['id_kelas'];
        $Transaksi_Booking_Kelas->id_instruktur = $storeData['id_instruktur'];
        $Transaksi_Booking_Kelas->id_transaksi_deposit_kelas = $storeData['id_transaksi_deposit_kelas'];
        $Transaksi_Booking_Kelas->id_transaksi_deposit_uang = $storeData['id_transaksi_deposit_uang'];
        $Transaksi_Booking_Kelas->sesi_kelas = $storeData['sesi_kelas'];
        $Transaksi_Booking_Kelas->tanggal_booking_kelas = $storeData['tanggal_booking_kelas'];
        $Transaksi_Booking_Kelas->save();

        if($Transaksi_Booking_Kelas->save()){
            return response([
                'message' => 'Tambah traksaksi booking kelas berhasil!',
                'data' =>$Transaksi_Booking_Kelas,
                'success' => true
            ],200);      
        }else{
            return response([
                'message' => 'Tambah traksaksi booking kelas gagal!',
                'success' => false
            ],200); 
        }
    
    }

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
            'id_member' => 'required',
            'id_kelas' => 'required',
            'id_instruktur' => 'required',
            'id_transaksi_deposit_kelas' => 'required',
            'id_transaksi_deposit_uang' => 'required',
            'sesi_kelas' => 'required',
            'tanggal_booking_kelas' => 'required',
        ]);

       $Transaksi_Booking_Kelas = Transaksi_Booking_Kelas::where('transaksi__booking__kelas.id_booking_kelas', $id)->first();

        
        if($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }
        $Transaksi_Booking_Kelas->id_member = $updateData['id_member'];
        $Transaksi_Booking_Kelas->id_kelas = $updateData['id_kelas'];
        $Transaksi_Booking_Kelas->id_instruktur = $updateData['id_instruktur'];
        $Transaksi_Booking_Kelas->id_transaksi_deposit_kelas = $updateData['id_transaksi_deposit_kelas'];
        $Transaksi_Booking_Kelas->id_transaksi_deposit_uang = $updateData['id_transaksi_deposit_uang'];
        $Transaksi_Booking_Kelas->sesi_kelas = $updateData['sesi_kelas'];
        $Transaksi_Booking_Kelas->tanggal_booking_kelas = $updateData['tanggal_booking_kelas'];
        $Transaksi_Booking_Kelas->save();
        
        if($Transaksi_Booking_Kelas->save()){
            return response([
                'message' => 'Tambah traksaksi booking kelas berhasil!',
                'data' =>$Transaksi_Booking_Kelas,
                'success' => true
            ],200);      
        }else{
            return response([
                'message' => 'Tambah traksaksi booking kelas gagal!',
                'success' => false
            ],200); 
        }
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