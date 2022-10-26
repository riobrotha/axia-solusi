<!-- Put this part before </body> tag -->
<input type="checkbox" id="modal-edit-barang" class="modal-toggle" />
<div class="modal">
  <div class="modal-box w-11/12 max-w-5xl relative">
    <label for="modal-edit-barang" class="btn btn-sm btn-circle absolute right-5 top-3 btnCloseModalEdit">✕</label>
    <h3 class="font-bold text-lg mb-5 mt-5">Form Edit Barang</h3>
    <form action="#" id="formUpdateBarang" class="form-modal">
      @csrf
      <input type="hidden" id="idBarang">
      <div class="form-control w-full mb-2">
        <label class="label">
          <span class="label-text">Nama Barang</span>
        </label>
        <input type="text" placeholder="Nama Barang disini.." class="input input-bordered w-full" name="nama_barang"
          id="nama_barang" autocomplete="off" />
      </div>
      <div class="form-control w-full mb-2">
        <label class="label">
          <span class="label-text">Harga</span>
        </label>
        <input type="number" placeholder="Harga Barang disini.." class="input input-bordered w-full" name="harga"
          id="harga" />
      </div>
      <div class="form-control w-full mb-2">
        <label class="label">
          <span class="label-text">Stok</span>
        </label>
        <input type="number" placeholder="Stok Barang disini.." class="input input-bordered w-full" name="stok"
          id="stok" />
      </div>
      <div class="form-control w-full">
        <label class="label">
          <span class="label-text">Supplier</span>
        </label>
        <select class="select select-bordered" name="supplier_id" id="supplier">
          <option disabled selected>Pick one</option>
          @foreach ($suppliers as $supplier)
          <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
          @endforeach
        </select>

      </div>
      <div class="modal-action">
        <button type="submit" id="btnSubmitEditBarang" class="btn">Submit</button>
      </div>
    </form>
  </div>
</div>