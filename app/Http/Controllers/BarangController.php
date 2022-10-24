<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Barang::with(['created_by_name:id,name', 'supplier:id,nama_supplier'])->latest()->get();
        foreach($data as $item) {
            $item->conv_created_at = Carbon::parse($item->created_at, 'UTC')->tz('Asia/Jakarta')->format('l, d M Y H:i');
        }
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', fn($data) => view('html.action_barang')->with('data', $data))
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nama_barang'   => 'required|max:100',
            'harga'         => 'required|numeric',
            'stok'          => 'required|numeric',
            'supplier_id'   => 'required'
        ], [
            'supplier_id.required'  => 'The supplier field is required.'
        ]);

        if($validation->fails()) {
            $response = [
                'error'         => true, 
                'data_errors'   => $validation->errors()
            ];
            return response()->json($response);
        }


        $data = $request->all();
        $data['created_by']  = 1;
        $data['updated_by']  = 1;

        Barang::create($data);

        return response()->json([
            'error'         => false,
            'input_data'    => $data,
            'message'       => 'Berhasil menambahkan data barang!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
