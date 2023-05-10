<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Http\Resources\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Error;
use Illuminate\Validation\Rule;

class KelasController extends Controller
{

    public function index()
    {
        //get posts
        $kelas = Kelas::latest()->get();
        //render view with posts
        return new Response(true, 'List Data Kelas', $kelas);
    }

    public function showList(){
        try{
            $kelas = Kelas::get();

            if($kelas->isNotEmpty()){
                return new Response(true, 'Kelas successfully displayed!', $kelas);
            }else{
                return new Response(false, 'Kelas not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Kelas failed to display!', []);
        }
    }

    public function show(int $id){
        try{
            $kelas = Kelas::find($id);

            if($kelas->isNotEmpty()){
                return new Response(true, 'Kelas found!', $kelas);               
            }else{
                return new Response(false, 'Kelas not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Kelas failed to display!', []);
        }
    }

    public function add(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'jenis_kelas' => 'required',
                'harga_kelas' => 'required',
                'jumlah_kapasitas_kelas' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            Kelas::create([
                'jenis_kelas' => $request->jenis_kelas,
                'harga_kelas' => $request->harga_kelas,
                'jumlah_kapasitas_kelas' => $request->jumlah_kapasitas_kelas,
            ]);
    
            return new Response(true, 'Kelas successfully added!', []);            
        }catch (Error $message){
            return new Response(false, 'Kelas failed to added!', []);
        }
    }

    public function update(Request $request, int $id){
        try{
            $kelas = Kelas::find($id);

            if($kelas->isNotEmpty()){
                $validator = Validator::make($request->all(), [
                    'jenis_kelas' => 'required',
                    'harga_kelas' => 'required',
                    'jumlah_kapasitas_kelas' => 'required',
                ]);

                if($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                $kelas->update([
                    'jenis_kelas' => $request->jenis_kelas,
                    'harga_kelas' => $request->harga_kelas,
                    'jumlah_kapasitas_kelas' => $request->jumlah_kapasitas_kelas,
                ]);
            
                return new Response(true, 'Kelas successfully updated!', []);        
            }else{
                return new Response(false, 'Kelas not found!', []);
            }
        }catch (Error $message){
            return new Response(false, 'Kelas failed to updated!', []);
        }
    }

    public function destroy(int $id){
        try{
            $kelas = Kelas::find($id);

            if($kelas->isNotEmpty()){
                $kelas->update([
                    'isdelete' => true,
                ]);
                
                return new Response(true, 'Kelas successfully deleted!', []);
            }else{
                return new Response(false, 'Kelas not found', []);
            }
        }catch (Error $message){
            return new Response(true, 'Kelas failed to delete!', []);
        }
    }

}