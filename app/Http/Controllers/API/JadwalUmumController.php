<?php

namespace App\Http\Controllers;

use App\Models\Jadwal_Umum;
use App\Http\Resources\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Error;
use Illuminate\Validation\Rule;

class JadwalUmumController extends Controller
{

    public function index()
    {
        //get posts
        $jadwal_umum = Jadwal_Umum::latest()->get();
        //render view with posts
        return new Response(true, 'List Data Jadwal Umum', $jadwal_umum);
    }


    public function showList(){
        try{
            $jadwal_umum = Jadwal_Umum::get();

            if($jadwal_umum->isNotEmpty()){
                return new Response(true, 'Jadwal Umum successfully displayed!', $jadwal_umum);
            }else{
                return new Response(false, 'Jadwal Umum not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Jadwal Umum failed to display!', []);
        }
    }

    public function show(int $id){
        try{
            $jadwal_umum = Jadwal_Umum::find($id);

            if($jadwal_umum->isNotEmpty()){
                return new Response(true, 'Jadwal Umum found!', $jadwal_umum);               
            }else{
                return new Response(false, 'Jadwal Umum not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Jadwal Umum failed to display!', []);
        }
    }

    public function add(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'hari_kelas_umum' => 'required',
                'jam_kelas_umum' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            Jadwal_Umum::create([
                'hari_kelas_umum' => $request->hari_kelas_umum,
                'jam_kelas_umum' => $request->jam_kelas_umum,
            ]);
    
            return new Response(true, 'Jadwal Umum successfully added!', []);            
        }catch (Error $message){
            return new Response(false, 'Jadwal Umum failed to added!', []);
        }
    }

    public function update(Request $request, int $id){
        try{
            $jadwal_umum = Jadwal_Umum::find($id);

            if($jadwal_umum->isNotEmpty()){
                $validator = Validator::make($request->all(), [
                    'hari_kelas_umum' => 'required',
                    'jam_kelas_umum' => 'required',
                ]);

                if($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                $jadwal_umum->update([
                    'hari_kelas_umum' => $request->hari_kelas_umum,
                    'jam_kelas_umum' => $request->jam_kelas_umum,
                ]);
            
                return new Response(true, 'Jadwal Umum successfully updated!', []);        
            }else{
                return new Response(false, 'Jadwal Umum not found!', []);
            }
        }catch (Error $message){
            return new Response(false, 'Jadwal Umum failed to updated!', []);
        }
    }

    public function destroy(int $id){
        try{
            $jadwal_umum = Jadwal_Umum::find($id);

            if($jadwal_umum->isNotEmpty()){
                $jadwal_umum->update([
                    'isdelete' => true,
                ]);
                
                return new Response(true, 'Jadwal Umum successfully deleted!', []);
            }else{
                return new Response(false, 'Jadwal Umum not found', []);
            }
        }catch (Error $message){
            return new Response(true, 'Jadwal Umum failed to delete!', []);
        }
    }

}