function showSuccessAlert(title, text) {
    return Swal.fire({
        title: title,
        text: text,
        icon: 'success',
        confirmButtonText: 'OK'
    });
}

// Função para exibir um alerta de erro
function showErrorAlert(title, text) {
    Swal.fire({
        title: title,
        text: text,
        icon: 'error',
        confirmButtonText: 'OK'
    });
}

// Função para exibir um alerta de confirmação
function showConfirmAlert(title, text, confirmCallback) {
    Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não'
    }).then((result) => {
        if (result.isConfirmed) {
            confirmCallback();
        }
    });
}
