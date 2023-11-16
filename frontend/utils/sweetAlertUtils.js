// utils/sweetAlertUtils.js

function showSuccessAlert(message) {
    return new Promise((resolve) => {
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: message,
        }).then((result) => {
            resolve(result.value);
        });
    });
}

function showErrorAlert(message) {
    return new Promise((resolve) => {
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: message,
        }).then((result) => {
            resolve(result.value);
        });
    });
}

async function showConfirmAlert(message) {
    return new Promise((resolve) => {
        Swal.fire({
            title: '¿Estás seguro?',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            resolve(result.value);
        });
    });
}

function showLoadingAlert(isLoading) {
    if (isLoading) {
        Swal.fire({
            title: 'Cargando...',
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                Swal.showLoading();
            }
        });
    } else {
        Swal.close();
    }
}