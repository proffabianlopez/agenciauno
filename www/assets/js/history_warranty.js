document.addEventListener('DOMContentLoaded', function () {
    initWarrantyTable();

    // Manejo del formulario de filtros
    document.getElementById('filterForm').addEventListener('submit', function (event) {
        event.preventDefault();
        aplicarFiltros();
    });
});

function initWarrantyTable() {
    $('#guaranteesTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        responsive: true,
        destroy: true,
        language: {
            url: "../assets/dist/js/es-ES.json",
        },
        order: [[0, 'desc']],
    });
}

function aplicarFiltros() {
    const dateFrom = document.getElementById('date_from').value;
    const dateTo = document.getElementById('date_to').value;
    const guaranteeId = document.getElementById('guarantee_id').value;
    const serialNumber = document.getElementById('serial_number').value;
    const technicalComments = document.getElementById('technical_comments').value;
    const supplierName = document.getElementById('supplier_name').value;
    const status = document.getElementById('status').value;

    // Validar formato de fechas
    const dateRegex = /^\d{2}-\d{2}-\d{4}$/;
    if ((dateFrom && !dateRegex.test(dateFrom)) || (dateTo && !dateRegex.test(dateTo))) {
        Swal.fire({
            title: 'Formato de fecha incorrecto',
            text: 'Por favor, utiliza el formato DD-MM-YYYY.',
            icon: 'error',
            confirmButtonText: 'Aceptar',
        });
        return;
    }

    const filters = {
        date_from: dateFrom || null,
        date_to: dateTo || null,
        guarantee_id: guaranteeId || null,
        serial_number: serialNumber || null,
        technical_comments: technicalComments || null,
        supplier_name: supplierName || null,
        status: status || null,
    };

    fetch('../controller/warranty_history.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(filters),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then((data) => {
            if (data.success && data.data) {
                actualizarTabla(data.data);
            } else {
                Swal.fire({
                    title: 'Sin resultados',
                    text: 'No se encontraron resultados con los filtros aplicados.',
                    icon: 'info',
                    confirmButtonText: 'Aceptar',
                });
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error',
                text: 'Hubo un problema al procesar la solicitud. Verifique su conexión o contacte al administrador.',
                icon: 'error',
                confirmButtonText: 'Aceptar',
            });
        });
}

function actualizarTabla(guarantees) {
    const warrantyTable = $('#guaranteesTable').DataTable();
    warrantyTable.clear().draw();

    if (guarantees && guarantees.length > 0) {
        guarantees.forEach((guarantee) => {
            warrantyTable.row.add([
                guarantee.guarantee_id,
                guarantee.serial_number,
                guarantee.status || 'No disponible',
                guarantee.technical_comments || 'No disponible',
                guarantee.review_date ? formatFecha(guarantee.review_date) : 'No disponible',
                guarantee.name_product || 'No disponible',
                guarantee.name_supplier || 'No disponible',
            ]).draw(false);
        });
    }
}

function limpiarFiltros() {
    Swal.fire({
        title: '¿Deseas limpiar todos los filtros?',
        text: 'Esto restaurará la tabla a su estado original.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, limpiar filtros',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('filterForm').reset();
            aplicarFiltros(); // Restablecer la tabla sin filtros
        }
    });
}

function formatFecha(fecha) {
    const [year, month, day] = fecha.split('-');
    return `${day}-${month}-${year}`;
}