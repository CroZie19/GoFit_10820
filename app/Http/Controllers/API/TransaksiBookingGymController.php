<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi_Booking_Gym;
use App\Models\Member;
use App\Models\Pegawai;
use App\Http\Resources\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Error;
use Illuminate\Validation\Rule;

class TransaksiBookingGymController extends Controller
{
    public function index()
    {
        $transaksi_booking_gym = Transaksi_Booking_Gym::Join('member', 'transaksi__booking__gyms.id_member','=','member.id')
            ->Join('pegawai', 'transaksi__booking__gyms.id_pegawai','=','pegawai.id')
            ->select('member.nama_member','pegawai.nama_pegawai','transaksi__booking__gyms.sesi_gym', 'transaksi__booking__gyms.tanggal_booking_gym')
            ->get();

        if(count($transaksi_booking_gym)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data' =>$transaksi_booking_gym,
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
            'id_pegawai' => 'required',
            'sesi_gym' => 'required',
            'jumlah_kapasitas_gym' => 'required',
            'tanggal_booking_gym' => 'required',
        ]);
        $id = IdGenerator::generate(['table' => 'transaksi__booking__gyms', 'length' => 10, 'prefix' => 'INV']);
    
        $Transaksi_Booking_Gym = new Transaksi_Booking_Gym();
        $Transaksi_Booking_Gym->id_booking_kelas = $id;
        $Transaksi_Booking_Gym->id_member = $storeData['id_member'];
        $Transaksi_Booking_Gym->id_pegawai = $storeData['id_pegawai'];
        $Transaksi_Booking_Gym->sesi_gym = $storeData['sesi_gym'];
        $Transaksi_Booking_Gym->jumlah_kapasitas_gym = $storeData['jumlah_kapasitas_gym'];
        $Transaksi_Booking_Gym->tanggal_booking_gym = $storeData['tanggal_booking_gym'];
        $Transaksi_Booking_Gym->save();

        if($Transaksi_Booking_Gym->save()){
            return response([
                'message' => 'Tambah traksaksi booking gym berhasil!',
                'data' =>$Transaksi_Booking_Gym,
                'success' => true
            ],200);      
        }else{
            return response([
                'message' => 'Tambah traksaksi booking gym gagal!',
                'success' => false
            ],200); 
        }
    
    }

    public function showList(){
        try{
            $transaksi_booking_gym = Transaksi_Booking_Gym::get();

            if($transaksi_booking_gym!=null){
                return new Response(true, 'Presensi Booking Gym successfully displayed!', $transaksi_booking_gym);
            }else{
                return new Response(false, 'Presensi Booking Gym not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Presensi Booking Gym failed to display!', []);
        }
    }

    public function show(int $id){
        try{
            $transaksi_booking_gym = Transaksi_Booking_Gym::find($id);
            $transaksi_booking_gym = Transaksi_Booking_Gym::Join('member', 'transaksi__booking__gyms.id_member','=','member.id')
            ->Join('pegawai', 'transaksi__booking__gyms.id_pegawai','=','pegawai.id')
            ->select('member.nama_member','pegawai.nama_pegawai','transaksi__booking__gyms.sesi_gym', 'transaksi__booking__gyms.tanggal_booking_gym')
            ->where('transaksi__booking__gyms.id',$id )
            ->first();

            if($transaksi_booking_gym!=null){
                return new Response(true, 'Presensi Booking Gym found!', $transaksi_booking_gym);               
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
                'id_member' => 'required',
                'id_pegawai'=> 'required',
                'sesi_gym' => 'required',
                'jumlah_kapasitas_gym' => 'required',
                'tanggal_booking_gym' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            Transaksi_Booking_Gym::create([
                'id_member' => $request->id_member,
                'id_pegawai' => $request->id_pegawai,
                'sesi_gym' => $request->sesi_gym,
                'jumlah_kapasitas_gym' => $request->jumlah_kapasitas_gym,
                'tanggal_booking_gym' => $request->tanggal_booking_gym,                
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
            'id_pegawai' => 'required',
            'sesi_gym' => 'required',
            'jumlah_kapasitas_gym' => 'required',
            'tanggal_booking_gym' => 'required',
        ]);

        $Transaksi_Booking_Gym = Transaksi_Booking_Gym::where('transaksi__booking__gyms.id_booking_kelas', $id)->first();
        
        if($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }
        
        $Transaksi_Booking_Gym->id_member = $updateData['id_member'];
        $Transaksi_Booking_Gym->id_pegawai = $updateData['id_pegawai'];
        $Transaksi_Booking_Gym->sesi_gym = $updateData['sesi_gym'];
        $Transaksi_Booking_Gym->jumlah_kapasitas_gym = $updateData['jumlah_kapasitas_gym'];
        $Transaksi_Booking_Gym->tanggal_booking_gym = $updateData['tanggal_booking_gym'];
        $Transaksi_Booking_Gym->save();
        
        if($Transaksi_Booking_Gym->save()){
            return response([
                'message' => 'transaksi booking gym successfully updated!',
                'data' =>$Transaksi_Booking_Gym,
                'success' => true
            ],200);      
        }
    }

    public function destroy(int $id){
        try{
            $transaksi_booking_gym = Transaksi_Booking_Gym::find($id);

            if($transaksi_booking_gym->isNotEmpty()){
                $transaksi_booking_gym->update([
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