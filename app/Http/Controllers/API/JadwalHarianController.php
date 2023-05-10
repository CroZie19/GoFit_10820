<?php

namespace App\Http\Controllers;

use App\Models\Jadwal_Harian;
use App\Http\Resources\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Error;
use Illuminate\Validation\Rule;

class JadwalHarianController extends Controller
{

    public function index()
    {
        //get posts
        $jadwal_harian = Jadwal_Harian::latest()->get();
        //render view with posts
        return new Response(true, 'List Data Jadwal Harian', $jadwal_harian);
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
            $jadwal_harian = Jadwal_Harian::find($id);

            if($jadwal_harian->isNotEmpty()){
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
                'status_kelas_harian' => 'required',
                'tanggal_kelas_harian' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            Jadwal_Harian::create([
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
                    'status_kelas_harian' => 'required',
                    'tanggal_kelas_harian' => 'required',
                ]);

                if($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                $jadwal_harian->update([
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