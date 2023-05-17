<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Http\Resources\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Error;
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

            if($member->isNotEmpty()){
                return new Response(true, 'Member data found!', $member);               
            }else{
                return new Response(false, 'Member data not found!', []);
            };
        }catch (Error $message){
            return new Response(false, 'Member data failed to display!', []);
        }
    }

    public function add(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'nama_member' => 'required',
                'tanggal_lahir_member' => 'required',
                'alamat_member' => 'required',
                'noTelp_member' => 'required|regex:/^08\d{8,11}$/',
                'jumlah_deposit_member' => 'required',
                'email' => ['required', 'email', Rule::unique('member')],
                'password' => 'required',
                'tanggal_kardaluasa_member' => 'required',
                
                
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            Member::create([
                'nama_member' => $request->nama_member,
                'tanggal_lahir_member' => $request->tanggal_lahir_member,
                'alamat_member' => $request->alamat_member,
                'noTelp_member' => $request->noTelp_member,
                'jumlah_deposit_member' => $request->jumlah_deposit_member,
                'email' => $request->email,
                'password' => $request->password,
                'tanggal_kardaluasa_member' => $request->tanggal_kardaluasa_member,
            ]);
    
            return new Response(true, 'Member successfully added!', []);            
        }catch (Error $message){
            return new Response(false, 'Member failed to added!', []);
        }
    }

    public function update(Request $request, int $id){
        try{
            $member = Member::find($id);

            if($member->isNotEmpty()){
                $validator = Validator::make($request->all(), [
                    'nama_member' => 'required',
                    'tanggal_lahir_member' => 'required',
                    'alamat_member' => 'required',
                    'noTelp_member' => 'required|regex:/^08\d{8,11}$/',               
                    'jumlah_deposit_member' => 'required',               
                    'email' => ['required', 'email', Rule::unique('member')],
                    'password' => 'required',               
                    'tanggal_kardaluasa_member' => 'required',

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
                    'password' => $request->password,
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
        try{
            $member = Member::find($id);

            if($member->isNotEmpty()){
                $member->update([
                    'isdelete' => true,
                ]);
                
                return new Response(true, 'Member successfully deleted!', []);
            }else{
                return new Response(false, 'Member found', []);
            }
        }catch (Error $message){
            return new Response(true, 'Member data failed to delete!', []);
        }
    }

}