$(document).ready(function () {// modal para crear estudiantes
    $('.create_suppliers_Btn').click(function () {
        $('#create_Modal').modal('show');
    });
});

$('.editBtn').click(function () {
    var id_supplier = $(this).data('id');
    var name_supplier = $(this).data('name');
    var phone_supplier = $(this).data('phone');
    var email_supplier = $(this).data('email');
    var observations = $(this).data('obs');
    var tax_identifier = $(this).data('tax');
    
    $('#id_supplier').val(id_supplier); // Corregido el ID del campo oculto
    $('#name_supplier').val(name_supplier);
    $('#phone').val(phone_supplier); // Corregido el ID del campo de teléfono
    $('#email').val(email_supplier); // Corregido el ID del campo de email
    $('#obs').val(observations); // Corregido el ID del campo de observaciones
    $('#tax').val(tax_identifier); // Corregido el ID del campo de CUIL

    $('#editModal').modal('show');
});




$('.delete_Btn').click(function () {// modal para poder eliminar estudiantes
    var supplier_id = $(this).data('id_suppliers'); 
    
   
    
    $('#id_supplier_eliminate').val(supplier_id);
    
    $('#deleteModal').modal('show');
});
