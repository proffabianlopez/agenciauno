document.addEventListener("DOMContentLoaded", function () {
    // Inicializar Select2 para los campos de proveedor y producto
    $('#id_supplier').select2({
        placeholder: "Seleccione un proveedor",
        allowClear: true,
        width: '100%'
    });

    $('#id_product').select2({
        placeholder: "Seleccione un Producto",
        allowClear: true,
        width: '100%'
    });

    // Manejo del cambio de proveedor para actualizar la información correspondiente
    $('#id_supplier').on('change', function() {
        var idSupplier = $(this).val();

        if (idSupplier) {
            // Enviar la solicitud AJAX al servidor
            $.ajax({
                url: '../controller/get_supplier.php', // Ruta al archivo PHP
                type: 'POST',
                data: { id_supplier: idSupplier },
                dataType: 'json',
                success: function(data) {
                    if (data.error) {
                        Swal.fire({
                            title: 'Error',
                            text: data.error,
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    } else {
                        // Actualizar los campos con la información recibida
                        $('#view_tax').text(data.tax_identifier || '');
                        $('#view_email').text(data.email_supplier || '');
                        $('#view_phone').text(data.phone_supplier || '');
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error al obtener la información del proveedor.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
        } else {
            // Limpiar los campos si no hay proveedor seleccionado
            $('#view_tax').text('');
            $('#view_email').text('');
            $('#view_phone').text('');
        }
    });

    // Manejo del click en "Agregar Números de Serie"
document.getElementById("addSerialNumber").addEventListener("click", function () {
    const product = $('#id_product').val();
    const quantity = document.querySelector("input[name='items[0][quantity]']").value;
    const serialCheckbox = document.querySelector("input[name='serial_number']").checked;
    const remitoNumber = $('#number_remito').val() + '-' + $('#remito').val();
    const supplier = $('#id_supplier').val();

    let errors = [];

    if (!product) {
        errors.push('Debe seleccionar un producto.');
    }
    if (quantity <= 0) {
        errors.push('Debe ingresar una cantidad mayor a 0.');
    }
    if (!serialCheckbox) {
        errors.push('Debe marcar el checkbox de números de serie.');
    }
    if (!remitoNumber) {
        errors.push('Debe proporcionar un número de remito.');
    }
    if (!supplier) {
        errors.push('Debe seleccionar un proveedor.');
    }

    if (errors.length > 0) {
        Swal.fire({
            title: 'Error',
            text: errors.join(' '),
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    } else {
        document.getElementById("id_product_modal").value = product;
        document.getElementById("remito_number").value = remitoNumber;
        document.getElementById("id_supplier_modal").value = supplier;

        const tableBody = document.querySelector("#serialTable tbody");
        tableBody.innerHTML = "";

        for (let i = 0; i < quantity; i++) {
            const row = document.createElement("tr");

            const indexCell = document.createElement("th");
            indexCell.scope = "row";
            indexCell.textContent = i + 1;

            const serialInputCell = document.createElement("td");
            const serialInput = document.createElement("input");
            serialInput.type = "text";
            serialInput.name = `items[0][serial_numbers][${i}]`;
            serialInput.className = "form-control";
            serialInput.placeholder = `Ingrese el número de serie ${i + 1}`;

            serialInputCell.appendChild(serialInput);
            row.appendChild(indexCell);
            row.appendChild(serialInputCell);

            tableBody.appendChild(row);
        }

        const serialNumberModal = new bootstrap.Modal(document.getElementById("serialNumberModal"));
        serialNumberModal.show();
    }
});

// Validación del formulario y envío con AJAX
document.getElementById("serialForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Evita el envío normal del formulario

    // Verificar que los campos ocultos tengan valores válidos
    const idProduct = document.getElementById("id_product_modal").value;
    const remitoNumber = document.getElementById("remito_number").value;
    const idSupplier = document.getElementById("id_supplier_modal").value;

    if (!idProduct || !remitoNumber || !idSupplier) {
        Swal.fire({
            title: 'Error',
            text: 'Faltan datos esenciales para el envío. Verifique el ID del producto, el número de remito y el proveedor.',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
        return;
    }

    const serialInputs = document.querySelectorAll("#serialTable input[name^='items[0][serial_numbers]']");
    let emptyFields = false;

    serialInputs.forEach(function(input) {
        if (!input.value.trim()) {
            emptyFields = true;
        }
    });

    if (emptyFields) {
        Swal.fire({
            title: 'Error',
            text: 'Todos los campos de números de serie deben estar completos.',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    } else {
        // Enviar los datos con AJAX
        const formData = $(this).serialize();

        $.ajax({
            url: '../controller/controller_addSerialNumber.php', // Ruta al archivo PHP
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Éxito',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        // Cierra el modal después de guardar y limpia los campos
                        const serialNumberModal = bootstrap.Modal.getInstance(document.getElementById("serialNumberModal"));
                        serialNumberModal.hide();
                        document.getElementById("serialForm").reset();
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.error || 'Error al guardar los números de serie.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Error al enviar el formulario.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    }
});

    

    // Manejo de mensajes guardados en el almacenamiento local (para mostrar con SweetAlert)
    if (localStorage.getItem('mensaje') && localStorage.getItem('tipo')) {
        Swal.fire({
            title: 'Mensaje',
            text: localStorage.getItem('mensaje'),
            icon: localStorage.getItem('tipo'),
            confirmButtonText: 'Aceptar'
        });

        // Limpiar el mensaje después de mostrarlo
        localStorage.removeItem('mensaje');
        localStorage.removeItem('tipo');
    }

    
// Manejo de agregar productos a la tabla
let productCounter = 0;
const table = $('#table_products').DataTable();

$('#addProduct').on('click', function() {
    const productId = $('#id_product').val();
    const productName = $('#id_product option:selected').text();
    const quantity = $('input[name="items[0][quantity]"]').val();
    const supplierId = $('#id_supplier').val();  // Obtén el ID del proveedor

    if (productId && quantity && supplierId) {  // Asegúrate de que supplierId también esté presente
        table.row.add([
            `<input type="hidden" name="items[${productCounter}][id_product]" value="${productId}">${productId}`,
            `<input type="hidden" name="items[${productCounter}][name_product]" value="${productName}">${productName}`,
            `<input type="hidden" name="items[${productCounter}][quantity]" value="${quantity}">${quantity}`,
            
            `<button type="button" class="view-details" data-product-id="${productId}" data-supplier-id="${supplierId}"><i class="fa fa-binoculars"></i></button>`,
            `<button type="button" class="delete-row"><i class="fas fa-trash-alt"></i></button>`
        ]).draw();

        productCounter++;

        // Limpia los campos después de agregar el producto
        $('#id_product').val('').trigger('change');
        $('input[name="items[0][quantity]"]').val('');
    } else {
        Swal.fire('Error', 'Debe seleccionar un producto, un proveedor y una cantidad', 'error');
    }
});

    
    $('#table_products tbody').on('click', '.delete-row', function() {
        table.row($(this).parents('tr')).remove().draw();
    });

    $('#table_products tbody').on('click', '.view-details', function() {
        const productId = $(this).data('product-id');
        const supplierId = $(this).data('supplier-id');  // Obtén el ID del proveedor desde el botón
        const remitoNumber = document.querySelector('input[name="remito"]').value;
    
        const dataToSend = {
            id_product: productId,
            remito_number: remitoNumber,
            id_supplier: supplierId  // Usa el ID del proveedor
        };
    
        $.ajax({
            url: '../controller/get_codSerie.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(dataToSend),
            dataType: 'json',
            success: function(data) {
                if (data && data.length > 0) {
                    const tableBody = document.querySelector("#productDetailsTable tbody");
                    tableBody.innerHTML = ""; // Limpiar el contenido anterior
    
                    data.forEach((productDetails, index) => {
                        const row = document.createElement("tr");
    
                        const lineNumberCell = document.createElement("td");
                        lineNumberCell.textContent = index + 1;
    
                        const serialNumberCell = document.createElement("td");
                        const serialNumberInput = document.createElement("input");
                        serialNumberInput.type = "text";
                        serialNumberInput.name = `items[0][serial_numbers][${index}]`;
                        serialNumberInput.className = "form-control";
                        serialNumberInput.value = productDetails.serial_number;
    
                        serialNumberCell.appendChild(serialNumberInput);
                        row.appendChild(lineNumberCell);
                        row.appendChild(serialNumberCell);
    
                        tableBody.appendChild(row);
                    });
    
                    // Completa los campos ocultos del modal con los valores correctos
                    document.getElementById("id_product_modal").value = productId;
                    document.getElementById("remito_number").value = remitoNumber;
                    document.getElementById("id_supplier_modal").value = supplierId;
    
                    const productDetailsModal = new bootstrap.Modal(document.getElementById("productDetailsModal"), {
                        backdrop: 'static', 
                        keyboard: false 
                    });
                    productDetailsModal.show();
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'No se encontraron detalles del producto.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error during POST request:', xhr.responseText || error);
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al obtener los detalles del producto.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    }); 
});