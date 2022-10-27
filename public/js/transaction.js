import { items } from "./components/items.js";

$(document).ready(function () {
    const itemsSpace = $("#itemsSpace");
    const toastNotif = $("#toastNotif");
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
        let dataBarang = {
            barang_id: $(this).data("id"),
            nama_barang: $(this).data("barang"),
            qty: 1,
            harga: $(this).data("harga"),
            subtotal: function () {
                return this.harga * this.qty;
            },
        };

        pushItem(dataBarang, Number($(this).data("stok")));

        itemsSpace.html(items(listBarang));
        $("#totalKeranjang").text(getTotal());

        //saveTransaction();
    });

    //save transaction
    $(document).on("click", "#btnSaveTransaction", function () {
        listBarang.length <= 0
            ? alert("pilih barang terlebih dahulu")
            : saveTransaction();

        console.log(listBarang);
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
                transaction_total: getTotal(),
            },
            success: function (response) {
                console.log(JSON.stringify(listBarang));
                console.log(response);
                if (!response.error) {
                    listBarang = [];
                    itemsSpace.empty();
                    $("#totalKeranjang").text("0");
                    showToast(response.message);
                }
            },
            error: function (e) {
                console.log(e.responseText);
            },
        });
    }

    function pushItem(data, stokBarang) {
        //before push check if barang not double
        const checkDoubleItem = listBarang.some(
            (item) => item.barang_id == data.barang_id
        );

        if (checkDoubleItem) {
            const getIndex = listBarang.findIndex(
                (item) => item.barang_id == data.barang_id
            );

            if (listBarang[getIndex].qty >= stokBarang) {
                alert("stok tidak mencukupi");
            } else {
                listBarang[getIndex].qty = listBarang[getIndex].qty + 1;
            }
        } else {
            listBarang.push(data);
        }
    }

    function getTotal() {
        const total = listBarang.reduce(
            (before, currentItem) => before + currentItem.subtotal(),
            0
        );

        return total;
    }

    function showToast(message) {
        toastNotif.removeClass("hidden");
        $(".message-toast").text(message);
        setTimeout(function () {
            toastNotif.toggle("hidden");
        }, 3000);
    }
});
