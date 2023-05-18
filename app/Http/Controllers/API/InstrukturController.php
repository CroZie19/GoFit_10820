<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Instruktur;
use App\Http\Resources\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Error;
use Illuminate\Validation\Rule;
use Exception;

class InstrukturController extends Controller
{

    public function index()
    {
        try{
            $instruktur = Instruktur::get();

            if($instruktur->isNotEmpty()){
                return new Response(true, 'List instruktur berhasil ditampilkan!', $instruktur);
            }else{
                return new Response(false, 'Tidak ada data instruktur untuk ditampilkan!', []);
            };
        }catch (Exception $message){
            return new Response(false, $message, []);
        };
    }

    public function showList(){
        try{
            $instruktur = Instruktur::get();

            if($instruktur->isNotEmpty()){
                return new Response(true, 'Instruktur successfully displayed!', $instruktur);
            }else{
                return new Response(false, 'Instruktur not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Instruktur failed to display!', []);
        }
    }

    public function show(string $id)
    {
        try{
            $instruktur = Instruktur::find($id);

            if($instruktur != null){
                return new Response(true, 'Data instruktur berhasil ditampilkan!', $instruktur);
            }else{
                return new Response(false, 'Data instruktur tidak ditemukan!', []);
            };
        }catch (Exception $message){
            return new Response(false, $message, []);
        };
    }

    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'nama_instruktur' => 'required',
                'username_instruktur' => 'required',
                'password_instruktur' => 'required',
                'tanggal_lahir_instruktur' => 'required',
                'noTelp_instruktur' => 'required|regex:/^08\d{8,11}$/',
                'alamat_instruktur' => 'required',
                
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            Instruktur::create([
                'nama_instruktur' => 'required',
                'username_instruktur' => $request->username_instruktur,
                'password_instruktur' => $request->password_instruktur,
                'tanggal_lahir_instruktur' => $request->tanggal_lahir_instruktur,
                'noTelp_instruktur' => $request->noTelp_instruktur,
                'alamat_instruktur' => $request->alamat_instruktur,            
            ]);
    
            return new Response(true, 'Instruktur successfully added!', []);            
        }catch (Error $message){
            return new Response(false, 'Insturktur failed to added!', []);
        }
    }

    public function update(Request $request, int $id){
        try{
            $instruktur = Instruktur::find($id);

            if($instruktur->isNotEmpty()){
                $validator = Validator::make($request->all(), [
                    'nama_instruktur' => 'required',
                    'username_instruktur' => 'required',
                    'password_instruktur' => 'required',
                    'tanggal_lahir_instruktur' => 'required',
                    'noTelp_instruktur' => 'required|regex:/^08\d{8,11}$/',
                    'alamat_instruktur' => 'required',
                ]);

                if($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                $instruktur->update([
                    'nama_instruktur' => $request->nama_instruktur,
                    'username_instruktur' => $request->username_instruktur,
                    'password_instruktur' => $request->password_instruktur,
                    'tanggal_lahir_instruktur' => $request->tanggal_lahir_instruktur,
                    'noTelp_instruktur' => $request->noTelp_instruktur,
                    'alamat_instruktur' => $request->alamat_instruktur,   
                ]);
            
                return new Response(true, 'Instruktur successfully updated!', []);        
            }else{
                return new Response(false, 'Instruktur not found!', []);
            }
        }catch (Error $message){
            return new Response(false, 'Instruktur failed to updated!', []);
        }
    }

    public function destroy(int $id){
        try{
            $instruktur = Instruktur::find($id);

            if($instruktur->isNotEmpty()){
                $instruktur->update([
                    'isdelete' => true,
                ]);
                
                return new Response(true, 'Instruktur successfully deleted!', []);
            }else{
                return new Response(false, 'Instruktur not found', []);
            }
        }catch (Error $message){
            return new Response(true, 'Instruktur failed to delete!', []);
        }
    }

}