// borrar el usuario
function confirmacion() {
    var respuesta = confirm("Desea realmente borrar el usuario");
    if (respuesta == true) {
        return true;
    }
    else {
        return false;
    }
}

// eliminar copias de seguridad
function confirmarEliminacion() {
    let confirmar = confirm("¿Estás seguro de eliminar todas las copias de seguridad?");
    if (confirmar) {
        window.location.href = "PHP/vaciar_backupFUNTION.php"; // Asegúrate de que el archivo existe
    }
}

// limpiar notificaciones
function clearNotifications() {
    if (!confirm("¿Estás seguro de que deseas eliminar todas las notificaciones?")) {
        return;
    }

    fetch('PHP/limpiarNotiFUNTION.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ limpiar: true })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.success) {
            location.reload(); // Recargar la página para actualizar la tabla
        }
    })
    .catch(error => console.error("Error al limpiar notificaciones:", error));
}


