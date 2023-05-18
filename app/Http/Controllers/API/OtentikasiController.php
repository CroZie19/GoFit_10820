<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Http\Resources\Response;
use App\Models\Pegawai;
use App\Models\Instruktur;
use App\Models\Member;
use App\Models\Menu;
use App\Models\User;

class OtentikasiController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
            'role' => ['required', Rule::in(['pegawai', 'instruktur', 'member'])],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->role === 'pegawai') {
            $user = Pegawai::where('username_pegawai', $request->email)->first();
        } else if ($request->role === 'instruktur') {
            $user = Instruktur::where('username_instruktur', $request->email)->first();
        } else if ($request->role === 'member') {
            $user = Member::where('email', $request->email)->first();
        }

        if (! $user || (!Hash::check($request->password, $user->password_pegawai) && !Hash::check($request->password, $user->password) && !Hash::check($request->password, $user->password_instruktur))) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah',
            ]);
        }
        
        $token = $user->createToken('ApiToken')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'role' => $request->role,
            'token' => $token,
        ]);  
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
        ]);
    }

    public function profile(){
        return response()->json([
            'success' => true,
            'user' => Auth::user(),
        ]);
    }

    public function menu(){
        $role = Auth::user()->roles->pluck('name')[0];
        $menus = Menu::role($role)->orderBy('urut', 'asc')->get();

        $menuTree = [];

        foreach ($menus as $menu) {
            if ($menu->id_induk === null) {
                $menuTree[$menu->id] = [
                    'judul' => $menu->judul,
                    'ikon' => $menu->ikon,
                    'submenu' => [],
                ];
            } else {
                $menuTree[$menu->id_induk]['submenu'][] = [
                    'judul' => $menu->judul,
                    'ikon' => $menu->ikon,
                    'url' => $menu->url,
                ];
            }
        }

        return response()->json([
            'success' => true,
            'menu' => $menuTree,
        ]);
    }
}