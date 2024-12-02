document.getElementById('warranty-form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevenir el envío tradicional del formulario

    let serialNumber = document.getElementById('serial_number').value;

    // Hacer la solicitud AJAX
    fetch('../controller/warranty_search.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `serial_number=${encodeURIComponent(serialNumber)}`
    })
    .then(response => response.json()) // Parsear la respuesta a JSON
    .then(data => {
        if (data.error) {
            document.getElementById('result').innerHTML = `<div class="alert alert-danger">${data.error}</div>`;
        } else {
            renderWarrantyInfo(data);
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
        document.getElementById('result').innerHTML = `<div class="alert alert-danger">Error en la solicitud.</div>`;
    });
});

function renderWarrantyInfo(data) {
    // Calcular estado de la garantía
    const dispatchDate = new Date(data.dispatch_date);
    const currentDate = new Date();
    const warrantyPeriod = parseInt(data.warranty_period, 10); // En meses
    const differenceInMonths = (currentDate.getFullYear() - dispatchDate.getFullYear()) * 12 + (currentDate.getMonth() - dispatchDate.getMonth());
    const remainingMonths = warrantyPeriod - differenceInMonths;

    let warrantyStatusMessage, warrantyStatusClass, monthsDetail;

    if (differenceInMonths <= warrantyPeriod) {
        warrantyStatusMessage = 'El producto está en período de garantía.';
        warrantyStatusClass = 'text-success'; // Verde si está en garantía
        monthsDetail = `Restan ${remainingMonths} meses de garantía.`;
    } else {
        warrantyStatusMessage = 'El producto está fuera del período de garantía.';
        warrantyStatusClass = 'text-danger'; // Rojo si está fuera de garantía
        monthsDetail = `Se ha superado la garantía por ${Math.abs(remainingMonths)} meses.`;
    }

    // Mostrar información en el DOM
    document.getElementById('result').innerHTML = `
        <div class="card mt-4 shadow-lg border-primary">
            <div class="card-header bg-primary text-white">
                <h5>Información de la Garantía</h5>
            </div>
            <div class="card-body">
                

<!-- Información del producto -->
<div class="row mb-3">
    <div class="col-md-4">
        <label for="name_product" class="form-label">Producto</label>
        <input type="text" class="form-control" id="name_product" value="${data.name_product}" readonly>
    </div>
    <div class="col-md-4">
        <label for="description" class="form-label">Descripción</label>
        <input type="text" class="form-control" id="description" value="${data.description}" readonly>
    </div>    
</div>
                <div class="row mb-3">                   
                    <div class="col-md-4">
                        <label for="name_supplier" class="form-label">Proveedor</label>
                        <input type="text" class="form-control" id="name_supplier" value="${data.name_supplier}" readonly>
                    </div>
                    <div class="col-md-4">
                     <label for="remito_number" class="form-label">Factura de Compra</label>
                    <input type="text" class="form-control" id="remito_number" value="${data.remito_number}" readonly>
                    </div>
                     <div class="col-md-4">
                        <label for="created_at" class="form-label">Fecha de Compra</label>
                        <input type="text" class="form-control" id="created_at" value="${formatDateTime(data.created_at)}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                 <div class="col-md-4">
                        <label for="customer_name" class="form-label">Cliente</label>
                        <input type="text" class="form-control" id="customer_name" value="${data.customer_name}" readonly>
                    </div>   
                    <div class="col-md-4">
                    <label for="sales_number" class="form-label">Factura de Venta</label>
                    <input type="text" class="form-control" id="sales_number" value="${data.sales_number.toString().padStart(6, '0')}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="dispatch_date" class="form-label">Fecha de Venta</label>
                        <input type="text" class="form-control" id="dispatch_date" value="${formatDateTime(data.dispatch_date)}" readonly>
                    </div>                            
                </div>    
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="warranty_period" class="form-label">Período de Garantía</label>
                        <input type="text" class="form-control" id="warranty_period" value="${data.warranty_period} meses" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="warranty_status" class="form-label">Estado de la Garantía</label>
                        <input type="text" class="form-control ${warrantyStatusClass}" id="warranty_status" value="${warrantyStatusMessage}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="months_detail" class="form-label">Detalle de Garantía</label>
                        <input type="text" class="form-control" id="months_detail" value="${monthsDetail}" readonly>
                    </div>
                </div>

                           
        <div class="row mb-3">
        <div class="col-md-12">
        <h5 class="text-primary">Detalle de Garantía</h5>
        <hr> <!-- Línea separadora opcional -->
        </div>
        </div>
              <div class="row mb-3">
            <div class="col-md-3">
    <label for="warranty_id" class="form-label">ID Garantía</label>
    <!-- Si el dato no es nulo, mostramos el enlace, de lo contrario mostramos N/A -->
    <div class="form-control" style="display: block; text-align: center; padding: 0.375rem 0.75rem; background-color: #f8f9fa; border: 1px solid #ccc; border-radius: 0.375rem;">
        ${data.id ? 
            `<a href="warranty_management.php?id_warranty=${data.id}" class="venta-link" title="Ver detalles de la garantía" style="text-decoration: none; color: inherit;">
                <b>${String(data.id).padStart(6, '0')}</b>
                <i class="fas fa-search ms-1"></i>
            </a>` 
            : 
            `<span>N/A</span>`
        }
    </div>
</div>
                <div class="col-md-3">
                    <label for="status" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="status" value="${data.status || 'N/A'}" readonly>
                </div>
                <div class="col-md-3">
                    <label for="technician_comments" class="form-label">Comentarios del Técnico</label>
                    <textarea class="form-control" id="technician_comments" rows="2" readonly>${data.technician_comments || ''}</textarea>
                </div>
                <div class="col-md-3">
                    <label for="review_date" class="form-label">Fecha de Revisión</label>
                    <input type="text" class="form-control" id="review_date" value="${data.review_date ? formatDateTime(data.review_date) : 'N/A'}" readonly>
                </div>
            </div>
             <!-- Botón para gestionar garantía -->
<div class="text-center mt-4">
    <button id="manageWarrantyBtn" class="btn btn-primary">
        <i class="fas fa-tools"></i> Gestionar Garantía
    </button>
</div>
</div>
</div>`;    
// Agregar funcionalidad al botón para redirigir
document.getElementById('manageWarrantyBtn').addEventListener('click', function () {
    // Verificar si monthsDetail es 0 o menor
    if (warrantyStatusMessage === 'El producto está fuera del período de garantía.') {
        // Si monthsDetail es 0 o menor, mostrar alerta de que está fuera del período de garantía
        Swal.fire({
            icon: 'warning',
            title: '¡Advertencia!',
            text: 'La garantía está fuera del período de cobertura.',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#3085d6',
            allowOutsideClick: false
        });
    } else {
        // Si el estado es "En revisión", redirigir a la funcionalidad de gestionar la garantía con los parámetros
        if (data.status !== "En revisión") {
            const url = `warranty_management.php?serial_number=${encodeURIComponent(data.serial_number)}&name_product=${encodeURIComponent(data.name_product)}&customer_name=${encodeURIComponent(data.customer_name)}&remaining_warranty=${encodeURIComponent(remainingMonths)}`;
            window.location.href = url;
        } else {
            // Si el estado es nulo, vacío o cualquier otro valor, redirigir a la página de detalles de la garantía
            const guaranteeUrl = `warranty_management.php?id_warranty=${encodeURIComponent(data.id)}`;
            window.location.href = guaranteeUrl;
        }
    }
});

}

// Función auxiliar para formatear fechas
function formatDateTime(dateTime) {
    const date = new Date(dateTime);
    return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
}
function formatDateTime(dateString) {
    const date = new Date(dateString);
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');    
    return `${day}/${month}/${year} Hora: ${hours}:${minutes}`;
}
function formatDateTime(dateString) {
    const date = new Date(dateString);
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');    
    return `${day}/${month}/${year} Hora: ${hours}:${minutes}`;
}