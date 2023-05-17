<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Http\Resources\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Error;
use Carbon\Carbon;
use Exception;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    public function index()
    {
        try{
            $member = Member::get();

            if($member->isNotEmpty()){
                return new Response(true, 'List member berhasil ditampilkan!', $member);
            }else{
                return new Response(false, 'Tidak ada data member untuk ditampilkan!', []);
            };
        }catch (Exception $message){
            return new Response(false, $message, []);
        };
    }

    public function showList(){
        try{
            $member = Member::get();

            if($member->isNotEmpty()){
                return new Response(true, 'Member successfully displayed!', $member);
            }else{
                return new Response(false, 'Member not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Member failed to display!', []);
        }
    }

    public function show(int $id){
        try{
            $member = Member::find($id);

            if($member!=null){
                return new Response(true, 'Member data found!', $member);               
            }else{
                return new Response(false, 'Member data not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Member data failed to display!', []);
        }
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validator = Validator::make($request->all(), [
                'nama_member' => 'required',
                'tanggal_lahir_member' => 'required',
                'alamat_member' => 'required',
                'noTelp_member' => 'required|regex:/^08\d{8,11}$/',
                'jumlah_deposit_member' => 'required',
                'email' => ['required', 'email', Rule::unique('member')],
            ]);
        if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
        
        $Member = new Member();
        $Member->nama_member = $storeData['nama_member'];
        $Member->tanggal_lahir_member = $storeData['tanggal_lahir_member'];
        $Member->alamat_member = $storeData['alamat_member'];
        $Member->noTelp_member = $storeData['noTelp_member'];
        $Member->jumlah_deposit_member = $storeData['jumlah_deposit_member'];
        $Member->email = $storeData['email'];
        $Member->password = bcrypt($storeData['tanggal_lahir_member']);
        $Member->tanggal_kardaluasa_member = Carbon::now()->addMonths(12);
        if($Member->save()){
            return response([
                'message' => 'Tambah Member berhasil!',
                'data' =>$Member
            ],200);      
        }
    }

    public function update(Request $request, int $id){
        try{
            $member = Member::find($id);

            if($member!=null){
                $validator = Validator::make($request->all(), [
                    'nama_member' => 'required',
                    'tanggal_lahir_member' => 'required',
                    'alamat_member' => 'required',
                    'noTelp_member' => 'required|regex:/^08\d{8,11}$/',               
                    'jumlah_deposit_member' => 'required',               
                    'email' => 'required',    
                ]);

                if($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                $member->update([
                    'nama_member' => $request->nama_member,
                    'tanggal_lahir_member' => $request->tanggal_lahir_member,
                    'alamat_member' => $request->alamat_member,
                    'noTelp_member' => $request->noTelp_member,
                    'jumlah_deposit_member' => $request->jumlah_deposit_member,
                    'email' => $request->email,
                    'tanggal_kardaluasa_member' => $request->tanggal_kardaluasa_member,

                ]);
            
                return new Response(true, 'Member successfully updated!', []);        
            }else{
                return new Response(false, 'Member not found!', []);
            }
        }catch (Error $message){
            return new Response(false, 'Member failed to updated!', []);
        }
    }

    public function destroy(int $id){
        $member = Member::find($id);

        if(($member) == null){
            return response([
                'message' => 'Member Tidak Ditemukan',
                'data' => null
            ],404);
        }

        if($member->delete()){
            return response([
                'message' => 'Hapus data Member berhasil!',
                'data' =>$member,
                'success' => true
            ],200);
        }
       
        return response([
            'message' => 'Hapus data member gagal!',
            'data' => null,
        ],400);  
    }

}