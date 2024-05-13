
/**
 * Initializes and displays a table of user locations.
 *
 * @param {boolean} [reload=false] - Whether to reload the table data.
 * @return {void} This function does not return a value.
 */
const showTable = (reload = false) => {
    const user_id = parseInt(window.location.pathname.split("/").pop());
    const userName = document.getElementById("userName");

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    if (reload) {
		$('#listLocations').DataTable().ajax.reload();
	}

    let t = $("#listLocations").DataTable({
        destroy: true,
        responsive: true,
        bAutoWidth: false,
        iDisplayLength: 10,
        language: {
            search: "",
        },
        ajax: {
            url: `/api/user/locations`,
            type: "GET",
            data: { user_id },
            dataSrc: function (data) {
                localStorage.removeItem("data");
                if (data.length > 0) {
                    userName.textContent = data[0].name;
                }
                localStorage.setItem("data", JSON.stringify(data));
                return data;
            },
        },
        columns: [
            {
                className: "text-center",
                data: "user_id",
            },
            {
                data: "region",
            },
            {
                data: "comuna",
            },
            {
                data: "address",
            },
            {
                data: "latitude",
            },
            {
                data: "longitude",
            },
            {
                data: "id",
            },
        ],
        columnDefs: [
            {
                class: "align-middle text-center",
                render: function (data, type, row, meta) {
                    return meta.row + 1;
                },
                targets: 0,
            },
            {
                width: "15%",
                targets: 1,
            },
            {
                class: "text-justify",
                render: function (data, type, row) {
                    if (data) {
                        let truncatedData = data.length > 60 ? data.substring(0, 60) + `....
                        <span class="text-primary" title="${data}"><i class="fa-solid fa-circle-info"></i></span>` : data;
                        return truncatedData;
                    } else {
                        return ""; // Return empty string if data is null
                    }
                },
                width: "30%",
                targets: 3,
            },
            {
                class: "align-middle text-center",
                render: function (data, type, row) {
                    return `<a class="text-decoration-none btn btn-sm btn-primary" href="#" title="View Location" onclick="showLocation(${data})">
                    <i class="fa-solid fa-location-dot"></i>
                    </a>`;
                },
                width: "10%",
                targets: 6,
            },
        ],
        order: [[0, "asc"]],
    });

};

/**
 * Displays the location details in a modal and shows a map with a marker on the selected location.
 *
 * @param {number} data - The ID of the location to display.
 * @return {void} This function does not return a value.
 */
const showLocation = (userId) => {
    localStorage.removeItem("fullAddress");

    const locationModal = $("#locationModal");
    const fullAddress = document.getElementById("fullAddress");

    const locations = JSON.parse(localStorage.getItem("data"));
    const location = locations.find((location) => location.id === userId);

    locationModal.modal("show");

    if (location.address !== null && location.region !== null && location.comuna !== null) {
        fullAddress.textContent = `Address: ${location.address} - Region: ${location.region} - Comuna: ${location.comuna}`;
    }else{
        fullAddress.textContent = "";
    }

    // Elimina el mapa antiguo si existe
    if (window.map) {
        window.map.remove();
    }

    const map = L.map("locationMap").setView(
        [location.latitude, location.longitude],
        13
    );

    window.map = map;

    let marker = L.marker([location.latitude, location.longitude], {
        alt: `${location.address ? location.address : ""}`,
    }).addTo(map);

    const tiles = L.tileLayer(
        "https://tile.openstreetmap.org/{z}/{x}/{y}.png",
        {
            maxZoom: 19,
        }
    ).addTo(map);

    const onMapClick = async (e) => {

        localStorage.removeItem("fullAddress");

        marker.setLatLng(e.latlng).bindPopup(e.latlng.toString()).update();

        // Obtén la dirección de la ubicación seleccionada
        const response = await fetch(
            `https://nominatim.openstreetmap.org/reverse?format=json&lat=${e.latlng.lat}&lon=${e.latlng.lng}`
        ).catch((error) => console.error("Error:", error));

        const data = await response.json();

        const addLoca =  {
            id : userId,
            address : data.display_name,
            region : data.address.state || data.address.town, // La región
            comuna : data.address.city || data.address.town,// La comuna
            latitude : e.latlng.lat,
            longitude : e.latlng.lng,
        }

        localStorage.setItem("fullAddress", JSON.stringify(addLoca));

        fullAddress && (fullAddress.textContent = `Address: ${addLoca.address} - Region: ${addLoca.region} - Comuna: ${addLoca.comuna}`);
    };

    map.on("click", onMapClick);

    // Asume que 'locationModal' es una referencia al modal que estás utilizando
    locationModal.on("shown.bs.modal", function () {
        map.invalidateSize();
    });
};

const handleSaveLocation = async () => {

    $("#locationModal").modal("hide");

    const fullAddress = JSON.parse(localStorage.getItem("fullAddress"));

    if (fullAddress) {
        const response = await axios
            .put(`/api/user/user_location`, fullAddress)
            .catch((error) => console.error("Error:", error));

        if (response.status === 200) {
            showTable(true);
            Swal.fire({
                icon: "success",
                title: "Location saved successfully!",
            });
        }
    }

};

const handleCancelLocation = () => {
    localStorage.removeItem("fullAddress");
};

$(() => {
    "use strict";
    showTable();
});



