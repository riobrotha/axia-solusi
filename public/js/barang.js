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

    const supplier = $("#supplier");
    const toastNotif = $("#toastNotif");
    const btnSubmit = $("#btnSubmitTambahBarang");
    const btnCloseModal = $(".btnCloseModal");
    const btnCloseModalEdit = $(".btnCloseModalEdit");

    $(document).on("submit", "#formTambahBarang", function (e) {
        e.preventDefault();
        let data = $("#formTambahBarang").serialize();

        saveOrUpdate(data);
    });

    $(document).on("submit", "#formUpdateBarang", function (e) {
        e.preventDefault();
        let data = $("#formUpdateBarang").serialize();
        let getId = $("#formUpdateBarang #idBarang").val();
        saveOrUpdate(data, getId);
    });

    $(document).on("click", ".del-btn", function (e) {
        e.preventDefault();
        let id = $(this).data("id");
        if (confirm("Anda yakin ingin menghapus data ini?")) {
            //setup ajax with token csrf
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });

            $.ajax({
                url: "/barang-ajax/" + id,
                type: "DELETE",
                success: function (response) {
                    showToast(response.message);
                    $("#table-barang").DataTable().ajax.reload();
                },
            });
        }
    });

    $(document).on("click", ".edit-btn", function (e) {
        e.preventDefault();
        $(".error-message").remove();
        $(".form-modal input").removeClass("input-error");
        $("select[name=supplier_id]").removeClass("select-error");
        let id = $(this).data("id");

        $.ajax({
            url: "barang-ajax/" + id + "/edit",
            type: "GET",
            beforeSend: function () {},
            success: function (response) {
                $("#modal-edit-barang").prop("checked", true);
                $("#formUpdateBarang #idBarang").val(id);
                $("#formUpdateBarang #nama_barang").val(
                    response.data.nama_barang
                );
                $("#formUpdateBarang #harga").val(response.data.harga);
                $("#formUpdateBarang #stok").val(response.data.stok);
                $("#formUpdateBarang #supplier").val(response.data.supplier_id);
            },
        });
    });

    $(document).on("click", ".btn-tambah-barang", function () {
        resetForm();
    });

    function showToast(message) {
        toastNotif.removeClass("hidden");
        $(".message-toast").text(message);
        setTimeout(function () {
            toastNotif.toggle("hidden");
        }, 3000);
    }

    function resetForm() {
        $("#formTambahBarang")[0].reset();
        $(".error-message").remove();
        $("#formTambahBarang input").removeClass("input-error");
        supplier.removeClass("select-error");
    }

    function handleErrorValidation(response) {
        $(".error-message").remove();
        $(".form-modal input").removeClass("input-error");
        supplier.removeClass("select-error");

        let allDataErrors = response.data_errors;

        Object.keys(allDataErrors).forEach((key) => {
            const getInput = $("input[name=" + key + "]");
            if (key != "supplier_id") {
                getInput.addClass("input-error");
                getInput.after(`<label class="label error-message">
                        <span class="label-text-alt text-error text-xs">${allDataErrors[key][0]}</span>
                        </label>`);
            }

            if (key == "supplier_id") {
                const getSelect = $("select[name=" + key + "]");
                getSelect.addClass("select-error");
                getSelect.after(`<label class="label error-message">
                <span class="label-text-alt text-error text-xs">${allDataErrors[key][0]}</span>
                </label>`);
            }
        });
    }

    function saveOrUpdate(formData, id = "") {
        if (!id) {
            var setUrl = "/barang-ajax";
            var setType = "POST";
        } else {
            var setUrl = "/barang-ajax/" + id;
            var setType = "PUT";
        }

        $.ajax({
            url: setUrl,
            type: setType,
            data: formData,
            beforeSend: function () {
                btnSubmit.addClass("loading");
            },
            success: function (response) {
                btnSubmit.removeClass("loading");
                console.log(response);
                if (response.error) {
                    handleErrorValidation(response);
                } else {
                    if (!id) {
                        btnCloseModal.trigger("click");
                    } else {
                        btnCloseModalEdit.trigger("click");
                    }
                    $("#table-barang").DataTable().ajax.reload();
                    showToast(response.message);
                }
            },
        });
    }
});
