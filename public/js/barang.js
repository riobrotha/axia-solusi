$(document).ready(function () {
    $("#myTable").DataTable({
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
                data: "action",
                name: "Action",
            },
        ],
    });
});
