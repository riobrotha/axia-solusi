$(document).ready(function () {
    $("#table-supplier").DataTable({
        processing: true,
        serverside: true,
        ajax: "/supplier-ajax",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "nama_supplier",
                name: "Nama Supplier",
            },
            {
                data: "phone",
                name: "Phone",
            },
            {
                data: "alamat",
                name: "Alamat",
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

    const btnSubmit = $("#btnSubmitTambahSupplier");
    const btnCloseModal = $(".btnCloseModal");
    const btnCloseModalEdit = $(".btnCloseModalEdit");
    const toastNotif = $("#toastNotif");

    $(document).on("submit", "#formTambahSupplier", function (e) {
        e.preventDefault();
        let data = $("#formTambahSupplier").serialize();

        saveOrUpdate(data);
    });

    $(document).on("click", ".edit-btn", function (e) {
        e.preventDefault();
        clearErrorValidation();
        let id = $(this).data("id");

        $.ajax({
            url: "supplier-ajax/" + id + "/edit",
            type: "GET",
            beforeSend: function () {},
            success: function (response) {
                $("#modal-edit-supplier").prop("checked", true);
                $("#formUpdateSupplier #idSupplier").val(id);
                $("#formUpdateSupplier #nama_supplier").val(
                    response.data.nama_supplier
                );
                $("#formUpdateSupplier #phone").val(response.data.phone);
                $("#formUpdateSupplier #alamat").val(response.data.alamat);
            },
        });
    });

    $(document).on("submit", "#formUpdateSupplier", function (e) {
        e.preventDefault();
        let data = $("#formUpdateSupplier").serialize();
        let getId = $("#formUpdateSupplier #idSupplier").val();
        saveOrUpdate(data, getId);
    });

    $(document).on("click", ".btn-tambah-supplier", function () {
        resetForm();
    });

    function saveOrUpdate(formData, id = "") {
        if (!id) {
            var setUrl = "/supplier-ajax";
            var setType = "POST";
        } else {
            var setUrl = "/supplier-ajax/" + id;
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
                    $("#table-supplier").DataTable().ajax.reload();
                    showToast(response.message);
                }
            },
        });
    }

    function showToast(message) {
        toastNotif.removeClass("hidden");
        $(".message-toast").text(message);
        setTimeout(function () {
            toastNotif.toggle("hidden");
        }, 3000);
    }

    function handleErrorValidation(response) {
        $(".error-message").remove();
        $(".form-modal input").removeClass("input-error");
        $("textarea[name=alamat]").removeClass("textarea-error");

        let allDataErrors = response.data_errors;

        Object.keys(allDataErrors).forEach((key) => {
            const getInput = $("input[name=" + key + "]");
            if (key != "alamat") {
                getInput.addClass("input-error");
                getInput.after(`<label class="label error-message">
                        <span class="label-text-alt text-error text-xs">${allDataErrors[key][0]}</span>
                        </label>`);
            }

            if (key == "alamat") {
                const getSelect = $("textarea[name=" + key + "]");
                getSelect.addClass("textarea-error");
                getSelect.after(`<label class="label error-message">
                <span class="label-text-alt text-error text-xs">${allDataErrors[key][0]}</span>
                </label>`);
            }
        });
    }

    function resetForm() {
        $("#formTambahSupplier")[0].reset();
        $(".error-message").remove();
        $("#formTambahSupplier input").removeClass("input-error");
        $("textarea[name=alamat]").removeClass("textarea-error");
    }

    function clearErrorValidation() {
        $(".error-message").remove();
        $(".form-modal input").removeClass("input-error");
        $("select[name=supplier_id]").removeClass("select-error");
    }
});
