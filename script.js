document.addEventListener("DOMContentLoaded", function() {
    const notificationIcon = document.querySelector(".notification img");
    const notificationDropdown = document.querySelector(".notification-dropdown");
    const notificationBadge = document.querySelector(".notification-badge");

    // Simulamos que hay una nueva notificación pendiente
    let nuevasNotificaciones = true;

    if (nuevasNotificaciones) {
        notificationBadge.style.display = "block";
    }

    // Mostrar u ocultar el dropdown al hacer clic en el icono de notificaciones
    notificationIcon.addEventListener("click", function() {
        if (notificationDropdown.style.display === "block") {
            notificationDropdown.style.display = "none";
            // Eliminar la negrita de las notificaciones
            notificationBadge.style.display = "none";
        } else {
            notificationDropdown.style.display = "block";
            // Ocultar el badge de notificaciones al abrir el dropdown
            notificationBadge.style.display = "none";
        }
    });

    // Al hacer clic en una notificación, redirigir a otra página
    const notificationItems = document.querySelectorAll(".notification-item");
    notificationItems.forEach(item => {
        item.addEventListener("click", function() {
            // Aquí deberías agregar la lógica para redirigir a otra página
            // Por ejemplo:
            window.location.href = "notificaciones.html";
        });
    });
    document.getElementById("btn-buscar").addEventListener("click", function() {
        var numEmpleado = document.getElementById("num-empleado").value.trim().toLowerCase();
        var tableRows = document.querySelectorAll("#table-body tr");
    
        tableRows.forEach(function(row) {
            var rowData = row.textContent.trim().toLowerCase();
            if (rowData.includes(numEmpleado)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });

    const resultsCount = 0;


const totalResultadosLabel = document.getElementById('total-resultados');
totalResultadosLabel.textContent = `Total: ${resultsCount} resultado(s)`;
});


document.addEventListener("DOMContentLoaded", function() {
    // Obtener el elemento del calendario de fecha inicial
    var startDateInput = document.getElementById("start-date");

    // Agregar un listener para el evento de cambio en la fecha
    startDateInput.addEventListener("change", function() {
        // Obtener la fecha actual
        var today = new Date();
        
        // Obtener la fecha seleccionada en el calendario
        var selectedDate = new Date(this.value);
        
        // Calcular la diferencia en milisegundos
        var differenceInMilliseconds = selectedDate.getTime() - today.getTime();
        
        // Convertir la diferencia a días
        var differenceInDays = differenceInMilliseconds / (1000 * 60 * 60 * 24);
        
        // Verificar si la diferencia es menor o igual a 4 días
        if (differenceInDays <= 4) {
            alert("La fecha de inicio del viaje debe ser con anticipacion mínima de 4 días a partir de la fecha actual.");
            this.value = "";
        }
    });
});

