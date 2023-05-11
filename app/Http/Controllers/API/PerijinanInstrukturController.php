<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi_Perijinan_Instruktur;
use App\Models\Instruktur;
use App\Models\Jadwal_Harian;
use App\Http\Resources\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Error;
use Illuminate\Validation\Rule;

class PerijinanInstrukturController extends Controller
{
    public function index()
    {
        $transaksi_perijinan_instruktur = Transaksi_Perijinan_Instruktur::Join('instruktur', 'transaksi__perijinan__instrukturs.id_instruktur','=','instruktur.id')
            ->Join('jadwal_harian', 'transaksi__perijinan__instrukturs.id_jadwal_harian','=','jadwal_harian.id')
            ->Join('kelas', 'jadwal_harian.id_kelas', '=', 'kelas.id')
            ->where('transaksi__perijinan__instrukturs.konfirmasi_perijinan', '=', 0)
             ->select('instruktur.nama_instruktur','kelas.jenis_kelas','jadwal_harian.status_kelas_harian','jadwal_harian.tanggal_kelas_harian','transaksi__perijinan__instrukturs.id', 'transaksi__perijinan__instrukturs.tanggal_perijinan_instruktur','transaksi__perijinan__instrukturs.id_jadwal_harian', 'transaksi__perijinan__instrukturs.sesi_perijinan_instruktur', 'transaksi__perijinan__instrukturs.keterangan_perijinan_instruktur')
            ->get();

        if(count($transaksi_perijinan_instruktur)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data' =>$transaksi_perijinan_instruktur,
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
            $transaksi_perijinan_instruktur = Transaksi_Perijinan_Instruktur::get();

            if($transaksi_perijinan_instruktur!=null){
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
            $transaksi_perijinan_instruktur = Transaksi_Perijinan_Instruktur::Join('jadwal_harian', 'transaksi__perijinan__instrukturs.id_jadwal_harian','=','jadwal_harian.id')
            ->Join('kelas', 'jadwal_harian.id_kelas','=','kelas.id')
            ->Join('instruktur', 'transaksi__perijinan__instrukturs.id_instruktur','=','instruktur.id')
            ->select('instruktur.nama_instruktur','kelas.jenis_kelas','transaksi__perijinan__instrukturs.*','jadwal_harian.status_kelas_harian','jadwal_harian.tanggal_kelas_harian','transaksi__perijinan__instrukturs.id','jadwal_harian.id_kelas','jadwal_harian.id_instruktur')
            ->where('transaksi__perijinan__instrukturs.id',$id )
            ->first();

            if($transaksi_perijinan_instruktur!=null){
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
        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'id_kelas' => 'required',
            'id_instruktur'=> 'required',
            'id_jadwal_harian'=> 'required',
            'tanggal_kelas_harian' => 'required',
        ]);

        $nama_pengganti = Instruktur::where('instruktur.id', $updateData['id_instruktur'])->value('nama_instruktur');

        
        if($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        Transaksi_Perijinan_Instruktur::where('transaksi__perijinan__instrukturs.id',$id )
            ->update([
                'konfirmasi_perijinan' => 1, 
            ]);
        
        $jadwal_harian = Jadwal_Harian::select('jadwal_harian.*')->where('jadwal_harian.id',$updateData['id_jadwal_harian'])->first();
        $jadwal_harian->id_kelas = $updateData['id_kelas'];
        $jadwal_harian->id_instruktur = $updateData['id_instruktur'];
        $jadwal_harian->status_kelas_harian = 'Kelas ini digantikan oleh instruktur '.$nama_pengganti;
        $jadwal_harian->tanggal_kelas_harian = $updateData['tanggal_kelas_harian'];
        
        if($jadwal_harian->save()){
            return response([
                'message' => 'Jadwal Harian successfully updated, Perijinan Berhasil!',
                'data' =>$jadwal_harian,
                'success' => true
            ],200);      
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