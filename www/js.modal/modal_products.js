$(document).ready(function () {// modal para crear estudiantes
    $('.create_products_Btn').click(function () {
        $('#create_Modal').modal('show');
    });
});

$('.editBtn').click(function () {
    
    var id_product = $(this).data('id_product');
    var number_serial = $(this).data('number_serial');
    var number_product = $(this).data('number_product');
    var name_product = $(this).data('name_product');
    var description = $(this).data('description');
    var stock = $(this).data('stock');
    
    
    $('#id_product').val(id_product); // Corregido el ID del campo oculto
    $('#number_serial').val(number_serial);
    $('#number_product').val(number_product);
    $('#name_product').val(name_product);
    $('#description').val(description);
    $('#stock').val(stock); // Corregido el ID del campo de teléfono
   // Corregido el ID del campo de CUIL

    $('#editModal').modal('show');
});




$('.delete_Btn').click(function () {// modal para poder eliminar estudiantes
    var id_product = $(this).data('id_products'); 
    
   
    
    $('#id_product_eliminate').val(id_product);
    
    $('#deleteModal').modal('show');
});
