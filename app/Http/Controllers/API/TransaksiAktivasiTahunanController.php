<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi_Aktivasi_Tahunan;
use App\Models\Member;
use App\Models\Pegawai;
use App\Http\Resources\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Error;
use Illuminate\Validation\Rule;

class TransaksiAktivasiTahunan extends Controller
{
    public function index()
    {
        $transaksi_aktivasi_tahunan = Transaksi_Aktivasi_Tahunan::Join('member', 'transaksi__aktivasi__tahunan.id_member','=','member.id')
            ->Join('pegawai', 'transaksi__aktivasi__tahunan.id_pegawai','=','pegawai.id')
             ->select('pegawai.pegawai','pegawai.jabatan_pegawai','member.nama_member','member.jumlah_deposit_member','member.tanggal_kardaluasa_member', 'transaksi__aktivasi__tahunan.tanggal_transaksi_aktivasi','transaksi__aktivasi__tahunan.jumlah_pembayaran_aktivasi', 'transaksi__aktivasi__tahunan.metode_pembayaran_aktivasi')
            ->get();

        if(count($transaksi_aktivasi_tahunan)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data' =>$transaksi_aktivasi_tahunan,
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
            $transaksi_aktivasi_tahunan = Transaksi_Aktivasi_Tahunan::get();

            if($transaksi_aktivasi_tahunan!=null){
                return new Response(true, 'Transaksi Aktivasi Tahunan successfully displayed!', $transaksi_aktivasi_tahunan);
            }else{
                return new Response(false, 'Transaksi Aktivasi Tahunan not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Transaksi Aktivasi Tahunan failed to display!', []);
        }
    }

    public function show(int $id){
        try{
            $transaksi_aktivasi_tahunan = Transaksi_Aktivasi_Tahunan::find($id);
            $transaksi_aktivasi_tahunan = Transaksi_Aktivasi_Tahunan::Join('jadwal_harian', 'transaksi__perijinan__instrukturs.id_jadwal_harian','=','jadwal_harian.id')
            ->Join('kelas', 'jadwal_harian.id_kelas','=','kelas.id')
            ->Join('instruktur', 'transaksi__perijinan__instrukturs.id_instruktur','=','instruktur.id')
            ->select('instruktur.nama_instruktur','kelas.jenis_kelas','transaksi__perijinan__instrukturs.*','jadwal_harian.status_kelas_harian','jadwal_harian.tanggal_kelas_harian','transaksi__perijinan__instrukturs.id','jadwal_harian.id_kelas','jadwal_harian.id_instruktur')
            ->where('transaksi__perijinan__instrukturs.id',$id )
            ->first();

            if($transaksi_aktivasi_tahunan!=null){
                return new Response(true, 'Transaksi Aktivasi Tahunan found!', $transaksi_aktivasi_tahunan);               
            }else{
                return new Response(false, 'Transaksi Aktivasi Tahunan not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Transaksi Aktivasi Tahunan failed to display!', []);
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
    
            Transaksi_Aktivasi_Tahunan::create([
                'id_jadwal_harian' => $request->id_jadwal_harian,
                'id_instruktur' => $request->id_instruktur,
                'tanggal_perijinan_instruktur' => $request->tanggal_perijinan_instruktur,
                'sesi_perijinan_instruktur' => $request->sesi_perijinan_instruktur,
                'keterangan_perijinan_instruktur' => $request->keterangan_perijinan_instruktur,                
            ]);
    
            return new Response(true, 'Transaksi Aktivasi Tahunan successfully added!', []);            
        }catch (Error $message){
            return new Response(false, 'Transaksi Aktivasi Tahunan failed to added!', []);
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

        Transaksi_Aktivasi_Tahunan::where('transaksi__perijinan__instrukturs.id',$id )
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
            $transaksi_aktivasi_tahunan = Transaksi_Aktivasi_Tahunan::find($id);

            if($transaksi_aktivasi_tahunan->isNotEmpty()){
                $transaksi_aktivasi_tahunan->update([
                    'isdelete' => true,
                ]);
                
                return new Response(true, 'Transaksi Aktivasi Tahunan successfully deleted!', []);
            }else{
                return new Response(false, 'Transaksi Aktivasi Tahunan not found', []);
            }
        }catch (Error $message){
            return new Response(true, 'Transaksi Aktivasi Tahunan failed to delete!', []);
        }
    }

}