@extends('layouts.main')


@section('content')
<div class="container mx-auto">
  <div class="overflow-x-auto xl:overflow-x-hidden mt-7">
    <table class="table table-compact w-full" id="table-transaction">
      <thead>
        <tr>
          <th>#</th>
          <th>ID Transaction</th>
          <th>Created By</th>
          <th>Transaction Total</th>
          <th>Created At</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
@endsection


@push('my-script')
<script src="/js/transaction_list.js"></script>
@endpush