@extends('layouts.main')


@section('content')
<div class="container mx-auto">
  <!-- The button to open modal -->
  <label for="modal-tambah-barang" class="btn modal-button btn-tambah-barang">tambah barang</label>

  @include('parts.modal.modal_tambah_barang')
  <div class="overflow-x-auto xl:overflow-x-hidden mt-7">
    <table class="table table-compact w-full" id="table-barang">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama Barang</th>
          <th>Harga</th>
          <th>Stok</th>
          <th>Supplier</th>
          <th>Created By</th>
          <th>Created At</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>

  @include('parts.modal.modal_edit_barang')
</div>


@endsection


@push('my-script')
<script src="js/barang.js?16"></script>
@endpush