@isset($isCrud)
@if ($isCrud != 1)
<a href="#" data-id="{{ $data->id }}" class="btn btn-info btn-xs edit-btn">Edit</a>
<a href="#" data-id="{{ $data->id }}" class="btn btn-error btn-xs del-btn">Delete</a>
@else
<button type="button" data-id="{{ $data->id }}" data-stok="{{ $data->stok }}" data-harga="{{ $data->price }}"
  data-barang="{{ $data->nama_barang }}" class="btn btn-primary btn-sm" id="btnPilihBarang">Pilih</button>
@endif
@else
<a href="#" data-id="{{ $data->id }}" class="btn btn-info btn-xs edit-btn">Edit</a>
<a href="#" data-id="{{ $data->id }}" class="btn btn-error btn-xs del-btn">Delete</a>
@endisset