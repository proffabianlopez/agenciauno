$(document).ready(function () {
    $('.edit').on('click', function () {
        var $editModal = $('#editEmployeeModal');
        var id = $(this).data('id');
        var name = $(this).data('name');
        var phone = $(this).data('phone');
        var password = $(this).data('password');

        console.log("ID: ", id); // Debug
        console.log("Name: ", name); // Debug
        console.log("Phone: ", phone); // Debug
        console.log("Password: ", password); // Debug

        $editModal.find('#edit-id_user').val(id);
        $editModal.find('#edit-name').val(name);
        $editModal.find('#edit-phone').val(phone);
        $editModal.find('#edit-password').val(password);
        $editModal.modal('show');
    });

    $('.delete').on('click', function () {
        var $deleteModal = $('#deleteEmployeeModal');
        var id = $(this).data('id');
        $deleteModal.find('#delete-id_user').val(id);
        $deleteModal.modal('show');
    });
});
