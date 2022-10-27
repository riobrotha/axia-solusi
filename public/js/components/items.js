export function items(barang) {
    const renderBarang = barang
        .map((item) => {
            return `<div class="card w-full bg-primary text-primary-content mb-3">
            <div class="card-body p-5 flex-row items-center justify-between">
              <div>
                <h2 class="card-title gap-0">${item.nama_barang} (<span>${
                item.qty
            }x</span>) (<span>${item.harga}</span>)</h2>
                <p>Subtotal : <span>${item.subtotal()}</span></p>
              </div>
            </div>
          </div>`;
        })
        .join("");

    return renderBarang;
}
