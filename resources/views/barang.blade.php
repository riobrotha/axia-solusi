@extends('layouts.main')


@section('content')
<div class="container mx-auto">
  <!-- The button to open modal -->
  <label for="my-modal-5" class="btn modal-button">tambah barang</label>

  <!-- Put this part before </body> tag -->
  <input type="checkbox" id="my-modal-5" class="modal-toggle" />
  <div class="modal">
    <div class="modal-box w-11/12 max-w-5xl">
      <h3 class="font-bold text-lg">Form Tambah Barang</h3>
      <p class="py-4">You've been selected for a chance to get one year of subscription to use Wikipedia for free!</p>
      <div class="modal-action">
        <label for="my-modal-5" class="btn">Yay!</label>
      </div>
    </div>
  </div>
  <div class="overflow-x-auto mt-7">
    <table class="table table-compact w-full" id="myTable">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama Barang</th>
          <th>Harga</th>
          <th>Stok</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
@endsection


@push('my-script')
<script src="js/barang.js?1"></script>
@endpush