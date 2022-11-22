window.swal = require("sweetalert2");

/**** Un función para probar ****/
function firemsgSuccess(message) {
    swal.fire({
        title: message,
        icon: "success",
    });
}
window.firemsgSuccess = firemsgSuccess;
