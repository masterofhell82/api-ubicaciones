const showTable = () => {

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    let t = $("#listUser").DataTable({
        destroy: true,
        responsive: true,
        bAutoWidth: false,
        iDisplayLength: 10,
        language: {
            search: "",
        },
        ajax: {
            url: '/api/user',
            type: "GET",
            dataSrc: "",
        },
        columns: [
            {
                className: "text-center",
                data: "id",
            },
            {
                data: "name",
            },
            {
                data: "email",
            },
            {
                data: "id",
            },
        ],
        columnDefs: [
            {
                class: "align-middle text-center",
                targets: 0,
            },
            {
                class: "align-middle text-center",
                render: function (data, type, row) {
                    return `<a class="text-decoration-none btn btn-sm btn-primary" href="/users/${data}" title="List Locations">
                        <i class="fa-solid fa-list"></i>
                        </a>`
                },
                width: "10%",
                targets: 3,
            },
        ],
        order: [[1, "asc"]],
    });

};

$(() => {
    "use strict";

    showTable();
});
