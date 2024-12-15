document.addEventListener('DOMContentLoaded', function() {    
    initDataTable();    
    
    // Manejo del formulario de filtros
    document.getElementById('filterForm').addEventListener('submit', function(event) {
        event.preventDefault();
        aplicarFiltros(); 
    });    

    // Eventos para fechas
    document.getElementById('date_from').addEventListener('input', function(event) {
        autoCompletarFecha(event.target);
    });
    document.getElementById('date_from').addEventListener('blur', validarFechaRango);

    document.getElementById('date_to').addEventListener('input', function(event) {
        autoCompletarFecha(event.target);
    });
    document.getElementById('date_to').addEventListener('blur', validarFechaRango); 
    
    // Eventos para números de venta
    document.getElementById('sale_number_from').addEventListener('blur', validarNumeroVenta); 
    document.getElementById('sale_number_to').addEventListener('blur', validarNumeroVenta); 
    
    // Alternar íconos en botones de colapso
    document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(button => {
        button.addEventListener('click', function () {
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-chevron-down');
            icon.classList.toggle('fa-chevron-up');
        });
    });
});

function limpiarFiltros() {
    Swal.fire({
        title: '¿Deseas limpiar todos los filtros?',
        text: "Esto restaurará la tabla a su estado original.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, limpiar filtros'
    }).then((result) => {
        if (result.isConfirmed) {            
            window.location.href = 'sales_list.php';
        }
    });
}

function initDataTable() {
    $('#salesTable').DataTable({
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


function aplicarFiltros() {
    const dateFrom = document.getElementById('date_from').value;
    const dateTo = document.getElementById('date_to').value;
    const saleNumberFrom = document.getElementById('sale_number_from').value;
    const saleNumberTo = document.getElementById('sale_number_to').value;
    const customerName = document.getElementById('customer_name').value;

    if (!dateFrom && !dateTo && !saleNumberFrom && !saleNumberTo && !customerName) {
        Swal.fire({
            title: 'Sin filtros aplicados',
            text: 'Por favor, selecciona al menos un criterio de filtro.',
            icon: 'warning',
            confirmButtonText: 'Aceptar'
        });
        return;
    }    
    if (dateFrom && !esFechaValida(dateFrom)) {
        Swal.fire("Formato incorrecto", "Por favor ingrese la fecha desde en el formato DD-MM-YYYY.", "error");
        return;
    }
    if (dateTo && !esFechaValida(dateTo)) {
        Swal.fire("Formato incorrecto", "Por favor ingrese la fecha hasta en el formato DD-MM-YYYY.", "error");
        return;
    }   
    
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
            return;
        }
    }    
    if (saleNumberFrom && saleNumberTo && parseInt(saleNumberTo) < parseInt(saleNumberFrom)) {
        Swal.fire({
            title: 'Rango de número de venta inválido',
            text: 'El número de venta final no puede ser menor que el número de venta inicial.',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
        return;
    }    
    const filters = {
        date_from: dateFrom ? convertirFechaAAnioMesDia(dateFrom) : '',
        date_to: dateTo ? convertirFechaAAnioMesDia(dateTo) : '',
        sale_number_from: saleNumberFrom || null,
        sale_number_to: saleNumberTo || null,
        customer_name: customerName || null
    };
    console.log("Filtros enviados:", filters);

    fetch('../controller/filter_sales.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(filters)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }
        return response.json();
    })
    .then(data => {
        console.log("Datos recibidos del servidor:", data);
        if (data.sales) {
            data.sales = data.sales.map(sale => ({
                ...sale,
                sale_date: convertirFechaADiaMesAnio(sale.sale_date)
            }));
            actualizarTabla(data.sales);
        } else if (data.error) {
            Swal.fire("Error", "Hubo un error al procesar la solicitud: " + data.error, "error");
        } else {
            Swal.fire("Formato inesperado", "Se recibió un formato de respuesta inesperado.", "error");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire("Error", "Hubo un problema al procesar la solicitud.", "error");
    });
}

function actualizarTabla(sales) {
    const salesTable = $('#salesTable').DataTable(); 
    
    salesTable.clear().draw();
    
    if (sales && sales.length > 0) {
        sales.forEach(sale => {
            salesTable.row.add([
                `<a href="sales_detail.php?id=${sale.sales_number}" class="venta-link">
                    <b>${sale.sales_number.toString().padStart(6, '0')}</b>
                    <i class="fas fa-search ms-1"></i>
                </a>`,
                sale.customer_name,
                sale.sale_date,
                `<i class="fas fa-print text-primary" style="cursor: pointer; font-size: 1.2em;" 
                    onclick="validarYImprimir('${sale.sales_number}');" title="Imprimir venta"></i>`
            ]).draw(false);
        });
    } else {        
        salesTable.row.add([
            '<td colspan="1" class="text-center">No se encontraron ventas.</td>',
            '<td colspan="1" class="text-center"></td>',
            '<td colspan="1" class="text-center"></td>',
            '<td colspan="1" class="text-center"></td>'
        ]).draw(false);
    }
}


function validarYImprimir(sales_number) {
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
            fetch(`../views/remito.php?sales_number=${sales_number}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la solicitud');
                    }
                    return response.text();
                })
                .then(data => {
                    if (data.includes("Error: Faltan datos del remito o están vacíos.")) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Faltan datos del remito o están vacíos.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    } else {
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

            window.location.href = `../controller/exportar.php?tipo=${tipo}`;
        }
    });
}

function autoCompletarFecha(input) {
    if (input.value.length === 2 || input.value.length === 5) {
        input.value += '-';
    }
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

function validarNumeroVenta() {
    const saleNumberFrom = document.getElementById('sale_number_from').value;
    const saleNumberTo = document.getElementById('sale_number_to').value;

    if (saleNumberFrom && saleNumberTo && parseInt(saleNumberTo) < parseInt(saleNumberFrom)) {
        Swal.fire("Rango de número de venta inválido", "El número de venta final no puede ser menor que el número de venta inicial.", "error");
    }
}