import './bootstrap';
import Swal from 'sweetalert2';
import axios from 'axios';

// Função para exibir SweetAlert2 após uma operação bem-sucedida
function showSuccessAlert(message, redirectUrl) {
    Swal.fire({
        title: 'Sucesso!',
        text: message,
        icon: 'success',
        confirmButtonText: 'OK',
        timer: null, // Desativa o temporizador para manter o alerta até o usuário clicar no botão
    }).then(() => {
        if (redirectUrl) {
            window.location.href = redirectUrl; // Redireciona após o alerta
        }
    });
}

// Função para confirmação de exclusão
function confirmDelete(id) {
    Swal.fire({
        title: 'Tem certeza?',
        text: 'Você não poderá reverter isso!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            axios
                .delete(`/galeria/${id}/destroy`)
                .then((response) => {
                    showSuccessAlert('A imagem foi excluída com sucesso.', response.data.redirect_url);
                })
                .catch((error) => {
                    Swal.fire({
                        title: 'Erro!',
                        text: 'Não foi possível excluir a imagem.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                    });
                });
        }
    });
}

// Exemplo de exportação, caso necessário
window.confirmDelete = confirmDelete;
