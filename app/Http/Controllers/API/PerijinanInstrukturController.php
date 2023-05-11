<?php

namespace App\Http\Controllers;

use App\Models\Transaksi_Perijinan_Instruktur;
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
        $transaksi_perijinan_instruktur = Transaksi_Perijinan_Instruktur::latest()->get();
        //render view with posts
        return new Response(true, 'List Data Transaksi Perijinan Instruktur', $transaksi_perijinan_instruktur);
    }


    public function showList(){
        try{
            $transaksi_perijinan_instruktur = Transaksi_Perijinan_Instruktur::get();

            if($transaksi_perijinan_instruktur->isNotEmpty()){
                return new Response(true, 'Transaksi Perijinan Instruktur successfully displayed!', $transaksi_perijinan_instruktur);
            }else{
                return new Response(false, 'Transaksi Perijinan Instruktur not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Transaksi Perijinan Instruktur failed to display!', []);
        }
    }

    public function show(int $id){
        try{
            $transaksi_perijinan_instruktur = Transaksi_Perijinan_Instruktur::find($id);

            if($transaksi_perijinan_instruktur->isNotEmpty()){
                return new Response(true, 'Transaksi Perijinan Instruktur found!', $transaksi_perijinan_instruktur);               
            }else{
                return new Response(false, 'Transaksi Perijinan Instruktur not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Transaksi Perijinan Instruktur failed to display!', []);
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
    
            Transaksi_Perijinan_Instruktur::create([
                'id_jadwal_harian' => $request->id_jadwal_harian,
                'id_instruktur' => $request->id_instruktur,
                'tanggal_perijinan_instruktur' => $request->tanggal_perijinan_instruktur,
                'sesi_perijinan_instruktur' => $request->sesi_perijinan_instruktur,
                'keterangan_perijinan_instruktur' => $request->keterangan_perijinan_instruktur,                
            ]);
    
            return new Response(true, 'Transaksi Perijinan Instruktur successfully added!', []);            
        }catch (Error $message){
            return new Response(false, 'Transaksi Perijinan Instruktur failed to added!', []);
        }
    }

    public function update(Request $request, int $id){
        try{
            $transaksi_perijinan_instruktur = Transaksi_Perijinan_Instruktur::find($id);

            if($transaksi_perijinan_instruktur->isNotEmpty()){
                $validator = Validator::make($request->all(), [
                    'id_jadwal_harian' => 'required',
                    'id_istruktur'=> 'required',
                    'tanggal_perijinan_instruktur' => 'required',
                    'sesi_perijinan_instruktur' => 'required',
                    'keterangan_perijinan_instruktur' => 'required',
                ]);

                if($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                $transaksi_perijinan_instruktur->update([
                    'id_jadwal_harian' => $request->id_jadwal_harian,
                    'id_instruktur' => $request->id_instruktur,
                    'tanggal_perijinan_instruktur' => $request->tanggal_perijinan_instruktur,
                    'sesi_perijinan_instruktur' => $request->sesi_perijinan_instruktur,
                    'keterangan_perijinan_instruktur' => $request->keterangan_perijinan_instruktur, 
                ]);
            
                return new Response(true, 'Transaksi Perijinan Instruktur successfully updated!', []);        
            }else{
                return new Response(false, 'Transaksi Perijinan Instruktur not found!', []);
            }
        }catch (Error $message){
            return new Response(false, 'Transaksi Perijinan Instruktur failed to updated!', []);
        }
    }

    public function destroy(int $id){
        try{
            $transaksi_perijinan_instruktur = Transaksi_Perijinan_Instruktur::find($id);

            if($transaksi_perijinan_instruktur->isNotEmpty()){
                $transaksi_perijinan_instruktur->update([
                    'isdelete' => true,
                ]);
                
                return new Response(true, 'Transaksi Perijinan Instruktur successfully deleted!', []);
            }else{
                return new Response(false, 'Transaksi Perijinan Instruktur not found', []);
            }
        }catch (Error $message){
            return new Response(true, 'Transaksi Perijinan Instruktur  failed to delete!', []);
        }
    }

}