$(document).ready(function () {// modal para crear estudiantes
    $('.create_brands_Btn').click(function () {
        $('#create_Modal').modal('show');
    });
});

$('.editBtn').click(function () {
    var id_brand = $(this).data('id_brand');
    var detail = $(this).data('detail');
   
    
    
    $('#id_brand').val(id_brand); // Corregido el ID del campo oculto
    $('#detail').val(detail);


    $('#editModal').modal('show');
});




$('.delete_Btn').click(function () {// modal para poder eliminar estudiantes
    var id_brand = $(this).data('id_brands'); 
    
   
    
    $('#id_brand_eliminate').val(id_brand);
    
    $('#deleteModal').modal('show');
});
