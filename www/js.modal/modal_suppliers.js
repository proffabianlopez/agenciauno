$(document).ready(function () {
    $('.create_suppliers_Btn').click(function () {
        $('#create_Modal').modal('show');
    });
});
$('.viewBtn').click(function () {
    var id_supplier = $(this).data('id');
    var name_supplier = $(this).data('name');
    var phone_supplier = $(this).data('phone');
    var email_supplier = $(this).data('email');
    var observations = $(this).data('obs');
    var tax_identifier = $(this).data('tax');
    var street_supplier = $(this).data('street');
    var height_supplier = $(this).data('height');
    var floor_supplier = $(this).data('floor');
    var departament_supplier = $(this).data('departament');
    var location_supplier = $(this).data('location');
    $('#view_name').text(name_supplier);
    $('#view_phone').text(phone_supplier);
    $('#view_email').text(email_supplier);
    $('#view_obs').text(observations);
    $('#view_tax').text(tax_identifier);
    $('#view_street').text(street_supplier);
    $('#view_height').text(height_supplier);
    $('#view_floor').text(floor_supplier);
    $('#view_departament').text(departament_supplier);
    $('#view_location').text(location_supplier);
    $('#viewModal').modal('show');
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
    
    $('#id_supplier').val(id_supplier); 
    $('#name_supplier').val(name_supplier);
    $('#phone').val(phone_supplier); 
    $('#email').val(email_supplier)
    $('#obs').val(observations); 
    $('#tax').val(tax_identifier); 
    $('#street').val(street_suplier);
    $('#height').val(height_suplier);
    $('#floor').val(floor_suplier);
    $('#departament').val(departament_suplier);
    $('#location').val(location_suplier);
    $('#editModal').modal('show');
});
$('.delete_Btn').click(function () {
    var supplier_id = $(this).data('id_suppliers'); 
    $('#id_supplier_eliminate').val(supplier_id);
    $('#deleteModal').modal('show');
});
