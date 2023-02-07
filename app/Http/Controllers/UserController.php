<?php

namespace App\Http\Controllers;

use App\Models\KartuTemp;
use App\Models\Order;
use App\Models\User;
use Faker\Provider\ar_EG\Payment;
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
        ]);

        User::create($validasiData);

        KartuTemp::where('nomor_kartu',$request->nomor_kartu)->delete();

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

    public function tambah_saldo($id)
    {
        $data['id'] = $id;
        return view('users.tambah_saldo', $data);
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
        ]);

        User::where('id', $user->id)->update($validasiData);

        Alert::success('Success Title', 'User berhasil diubah');

        return redirect('users')->with('success', 'User berhasil diubah');
    }

    public function update_saldo(Request $request, $id){
        if($request->saldo){
            $user = User::where('id', $id)->first();

            $data['saldo'] = $user->saldo + $request->saldo;
            
            User::where('id', $id)->update($data);
            
            $dataPay['total'] = $request->saldo;
            $dataPay['saldo'] = $user->saldo + $request->saldo;
            $dataPay['id_user'] = $id;
            $dataPay['status'] = 2;

            Order::create($dataPay);

            Alert::success('Success Title', 'Saldo berhasil ditambahakan');

            return redirect('users')->with('success', 'Saldo berhasil ditambahakan');
        }
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