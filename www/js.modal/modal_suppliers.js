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
    var street_suplier = $(this).data('street');
    var height_suplier = $(this).data('height');
    var floor_suplier = $(this).data('floor');
    var departament_suplier = $(this).data('departament');
    var location_suplier = $(this).data('location');
    
    $('#id_supplier').val(id_supplier); // Corregido el ID del campo oculto
    $('#name_supplier').val(name_supplier);
    $('#phone').val(phone_supplier); // Corregido el ID del campo de teléfono
    $('#email').val(email_supplier); // Corregido el ID del campo de email
    $('#obs').val(observations); // Corregido el ID del campo de observaciones
    $('#tax').val(tax_identifier); // Corregido el ID del campo de CUIL
    $('#street').val(street_suplier);
    $('#height').val(height_suplier);
    $('#floor').val(floor_suplier);
    $('#departament').val(departament_suplier);
    $('#location').val(location_suplier);

    $('#editModal').modal('show');
});




$('.delete_Btn').click(function () {// modal para poder eliminar estudiantes
    var supplier_id = $(this).data('id_suppliers'); 
    
   
    
    $('#id_supplier_eliminate').val(supplier_id);
    
    $('#deleteModal').modal('show');
});
