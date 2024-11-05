$(document).ready(function () {
    // Inicialización del DataTable
    var table = $('#table_products').DataTable({
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 75, 100], // Opciones de cantidad de registros a mostrar
        language: {
            url: "../assets/lang/spanish.json",
        },
        columns: [
            { width: '25%' },
            { width: '25%' },
            { width: '10%' },
            { width: '20%' },
            { width: '20%' }            
        ],
        dom: '<"top"lf><"table-responsive"t><"bottom"ip>',
        buttons: [
            {
                extend: 'excelHtml5',
                className: 'btn btn-success',
                text: '<i class="far fa-file-excel"></i> Excel',
                exportOptions: {
                    columns: ':not(:last-child)' 
                },
                customize: function (xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row c[r^="A"]', sheet).each(function () {
                        $(this).attr('s', '2'); 
                    });
                }
            },
            {
                extend: 'pdfHtml5',
                className: 'btn btn-danger',
                text: '<i class="far fa-file-pdf"></i> PDF',
                exportOptions: {
                    columns: ':not(:last-child)'
                },
                pageSize: 'A4',
                customize: function (doc) {
                    doc.content[1].table.widths = ['25%', '25%', '25%', '25%']; 
                }
            }
        ],
        initComplete: function() {            
            table.buttons().container().appendTo('#botones');
        }
    });

    
    $('.create_products_Btn').click(function () {
        $('#create_Modal').modal('show');
    });
    
$('.viewBtn').click(function () {
    var id_product = $(this).data('id_product');
    var number_serial = $(this).data('number_serial');
    var number_product = $(this).data('number_product');
    var name_product = $(this).data('name_product');
    var description = $(this).data('description');
    var stock = $(this).data('stock');
    var warranty_period = $(this).data('warranty_period'); 

    $('#view_id_product').val(id_product);
    $('#view_number_serial').val(number_serial);
    $('#view_number_product').val(number_product);
    $('#view_name_product').val(name_product);
    $('#view_description').val(description);
    $('#view_stock').val(stock);
    $('#view_warranty_period').val(warranty_period);
    $('#viewModal').modal('show');
});
$('.editBtn').click(function () {
    var id_product = $(this).data('id_product');
    var number_serial = $(this).data('number_serial');
    var number_product = $(this).data('number_product');
    var name_product = $(this).data('name_product');
    var description = $(this).data('description');
    var stock = $(this).data('stock');
    var warranty_period = $(this).data('warranty_period'); 

    $('#id_product').val(id_product); 
    $('#number_serial').val(number_serial);
    $('#number_product').val(number_product);
    $('#name_product').val(name_product);
    $('#description').val(description);
    $('#stock').val(stock);
    $('#edtwarranty_period').val(warranty_period); 
    $('#editModal').modal('show');
});

$('.delete_Btn').click(function () {
    var id_product = $(this).data('id_products');    
    var name_product = $(this).data('name_product');
    var description = $(this).data('description');     
    var combinedText = name_product + ' - ' + description;
    
    $('#id_product_eliminate').val(id_product);
    $('#e_name_product').val(combinedText); 

    $('#deleteModal').modal('show');
});


    // Mostrar mensaje de localStorage si existe
    if (localStorage.getItem('mensaje') && localStorage.getItem('tipo')) {
        Swal.fire({
            title: 'Mensaje',
            text: localStorage.getItem('mensaje'),
            icon: localStorage.getItem('tipo'),
            confirmButtonText: 'Aceptar'
        });

        // Limpia el mensaje después de mostrarlo
        localStorage.removeItem('mensaje');
        localStorage.removeItem('tipo');
    }
});
// Validación al enviar el formulario de creación
$('#createProductForm').submit(function (e) {
    var warrantyPeriod = $('#warranty_period_create').val();
    var isValid = true;
    
    $('#warranty_period_create').removeClass('is-invalid');
    $('#warranty_period_error_create').text('');
    
    if (isNaN(warrantyPeriod) || warrantyPeriod < 1 || warrantyPeriod > 120) {
        $('#warranty_period_create').addClass('is-invalid');
        $('#warranty_period_error_create').text('Por favor, ingrese un número entre 1 y 120.');
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault(); 
    }

$('#editProductForm').submit(function (e) {
    var warrantyPeriod = $('#warranty_period_edit').val();
    var isValid = true;
    $('#warranty_period_edit').removeClass('is-invalid');
    $('#warranty_period_error_edit').text('');

    if (isNaN(warrantyPeriod) || warrantyPeriod < 1 || warrantyPeriod > 120) {
        $('#warranty_period_edit').addClass('is-invalid');
        $('#warranty_period_error_edit').text('Por favor, ingrese un número entre 1 y 120.');
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault(); 
    }
});
});


