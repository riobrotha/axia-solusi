$(document).ready(function () {
    $("#table-barang-transaksi").DataTable({
        processing: true,
        serverside: true,
        ajax: "/barang-ajax?c=1",
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
                data: "supplier.nama_supplier",
                name: "Supplier",
            },
            {
                data: "action",
                name: "Action",
            },
        ],
    });

    let listBarang = [];
    $(document).on("click", "#btnPilihBarang", function () {
        //before push check if id barang same
        // const checkDoubleItem = listBarang.find(item => item.idBarang == $(this).data('id'));

        const checkDoubleItem = listBarang.some(
            (item) => item.barang_id == $(this).data("id")
        );

        console.log(checkDoubleItem);

        if (checkDoubleItem) {
            const getIndex = listBarang.findIndex(
                (item) => item.barang_id == $(this).data("id")
            );

            listBarang[getIndex].qty = listBarang[getIndex].qty + 1;
        } else {
            listBarang.push({
                barang_id: $(this).data("id"),
                namaBarang: $(this).data("barang"),
                qty: 1,
            });
        }

        console.log(listBarang);

        //saveTransaction();
    });

    function saveTransaction() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: "/transaction-ajax",
            type: "POST",
            data: {
                transactions: JSON.stringify(listBarang),
            },
            success: function (response) {
                console.log(response);
            },
        });
    }
});
