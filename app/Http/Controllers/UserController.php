<?php

namespace App\Http\Controllers;

use App\Models\KartuTemp;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kartu = KartuTemp::all();
        return view('users.form', compact('kartu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasiData = $request->validate([
            'nama' => 'required|max:255',
            'telp' => 'required',
            'username' => 'required',
            'password' => 'required',
            'nomor_kendaraan' => 'required',
            'nomor_kartu' => 'required',
            'saldo' => 'required',
        ]);

        User::create($validasiData);
        return redirect('users')->with('success', 'User berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validasiData = $request->validate([
            'nama' => 'required|max:255',
            'telp' => 'required',
            'nomor_kendaraan' => 'required',
            'nomor_kartu' => 'required',
            'saldo' => 'required',
        ]);

        User::where('id', $user->id)->update($validasiData);

        Alert::success('Success Title', 'User berhasil diubah');

        return redirect('users')->with('success', 'User berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}