@extends('layouts.main')


@section('content')
<div class="container mx-auto">
  <a href="/transaction-list" class="btn mb-7">Lihat Daftar Transaksi</a>
  <div class="flex flex-wrap lg:flex-nowrap gap-2">
    <div class="w-full lg:w-1/2">
      {{-- list barang --}}
      <div class="card w-full bg-neutral text-neutral-content">
        <div class="card-body">
          <h2 class="card-title mb-5">Daftar Barang</h2>
          <div class="overflow-x-auto">
            <table class="table table-compact w-full" id="table-barang-transaksi">
              <thead>
                <tr>
                  <th></th>
                  <th>Nama Barang</th>
                  <th>Harga</th>
                  <th>Supplier</th>
                  <th>action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="w-full lg:w-1/2">
      {{-- keranjang --}}
      <div class="card w-full bg-neutral text-neutral-content">
        <div class="card-body">
          <div class="flex justify-between mb-5">
            <h2 class="card-title">Keranjang</h2>
            <h2 class="card-title">Total : <span id="totalKeranjang">0</span></h2>
          </div>
          <div class="max-h-[21.5rem] overflow-auto" id="itemsSpace">

          </div>
        </div>
      </div>
    </div>
  </div>
  <button type="button" class="btn btn-primary btn-block mt-3" id="btnSaveTransaction">Save Transaction</button>
</div>

@endsection


@push('my-script')
<script src="js/transaction.js?20" type="module"></script>
@endpush