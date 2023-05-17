<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi_Aktivasi_Tahunan;
use App\Models\Member;
use App\Models\Pegawai;
use Carbon\Carbon;
use App\Http\Resources\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Error;
use Illuminate\Validation\Rule;

class TransaksiAktivasiTahunanController extends Controller
{
    public function index()
    {
        $transaksi_aktivasi_tahunan = Transaksi_Aktivasi_Tahunan::Join('member', 'transaksi__aktivasi__tahunans.id_member','=','member.id')
            ->Join('pegawai', 'transaksi__aktivasi__tahunans.id_pegawai','=','pegawai.id')
             ->select('transaksi__aktivasi__tahunans.id','pegawai.nama_pegawai','pegawai.jabatan_pegawai','member.nama_member','member.jumlah_deposit_member','member.tanggal_kardaluasa_member','member.status_member', 'transaksi__aktivasi__tahunans.tanggal_transaksi_aktivasi','transaksi__aktivasi__tahunans.jumlah_pembayaran_aktivasi', 'transaksi__aktivasi__tahunans.metode_pembayaran_aktivasi')
            ->where('member.status_member',0 )
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
            // $transaksi_aktivasi_tahunan = Transaksi_Aktivasi_Tahunan::find($id);
            $transaksi_aktivasi_tahunan = Transaksi_Aktivasi_Tahunan::Join('member', 'transaksi__aktivasi__tahunans.id_member','=','member.id')
            ->Join('pegawai', 'transaksi__aktivasi__tahunans.id_pegawai','=','pegawai.id')
             ->select('transaksi__aktivasi__tahunans.id','transaksi__aktivasi__tahunans.id_pegawai','transaksi__aktivasi__tahunans.id_member','pegawai.nama_pegawai','pegawai.jabatan_pegawai','member.nama_member','member.jumlah_deposit_member','member.tanggal_kardaluasa_member','member.status_member', 'transaksi__aktivasi__tahunans.tanggal_transaksi_aktivasi','transaksi__aktivasi__tahunans.jumlah_pembayaran_aktivasi', 'transaksi__aktivasi__tahunans.metode_pembayaran_aktivasi')
            ->where('transaksi__aktivasi__tahunans.id',$id )
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
                'tanggal_perijinan_instruktur' => Carbon::now(),
                'sesi_perijinan_instruktur' => $request->sesi_perijinan_instruktur,
                'keterangan_perijinan_instruktur' => $request->keterangan_perijinan_instruktur,                
            ]);
    
            return new Response(true, 'Transaksi Aktivasi Tahunan successfully added!', []);            
        }catch (Error $message){
            return new Response(false, 'Transaksi Aktivasi Tahunan failed to added!', []);
        }
    }

    public function update(Request $request,$id)
    {
        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'id_member' => 'required',
            'id_pegawai'=> 'required',
        ]);
        
        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $Member = Member::select('member.*')->where('member.id',$updateData['id_member'])->first();
        $saldo = Member::where('member.id',$updateData['id_member'] )->value('jumlah_deposit_member');
        $Member->status_member = 1;
        $Member->jumlah_deposit_member = $saldo+300000;
        $Member->tanggal_kardaluasa_member = Carbon::now()->addMonths(12);
        $Member->save();
        
        
        $Transaksi_Aktivasi_Tahunan = Transaksi_Aktivasi_Tahunan::select('transaksi__aktivasi__tahunans.*')->where('transaksi__aktivasi__tahunans.id',$id)->first();
        $Transaksi_Aktivasi_Tahunan->id_member = $updateData['id_member'];
        $Transaksi_Aktivasi_Tahunan->id_pegawai = $updateData['id_pegawai'];
        $Transaksi_Aktivasi_Tahunan->tanggal_transaksi_aktivasi = Carbon::now();
        $Transaksi_Aktivasi_Tahunan->metode_pembayaran_aktivasi = $updateData['metode_pembayaran_aktivasi'];
        $Transaksi_Aktivasi_Tahunan->jumlah_pembayaran_aktivasi = 3000000;
        if($Transaksi_Aktivasi_Tahunan->save()){
            return response([
                'message' => 'Member Successfully Activated!',
                'data' =>$Transaksi_Aktivasi_Tahunan,
                'success' => true
            ],200);      
        }else{
            return response([
                'message' => 'Member Failed to be Activated!',
                'success' => false
            ],400); 
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