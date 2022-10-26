<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Supplier::latest()->get();

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'nama_supplier' => 'required|max:200',
            'phone'         => 'required|max_digits:16|numeric',
            'alamat'        => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'error'         => true,
                'data_errors'   => $validation->errors()
            ]);
        }

        $data = $request->all();

        Supplier::create($data);

        
        return response()->json([
            'error'         => false,
            'input_data'    => $data,
            'message'       => 'Berhasil menambahkan data supplier!'
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
        $data = Supplier::firstWhere('id', $id);

        return response()->json(['data' => $data]);
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
        $validation = Validator::make($request->all(), [
            'nama_supplier' => 'required|max:200',
            'phone'         => 'required|max_digits:16|numeric',
            'alamat'        => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'error'         => true,
                'data_errors'   => $validation->errors()
            ]);
        }

        $data = $request->except('_token');

        Supplier::where('id', $id)->update($data);

        
        return response()->json([
            'error'         => false,
            'input_data'    => $data,
            'message'       => 'Berhasil update data supplier!'
        ]);
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
