$(() => {
    "use strict";

    const logout = document.getElementById("logout");

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    logout.addEventListener("click", (e) => {
        e.preventDefault();

        axios
            .get("/api/auth/logout")
            .then((response) => {
                window.location.href = "/auth/login";
            })
            .catch((error) => {
                console.log(error);
            });
    });

});
