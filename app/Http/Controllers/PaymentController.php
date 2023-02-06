<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if($nomor_kartu = $request->nomor_kartu){
            $user = User::where('nomor_kartu',$nomor_kartu)->first();
            if(empty($user))
            {
                return response()->json([
                    'error' => 'Kartu tidak terdaftar'
                ], 400);
            }

            if($user->saldo < 20000)
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Saldo anda tidak cukup'
                ], 201);
            }

            $balance = $user->saldo - 20000;
            $data = [
                'id_user' => $user->id,
                'total' => 20000,
                'saldo' => $balance,
            ];

            $updateData = [
                'saldo' => $balance,
            ];


            DB::transaction(function() use($data, $updateData, $user){

            Order::create($data);

            User::where('id', $user->id)->update($updateData);
            
            });
            $dataUser = [
                'nama' => $user->nama,
                'saldo' => number_format($balance, 2),
                'price' => 20000,
            ];
            

            return response()->json([
                'status' => true,
                'message' => 'Transaksi berhasil',
                'data' => $dataUser
            ], 201);



        }
            return response()->json([
                'error' => 'Kartu tidak terdaftar'
            ], 400);
        
    }
}