document.getElementById("submitBtn").addEventListener("click", function () {
    const form = document.getElementById("warrantyForm");
    const formData = new FormData(form);

    fetch("../controller/manage_warranty.php", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                Swal.fire({
                    icon: "success", 
                    title: "¡Éxito!",
                    text: data.message || "Garantía creada con éxito",
                    confirmButtonText: "Aceptar", 
                }).then(() => {
                    window.location.href = "../views/warranty.php";
                });
            } else {
                Swal.fire({
                    icon: "error", 
                    title: "¡Falla!",
                    text: data.message || "Error al guardar la gestión.",
                    confirmButtonText: "Aceptar", 
                });
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            Swal.fire({
                icon: "error",
                title: "Error de conexión",
                text: "No se pudo conectar con el servidor.",
                confirmButtonText: "Aceptar",
            });
        });
});