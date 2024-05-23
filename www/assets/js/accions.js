$(document).ready(function(){
    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();
    // Select/Deselect checkboxes
    var $checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function(){
        $checkbox.prop('checked', this.checked);
    });
    $checkbox.click(function(){
        if(!this.checked){
            $("#selectAll").prop("checked", false);
        }
    });

    // captura el clic en el icono de edición
    $('.edit').on('click', function(){
        // obtiene los datos del cliente del data attributes
        var $editModal = $('#editEmployeeModal');
        var $editForm = $editModal.find('form');

        var id = $(this).data('id');
        var name = $(this).data('name');
        var email = $(this).data('email');
        var cuit = $(this).data('cuit');
        var phone = $(this).data('phone');
        var street = $(this).data('street');
        var height = $(this).data('height');
        var floor = $(this).data('floor');
        var departament = $(this).data('departament');
        var location = $(this).data('location');
        var observaciones = $(this).data('observaciones');
        
        // llena los campos del formulario del modal de edición
        $editForm.find('#edit-id_customer').val(id);
        $editForm.find('#edit-name').val(name);
        $editForm.find('#edit-email').val(email);
        $editForm.find('#edit-cuit').val(cuit);
        $editForm.find('#edit-phone').val(phone);
        $editForm.find('#edit-street').val(street);
        $editForm.find('#edit-height').val(height);
        $editForm.find('#edit-floor').val(floor);
        $editForm.find('#edit-department').val(departament);
        $editForm.find('#edit-location').val(location);
        $editForm.find('#edit-observaciones').val(observaciones);

        // muestra el modal 
        $editModal.modal('show');
    });
});
$(document).ready(function(){
    // captura el clic en el enlace de eliminar
    $('.delete').on('click', function(){
        // obtiene el id del cliente del atributo data-id
        var id = $(this).data('id');
        // asigna el id al campo oculto en el formulario de eliminación
        $('#deleteEmployeeModal #edit-id_customer').val(id);
    });

   
});

