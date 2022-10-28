$(document).ready(function () {
    $("#table-transaction").DataTable({
        processing: true,
        serverside: true,
        ajax: "/transaction-ajax",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "id",
                name: "ID Transaction",
            },
            {
                data: "user.name",
                name: "Created By",
            },
            {
                data: "transaction_total",
                name: "Transaction Total",
            },
            {
                data: "conv_created_at",
                name: "created_at",
            },
        ],
    });
});
