<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ClienteController extends Controller
{
    public function show_clients() {
        try {
            $result = DB::select('call sp_show_clients');
            return response()->json($result,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function insert_client( StoreClient $request){
        try {
            $name = $request->input('name');
            $dbo = $request->input('dbo');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $address = $request->input('address');
            $payments = json_encode($request->input('payments'));
            DB::select('call sp_insert_client(?,?,?,?,?,?)', [$name, $dbo, $phone, $email, $address, $payments]);
            return response()->json(['message'=> 'CLiente add '],201);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function delete_client($id){
        try {
            $result = DB::statement('call sp_delete_client(?)',[$id]);
            if ($result) {
                return response()->json(['message' => 'client deleted'],200);
    
            } else {
                return response()->json(['message' => 'cliente notfound',404]);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function get_client($id) {
        try {
            $result = DB::select('call sp_get_client(?)',[(int)$id]);
            return response()->json($result,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function update_client(StoreClient $request ,  $id) {
            try {
                $name = $request->input('name');
                $dbo = $request->input('dbo');
                $phone = $request->input('phone');
                $email = $request->input('email');
                $address = $request->input('address');
                $payments = json_encode($request->input('payments'));

                DB::select('call sp_update_client(?,?,?,?,?,?,?)',[$id,$name,$dbo,$phone,$email,$address,$payments]);
                return response()->json(['message'=> 'Client modificado'],200);
            } catch (\Throwable $th) {
                return response()->json(['error' => $th->getMessage()], 500);
            }
    }
    public function insert_payments(StoreClient $request){
        try {
            $cliente_id = $request->input('id_client');
            $amount = $request->input('amount');
            $transaction_id = $request->input('transaction_id');
            $start_date = $request->input('start_date');
            DB::select('call sp_insert_payments(?,?,?,?)' , [$cliente_id,$amount,$transaction_id,$start_date]);
            return response()->json(['message' => 'payments inserted'],201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }      
    }
    
}
