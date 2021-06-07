<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $food_id = $request->input('food_id');
        $status = $request->input('$status');

        $price_from = $request->input('price_form');
        $price_to = $request->input('price_to');

        $rate_from = $request->input('rate_from');
        $rate_to = $request->input('rate_to');

        if($id){
            $transaction = Transaction::with(['food', 'user'])->find($id);

            if($transaction){
                return ResponseFormatter::success($transaction, 'Data transaksi berhasil diambil');
            }else{
                return ResponseFormatter::error(null, 'Data transaksi tidak ditemukan', 404);
            }
        }


        /** @var TYPE_NAME $transaction */
        $transaction = Transaction::with(['food', 'user'])->where('user_id', \Auth::user()->id);

        if($food_id){
            $transaction->where('food_id', $food_id);
        }
        if($status){
            $transaction->where('status', $status);
        }


        return ResponseFormatter::success($transaction->paginate($limit), 'Data list transaksi berhasil diambil');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $transaction->update($request->all());
        return ResponseFormatter::success($transaction, 'Transaksi berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
