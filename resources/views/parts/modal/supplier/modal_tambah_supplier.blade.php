<!-- Put this part before </body> tag -->
<input type="checkbox" id="modal-tambah-supplier" class="modal-toggle" />
<div class="modal">
  <div class="modal-box w-11/12 max-w-5xl relative">
    <label for="modal-tambah-supplier" class="btn btn-sm btn-circle absolute right-5 top-3 btnCloseModal">✕</label>
    <h3 class="font-bold text-lg mb-5 mt-5">Form Tambah Supplier</h3>
    <form action="#" id="formTambahSupplier" class="form-modal">
      @csrf
      <div class="form-control w-full mb-2">
        <label class="label">
          <span class="label-text">Nama Supplier</span>
        </label>
        <input type="text" placeholder="Nama Supplier disini.." class="input input-bordered w-full" name="nama_supplier"
          id="nama_supplier" autocomplete="off" />

      </div>
      <div class="form-control w-full mb-2">
        <label class="label">
          <span class="label-text">Phone</span>
        </label>
        <input type="text" placeholder="No HP Supplier disini.." class="input input-bordered w-full" name="phone"
          id="phone" />
      </div>
      <div class="form-control w-full mb-2">
        <label class="label">
          <span class="label-text">Alamat</span>
        </label>
        <textarea class="textarea textarea-bordered" name="alamat" placeholder="Alamat Supplier disini.."></textarea>
      </div>

      <div class="modal-action">
        <button type="submit" id="btnSubmitTambahSupplier" class="btn">Submit</button>
      </div>
    </form>
  </div>
</div>