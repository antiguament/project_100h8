/**
 * Scripts personalizados para la aplicación
 * Este archivo contiene funciones y utilidades comunes
 */

// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    inicializarComponentes();
    inicializarEventos();
});

/**
 * Inicializa los componentes de la interfaz
 */
function inicializarComponentes() {
    // Inicializar tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Inicializar popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Inicializar validación de formularios
    inicializarValidacionFormularios();
}

/**
 * Inicializa los manejadores de eventos
 */
function inicializarEventos() {
    // Menú móvil
    const menuToggle = document.querySelector('.navbar-toggler');
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            document.querySelector('.navbar-collapse').classList.toggle('show');
        });
    }

    // Cerrar menú móvil al hacer clic en un enlace
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            const navbarCollapse = document.querySelector('.navbar-collapse');
            if (navbarCollapse.classList.contains('show')) {
                navbarCollapse.classList.remove('show');
            }
        });
    });
}

/**
 * Inicializa la validación de formularios
 */
function inicializarValidacionFormularios() {
    // Obtener todos los formularios que necesitan validación
    const forms = document.querySelectorAll('.needs-validation');

    // Bucle sobre ellos y evitar el envío
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    });
}

/**
 * Muestra un mensaje de alerta
 * @param {string} mensaje - El mensaje a mostrar
 * @param {string} tipo - El tipo de alerta (success, danger, warning, info)
 * @param {number} tiempo - Tiempo en milisegundos antes de que se oculte (opcional)
 */
function mostrarAlerta(mensaje, tipo = 'info', tiempo = 0) {
    const alerta = document.createElement('div');
    alerta.className = `alert alert-${tipo} alert-dismissible fade show`;
    alerta.role = 'alert';
    alerta.innerHTML = `
        ${mensaje}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    `;

    const contenedor = document.getElementById('alert-container') || document.body;
    contenedor.prepend(alerta);

    // Ocultar después de un tiempo si se especifica
    if (tiempo > 0) {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alerta);
            bsAlert.close();
        }, tiempo);
    }
}

/**
 * Realiza una petición AJAX
 * @param {string} url - La URL a la que hacer la petición
 * @param {string} method - El método HTTP (GET, POST, etc.)
 * @param {Object} data - Los datos a enviar (opcional)
 * @returns {Promise} - Una promesa con la respuesta
 */
function peticionAjax(url, method = 'GET', data = null) {
    const headers = {
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };

    const config = {
        method: method,
        headers: headers,
        credentials: 'same-origin'
    };

    if (data) {
        config.body = JSON.stringify(data);
    }

    return fetch(url, config)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la petición');
            }
            return response.json();
        })
        .catch(error => {
            console.error('Error:', error);
            throw error;
        });
}

// Hacer las funciones disponibles globalmente
window.mostrarAlerta = mostrarAlerta;
window.peticionAjax = peticionAjax;
