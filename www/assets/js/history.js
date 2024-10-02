$(document).ready(function() {
    $('#purchaseTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
        }
    });
});

function loadProductDetails(idPurchase) {
    $.ajax({
        url: '../controller/get_purchase_history.php',
        type: 'POST',
        data: { id_purchase: idPurchase },
        success: function(response) {
            $('#productDetailsContent').html(response);
        },
        error: function(xhr, status, error) {
            console.error("Error al cargar los detalles del producto:", error);
        }
    });
}


