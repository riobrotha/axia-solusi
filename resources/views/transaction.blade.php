@extends('layouts.main')


@section('content')
<div class="container mx-auto">
  <button type="button" class="btn mb-7">Lihat Daftar Transaksi</button>
  <div class="flex flex-wrap">
    <div class="w-full self-center lg:w-1/2">
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
    <div class="w-full self-center lg:w-1/2">
      {{-- keranjang --}}

    </div>
  </div>
</div>

@endsection


@push('my-script')
<script src="js/transaction.js?4"></script>
@endpush