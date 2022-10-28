<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Barang;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transaction::with(['user','transaction_detail.barang.supplier'])->get();

        foreach($data as $item) {
            $item->conv_created_at = Carbon::parse($item->created_at, 'UTC')->tz('Asia/Jakarta')->format('l, d M Y H:i');
        }

        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', fn($data) => view('html.action')->with('data', $data))
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        $dataTransactionDetails =  json_decode($request->transactions, true);
        $totalTransaction = $request->transaction_total;

        $storeTransaction = Transaction::create([
            'user_id'               => auth()->user()->id,
            'transaction_total'     => $totalTransaction
        ]);

        $transactionId = $storeTransaction->id;

        for($i = 0; $i < count($dataTransactionDetails); $i++) {
            $dataTransactionDetails[$i]['transaction_id'] = $transactionId;
            $dataTransactionDetails[$i]['subtotal'] = $dataTransactionDetails[$i]['harga'] * $dataTransactionDetails[$i]['qty'];
            unset($dataTransactionDetails[$i]['nama_barang']);

            $dataTransactionDetails[$i]['created_at'] = Carbon::parse(date('Y-m-d H:i:s'), 'UTC')->tz('Asia/Jakarta')->format('Y-m-d H:i:s');
            $dataTransactionDetails[$i]['updated_at'] = Carbon::parse(date('Y-m-d H:i:s'), 'UTC')->tz('Asia/Jakarta')->format('Y-m-d H:i:s');

            $stok = Barang::select(['stok'])->where('id', $dataTransactionDetails[$i]['barang_id'])->first();
            $updateStok = $stok->stok - (int) $dataTransactionDetails[$i]['qty'];

            Barang::where('id', $dataTransactionDetails[$i]['barang_id'])->update([
                'stok'  => $updateStok
            ]);
        }
    
        //print_r($dataTransactionDetails);

        TransactionDetail::insert($dataTransactionDetails);
        
        return response()->json([
            'error' => false,
            'message'   => 'Berhasil menyimpan transaksi'
        ]);
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionRequest  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
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
