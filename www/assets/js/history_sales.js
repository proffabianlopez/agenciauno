$(document).ready(function() {
    $('#salesTable').DataTable({
        paging: true,
        searching: true,
        ordering: false,
        info: true,
        responsive: true,
        language: {
            url: "../assets/dist/js/es-ES.json"
        }
    });
});
   
function validarYImprimir(sales_number) {
    // Muestra un SweetAlert para confirmar si desea imprimir
    Swal.fire({
        title: '¿Estás seguro de que deseas imprimir esta venta?',
        text: "Número de Venta: " + sales_number,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, imprimir'
    }).then((result) => {
        if (result.isConfirmed) {
            // Realiza una llamada AJAX para verificar si hay datos del remito
            fetch(`../views/remito.php?sales_number=${sales_number}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la solicitud');
                    }
                    return response.text();
                })
                .then(data => {
                    // Si la respuesta es un mensaje de error, muestra el alert y no continúa
                    if (data.includes("Error: Faltan datos del remito o están vacíos.")) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Faltan datos del remito o están vacíos.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    } else {
                        // Si hay datos, abre el PDF en una nueva pestaña
                        window.open(`../views/remito.php?sales_number=${sales_number}`, '_blank');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo un problema al intentar verificar los datos.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                });
        }
    });
}

function confirmarExportacion(tipo) {
    Swal.fire({
        title: `¿Deseas exportar los datos a ${tipo}?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: `Sí, exportar a ${tipo}`,
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                '¡Exportación en progreso!',
                `Exportando a ${tipo}...`,
                'success'
            );

            // Llamada para iniciar la descarga del archivo
            window.location.href = `../controller/exportar.php?tipo=${tipo}`;
        }
    });
}