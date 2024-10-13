$(document).ready(function() {
        // Asignar evento al botón de detalles dentro de la tabla
        $('#purchaseTable').on('click', '.btn-info', function() {
            const remito_number = $(this).data('remito_number'); // Obtener remito_number del botón
            loadHistoryDetails(remito_number); // Llamar a la función para cargar los detalles
        // Detectar cuando se cierra el modal
$('#productHistoryModal').on('hidden.bs.modal', function () {
    // Recargar la página cuando el modal se cierre
    location.reload();
});

        
        });
    $('#purchaseTable').DataTable({
        "language": {
            "paginate": {
                "first": "Primera",
                "last": "Última",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
            "lengthMenu": "Mostrar _MENU_ entradas",
            "search": "Buscar:"
        },
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        lengthChange: false,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });


});
// Función para cargar los detalles de la compra
function loadHistoryDetails(remito_number) {
    $.ajax({
        url: '../controller/get_purchase_history.php',  // Ruta del controlador
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ remito_number: remito_number }),  // Enviar el remito_number
        dataType: 'json',
        success: function(data) {
            if (data && data.products && data.products.length > 0) {
                fillPurchaseDetailsModal(data);  // Llenar el modal con los datos de productos y cabecera
                
                // Crear y mostrar el modal con opciones que permiten cerrar con backdrop y teclado
                const purchaseModal = new bootstrap.Modal(document.getElementById("productHistoryModal"), {
                    backdrop: true,  // Permitir cierre al hacer click fuera
                    keyboard: true   // Permitir cierre con tecla escape
                });
                purchaseModal.show();  // Mostrar el modal
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'No se encontraron productos para este remito.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        },

    });
}
// Función para llenar el modal con los detalles de la compra
function fillPurchaseDetailsModal(data) {
    const modalBody = document.querySelector("#HistoryDetailsContent");
    const modalHeader = document.querySelector("#productHistoryModalLabel");
    
    // Actualizar el título del modal con el remito_number y remito_date
    modalHeader.textContent = `Detalles de Compra - Remito N° ${data.remito_number} (${data.remito_date})`;

    modalBody.innerHTML = '';  // Limpiar el contenido previo

    const table = document.createElement('table');
    table.className = 'table table-bordered';

    // Crear la cabecera de la tabla
    const thead = document.createElement('thead');
    thead.innerHTML = `
        <tr>
            <th>Nombre Producto</th>
            <th>Cantidad</th>
        </tr>
    `;
    table.appendChild(thead);

    const tbody = document.createElement('tbody');

    // Rellenar la tabla con los datos de los productos
    data.products.forEach(product => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${product.name_product}</td>
            <td>${product.qty}</td>
        `;
        tbody.appendChild(row);
    });

    table.appendChild(tbody);
    modalBody.appendChild(table);  // Añadir la tabla al cuerpo del modal
}