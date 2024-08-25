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
                        alert(data.error);
                    } else {
                        // Actualizar los campos con la información recibida
                        $('#view_tax').text(data.tax_identifier || '');
                        $('#view_email').text(data.email_supplier || '');
                        $('#view_phone').text(data.phone_supplier || '');
                    }
                },
                error: function() {
                    alert('Error al obtener la información del proveedor.');
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
        const remitoNumber = $('#purchase_year').val() + '-' + $('#purchase_number').val();
        const supplier = $('#id_supplier').val();  // Agregar esta línea

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
            document.getElementById("id_supplier_modal").value = supplier;  // Agregar esta línea

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
});





