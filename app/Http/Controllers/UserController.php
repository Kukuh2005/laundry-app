<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();

        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string',
                'level' => 'required|string',
            ]);
    
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->level = $request->level;
            $user->save();
    
    
            return redirect(auth()->user()->level . '/user')->with('sukses', 'Berhasil tambah user');
        }catch(\Exception $e){
            return redirect(auth()->user()->level . '/user')->with('gagal', 'Tidak berhasil tambah user. Pesan kesalahan: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level;
        $user->update();

        return redirect(auth()->user()->level . '/user')->with('sukses', 'Edit user berhasil');
    }

    public function profile(){
        $user = User::find(auth()->user()->id);

        return view('profile.index', compact('user'));
    }

    public function profile_update(Request $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password_baru);;
        $user->update();    

        return redirect(auth()->user()->level . '/profile')->with('sukses', 'Edit profile berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if($user->level == 'Pemilik'){
            return redirect(auth()->user()->level . '/user')->with('gagal', 'Anda gagal mengkudeta pemilik');
        }elseif($user->id == auth()->user()->id){
            return redirect(auth()->user()->level . '/user')->with('gagal', 'Hapus akun gagal');
        }else{
            $user->delete();
            return redirect(auth()->user()->level . '/user')->with('sukses', 'Hapus user berhasil');
        }
    }
}
