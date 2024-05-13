$(() => {
    "use strict";

    let latitude, longitude;

    navigator.geolocation.getCurrentPosition(position => {
        latitude = position.coords.latitude;
        longitude = position.coords.longitude;
    });


    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const remember = document.getElementById("remember");
    const btnLogin = document.getElementById("btnLogin");

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    btnLogin.addEventListener("click", async (e) => {

        e.preventDefault();

        if (!email.value || !password.value) {
            return;
        }

        const data = {
            email: email.value,
            password: password.value,
            latitude,
            longitude,
        };

        axios
            .post("/api/auth/login", data)
            .then((res) => {
                console.log(res);
                window.location.href = "/admin/dashboard";
            })
            .catch((err) => {
                console.log(err);
            });
    });

});
