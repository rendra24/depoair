<?php

namespace App\Http\Controllers;

use App\Models\KartuTemp;
use Pusher\Pusher;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentApiController extends Controller
{
    public function index(Request $request)
    {

        if($rfid = $request->rfID)
        {
            $user = User::where('nomor_kartu',$rfid)->first();
            if(empty($user))
            {
                $data['nomor_kartu'] = $rfid;
                KartuTemp::create($data);
                
                return response()->json([
                    'error' => 'Kartu tidak terdaftar'
                ], 400);
            }

            if($user->saldo < 20000)
            {
                $dataUser = [
                    'nama' => $user->nama,
                    'saldo' => number_format($user->saldo, 2),
                    'price' => 20000,
                    'title' => 'Saldo anda tidak cukup',
                    'statusMsg' => 'error'
                ];
                
    
                $pusher = new Pusher(
                    "4a74d03b30af8e68ef2e",
                    "575f510d65e285ecdb5e",
                    "1549354",
                    array('cluster' => 'ap1')
                  );
                  
                  $pusher->trigger('my-order', 'new-payment', array($dataUser));

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
                'status' => 1,
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
                'title' => 'Pembayaran Berhasil',
                'statusMsg' => 'success'
            ];
            

            $pusher = new Pusher(
                "4a74d03b30af8e68ef2e",
                "575f510d65e285ecdb5e",
                "1549354",
                array('cluster' => 'ap1')
              );
              
              $pusher->trigger('my-order', 'new-payment', array($dataUser));

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