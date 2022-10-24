$(document).ready(function () {
    $("#table-barang").DataTable({
        processing: true,
        serverside: true,
        ajax: "/barang-ajax",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "nama_barang",
                name: "Nama Barang",
            },
            {
                data: "harga",
                name: "Harga",
            },
            {
                data: "stok",
                name: "Stok",
            },
            {
                data: "supplier.nama_supplier",
                name: "Supplier",
            },
            {
                data: "created_by_name.name",
                name: "created_by_name",
            },
            {
                data: "conv_created_at",
                name: "created_at",
            },
            {
                data: "action",
                name: "Action",
            },
        ],
    });

    const namaBarang = $("#nama_barang");
    const harga = $("#harga");
    const stok = $("#stok");
    const supplier = $("#supplier");

    $(document).on("submit", "#formTambahBarang", function (e) {
        e.preventDefault();
        const btnSubmit = $("#btnSubmitTambahBarang");
        const btnCloseModal = $(".btnCloseModal");
        let data = $("#formTambahBarang").serialize();

        $.ajax({
            url: "/barang-ajax",
            type: "POST",
            data: data,
            beforeSend: function () {
                btnSubmit.addClass("loading");
            },
            success: function (response) {
                btnSubmit.removeClass("loading");
                console.log(response);
                if (response.error) {
                    handleErrorValidation(response);
                } else {
                    btnCloseModal.trigger("click");
                    $("#table-barang").DataTable().ajax.reload();
                }
            },
        });
    });

    $(document).on("click", ".btn-tambah-barang", function () {
        resetForm();
    });

    function resetForm() {
        $("#formTambahBarang")[0].reset();
        $(".error-message").remove();
        $("#formTambahBarang input").removeClass("input-error");
        supplier.removeClass("select-error");
    }

    function handleErrorValidation(response) {
        $(".error-message").remove();
        $("#formTambahBarang input").removeClass("input-error");
        supplier.removeClass("select-error");
        if ("nama_barang" in response.data_errors) {
            namaBarang.addClass("input-error");
            namaBarang.after(`<label class="label error-message">
                <span class="label-text-alt text-error text-xs">${response.data_errors.nama_barang[0]}</span>
                </label>`);
        }

        if ("harga" in response.data_errors) {
            harga.addClass("input-error");
            harga.after(`<label class="label error-message">
                <span class="label-text-alt text-error text-xs">${response.data_errors.harga[0]}</span>
                </label>`);
        }

        if ("stok" in response.data_errors) {
            stok.addClass("input-error");
            stok.after(`<label class="label error-message">
                <span class="label-text-alt text-error text-xs">${response.data_errors.stok[0]}</span>
                </label>`);
        }

        if ("supplier_id" in response.data_errors) {
            supplier.addClass("select-error");
            supplier.after(`<label class="label error-message">
                <span class="label-text-alt text-error text-xs">${response.data_errors.supplier_id[0]}</span>
                </label>`);
        }
    }
});
