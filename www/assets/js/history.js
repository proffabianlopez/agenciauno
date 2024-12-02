document.addEventListener('DOMContentLoaded', function() {
    initDataTable(); 

    document.getElementById('filterForm').addEventListener('submit', function(event) {
        event.preventDefault();
        if (validarFechaRango()) { 
            aplicarFiltros(); 
        }
    });    
    ['date_from', 'date_to'].forEach(id => {
        document.getElementById(id).addEventListener('input', function(event) {
            autoCompletarFecha(event.target);
        });
        document.getElementById(id).addEventListener('blur', function(event) {
            validarFormatoFecha(event);
            if (id === 'date_to') {
                validarRangoFechas(); 
            }
        });
    });
     // Alternar íconos en botones de colapso
     document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(button => {
        button.addEventListener('click', function () {
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-chevron-down');
            icon.classList.toggle('fa-chevron-up');
        });
    });
});

function initDataTable() {
    $('#purchaseTable').DataTable({
        paging: true,
        searching: false,
        ordering: true,
        info: true,
        responsive: true,
        destroy: true,
        language: {
            url: "../assets/dist/js/es-ES.json"
        },
        order: [[0, 'desc']]
    });
}
function convertirFechaADiaMesAnio(fecha) {
    const [year, month, day] = fecha.split('-');
    return `${day}-${month}-${year}`;
}

function convertirFechaAAnioMesDia(fecha) {
    const [day, month, year] = fecha.split('-');
    return `${year}-${month}-${day}`;
}

function esFechaValida(fecha) {
    return /^\d{2}-\d{2}-\d{4}$/.test(fecha);
}


function validarRangoFechas() {
    const dateFrom = document.getElementById('date_from').value;
    const dateTo = document.getElementById('date_to').value;

    if (dateFrom && dateTo) {
        const dateFromObj = new Date(convertirFechaAAnioMesDia(dateFrom));
        const dateToObj = new Date(convertirFechaAAnioMesDia(dateTo));
        if (dateToObj < dateFromObj) {
            Swal.fire({
                title: 'Rango de fechas inválido',
                text: 'La fecha final no puede ser anterior a la fecha inicial.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
            document.getElementById('date_to').value = '';
        }
    }
}

function validarFormatoFecha(event) {
    const fecha = event.target.value;
    if (fecha && !esFechaValida(fecha)) {
        Swal.fire("Formato de fecha inválido", "Por favor, usa el formato DD-MM-YYYY.", "error");
        event.target.value = ''; 
    }
}

function autoCompletarFecha(input) {
    if (input.value.length === 2 || input.value.length === 5) {
        input.value += '-';
    }
}
 
function limpiarFiltros() {
    Swal.fire({
        title: '¿Deseas limpiar todos los filtros?',
        text: "Esto restaurará la tabla a su estado original.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, limpiar filtros',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {            
            window.location.href = 'purchase_list.php';
        }
    });
}

function aplicarFiltros() {
    const dateFrom = document.getElementById('date_from').value;
    const dateTo = document.getElementById('date_to').value;
    const remitoNumber = document.getElementById('remito_number').value;
    const invoiceNumber = document.getElementById('invoice_number').value;
    const supplierName = document.getElementById('supplier_name').value;

    if (!dateFrom && !dateTo && !remitoNumber && !invoiceNumber && !supplierName) {
        return Swal.fire('Sin filtros aplicados', 'Selecciona al menos un criterio de filtro.', 'warning');
    }     
    const filters = {
        date_from: dateFrom ? convertirFechaAAnioMesDia(dateFrom) : '',
        date_to: dateTo ? convertirFechaAAnioMesDia(dateTo) : '',
        remito_number: remitoNumber || null,
        invoice_number: invoiceNumber || null,
        supplier_name: supplierName || null
    };

    fetch('../controller/filter_purchases.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(filters)
    })
    .then(response => {     
        return response.json();
    })
    .then(data => {        
        if (data.purchases) {
            actualizarTabla(data.purchases);
        } else {
            Swal.fire("No se encontraron resultados", "", "info");
        }
    })
    .catch(error => manejarError(error, "Error al procesar la solicitud"));
    
}

function actualizarTabla(purchases) {
    const purchasesTable = $('#purchaseTable').DataTable();    
    purchasesTable.clear().draw();    
    if (purchases.length > 0) {
        purchases.forEach(purchase => {            
            const invoiceDate = convertirFechaADiaMesAnio(purchase.invoice_date);
            const remitoDate = purchase.remito_date ? convertirFechaADiaMesAnio(purchase.remito_date) : '';            
            purchasesTable.row.add([
                `<a href="purchase_detail.php?id=${purchase.invoice_number}" class="venta-link" title="Ver detalles de la compra">
                    <b>${purchase.invoice_number}</b> <i class="fas fa-search ms-1"></i>
                 </a>`,
                invoiceDate,
                purchase.name_supplier,
                purchase.remito_number || '', 
                remitoDate
            ]).draw(false);
        });
    } else {        
        purchasesTable.row.add([
            '<td colspan="1" class="text-center">No se encontraron compras.</td>',
            '<td colspan="1" class="text-center"></td>',
            '<td colspan="1" class="text-center"></td>',
            '<td colspan="1" class="text-center"></td>',
            '<td colspan="1" class="text-center"></td>'
        ]).draw(false);
    }
}

function manejarError(error, mensaje = "Ocurrió un error") {
    console.error(error);
    Swal.fire("Error", mensaje, "error");
}

function validarFechaRango() {
    const dateFrom = document.getElementById('date_from').value;
    const dateTo = document.getElementById('date_to').value;

    if (dateFrom && dateTo) {
        const dateFromObj = new Date(convertirFechaAAnioMesDia(dateFrom));
        const dateToObj = new Date(convertirFechaAAnioMesDia(dateTo));

        if (dateToObj < dateFromObj) {
            Swal.fire("Rango de fechas inválido", "La fecha final no puede ser anterior a la fecha inicial.", "error");
        }
    }
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

            window.location.href = `../controller/exportar_purchase.php?tipo=${tipo}`;
        }
    });
}as