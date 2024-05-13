$(() => {
    "use strict";

    const logout = document.getElementById("logout");

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    const map = L.map("map").setView([10.52634700, -67.12764430], 13);

    const tiles = L.tileLayer(
        "https://tile.openstreetmap.org/{z}/{x}/{y}.png",
        {
            maxZoom: 19,
            attribution:
                '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        }
    ).addTo(map);

    var marker = L.marker([10.52634700, -67.12764430], { alt: "Carayaca" })
        .addTo(map)
        .bindPopup("Carayaca")
});
