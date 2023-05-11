<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Jadwal_Harian;
use App\Http\Resources\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Error;
use Illuminate\Validation\Rule;

class JadwalHarianController extends Controller
{

    // public function index()
    // {
    //     //get posts
    //     $jadwal_harian = Jadwal_Harian::latest()->get();
    //     //render view with posts
    //     return new Response(true, 'List Data Jadwal Harian', $jadwal_harian);
    // }

    public function index()
    {
        $jadwal_harian = Jadwal_Harian::Join('kelas', 'jadwal_harian.id_kelas','=','kelas.id')
            ->Join('instruktur', 'jadwal_harian.id_instruktur','=','instruktur.id')
             ->select('instruktur.nama_instruktur','kelas.jenis_kelas','jadwal_harian.status_kelas_harian','jadwal_harian.tanggal_kelas_harian','jadwal_harian.id')
            ->get();

        if(count($jadwal_harian)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data' =>$jadwal_harian,
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
            $jadwal_harian = Jadwal_Harian::get();

            if($jadwal_harian->isNotEmpty()){
                return new Response(true, 'Jadwal Harian successfully displayed!', $jadwal_harian);
            }else{
                return new Response(false, 'Jadwal Harian not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Jadwal Harian failed to display!', []);
        }
    }

    public function show(int $id){
        try{

            $jadwal_harian = Jadwal_Harian::Join('kelas', 'jadwal_harian.id_kelas','=','kelas.id')
            ->Join('instruktur', 'jadwal_harian.id_instruktur','=','instruktur.id')
            ->select('instruktur.nama_instruktur','kelas.jenis_kelas','jadwal_harian.status_kelas_harian','jadwal_harian.tanggal_kelas_harian','jadwal_harian.id')
            ->where('jadwal_harian.id',$id )
            ->first();
            if($jadwal_harian!=null){
                return new Response(true, 'Jadwal Harian found!', $jadwal_harian);               
            }else{
                return new Response(false, 'Jadwal Harian not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Jadwal Harian failed to display!', []);
        }
    }

    public function add(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'id_kelas' => 'required',
                'id_istruktur'=> 'required',
                'status_kelas_harian' => 'required',
                'tanggal_kelas_harian' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            Jadwal_Harian::create([
                'id_kelas' => $request->id_kelas,
                'id_instruktur' => $request->id_instruktur,
                'status_kelas_harian' => $request->status_kelas_harian,
                'tanggal_kelas_harian' => $request->tanggal_kelas_harian,                
            ]);
    
            return new Response(true, 'Jadwal Harian successfully added!', []);            
        }catch (Error $message){
            return new Response(false, 'Jadwal Harian failed to added!', []);
        }
    }

    public function update(Request $request, int $id){
        try{
            $jadwal_harian = Jadwal_Harian::find($id);

            if($jadwal_harian->isNotEmpty()){
                $validator = Validator::make($request->all(), [
                    'id_kelas' => 'required',
                    'id_istruktur'=> 'required',
                    'status_kelas_harian' => 'required',
                    'tanggal_kelas_harian' => 'required',
                ]);

                if($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                $jadwal_harian->update([
                    'id_kelas' => $request->id_kelas,
                    'id_instruktur' => $request->id_instruktur,
                    'status_kelas_harian' => $request->status_kelas_harian,
                    'tanggal_kelas_harian' => $request->tanggal_kelas_harian,
                ]);
            
                return new Response(true, 'Jadwal Harian successfully updated!', []);        
            }else{
                return new Response(false, 'Jadwal Harian not found!', []);
            }
        }catch (Error $message){
            return new Response(false, 'Jadwal Harian failed to updated!', []);
        }
    }

    public function destroy(int $id){
        try{
            $jadwal_harian = Jadwal_Harian::find($id);

            if($jadwal_harian->isNotEmpty()){
                $jadwal_harian->update([
                    'isdelete' => true,
                ]);
                
                return new Response(true, 'Jadwal Harian successfully deleted!', []);
            }else{
                return new Response(false, 'Jadwal Harian not found', []);
            }
        }catch (Error $message){
            return new Response(true, 'Jadwal Harian failed to delete!', []);
        }
    }

}