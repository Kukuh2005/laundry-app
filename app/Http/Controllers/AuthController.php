<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    
    public function daftar()
    {
        $user = User::all();
        
        return view('auth.daftar', compact('user'));
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string',
            ]);

            $level = $this->cekEmail($request->email);
    
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->level = $level;
            $user->save();
    
    
            return redirect('login')->with('sukses', 'Berhasil Daftar, Silahkan Login!');
        }catch(\Exception $e){
            return redirect('daftar')->with('status', 'Tidak Berhasil Daftar. Pesan Kesalahan: '.$e->getMessage());
        }
    }

    private function cekEmail($email){
        if(strpos($email, '@owner.com') !== false){
            return "Pemilik";
        }elseif(strpos($email, '@admin.com') !== false){
            return "Admin";
        }else{
            return "Karyawan";
        }
    }

    public function login()
    {
        return view('auth.login');
    }

    public function postlogin(Request $request): RedirectResponse
    {
        if(Auth::attempt($request->only('email', 'password'))){
            $user = Auth::user();

            return redirect($user->level . '/dashboard');
        }
        else {
            return back()->with('gagal', 'Email atau Password salah!');
        }
    }


    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }

    public function forgotPw()
    {
        return view('auth.forgotPassword');
    }

    public function home(){
        return view('index');
    }
}
