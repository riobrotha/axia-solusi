@extends('layouts.main')


@section('content')
<div class="container mx-auto">
  <!-- The button to open modal -->
  <label for="modal-tambah-supplier" class="btn modal-button btn-tambah-supplier">tambah supplier</label>
  @include('parts.modal.supplier.modal_tambah_supplier')
  <div class="overflow-x-auto xl:overflow-x-hidden mt-7">
    <table class="table table-compact w-full" id="table-supplier">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama Supplier</th>
          <th>No HP</th>
          <th>Alamat</th>
          <th>Created At</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>

  @include('parts.modal.supplier.modal_edit_supplier')
</div>

@endsection

@push('my-script')
<script src="js/supplier.js?2"></script>
@endpush