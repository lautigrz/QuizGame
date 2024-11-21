var tiempo = 11; 

document.addEventListener('DOMContentLoaded', function() {
    if (sessionStorage.getItem('mostrarModal') === 'true') {
        var respuestaIncorrectaModal = new bootstrap.Modal(document.getElementById('respuestaIncorrectaModal'), {
            keyboard: false,
            backdrop: 'static'
        });
        respuestaIncorrectaModal.show();
        
        actualizarTiempoEnModal();
        sessionStorage.removeItem('mostrarModal');
   
    }

        iniciarContador();
    
});
function cerrarYRedirigir(url) {
    var modal = bootstrap.Modal.getInstance(document.getElementById('respuestaIncorrectaModal'));
    modal.hide();

    sessionStorage.removeItem('detenerContador');
    sessionStorage.removeItem('mostrarModal');

    window.location.href = url;
}

function iniciarContador() {
    var contadorElemento = document.getElementById('number');
  
    var intervalo = setInterval(function() {
        if (sessionStorage.getItem('detenerContador') === 'true') {
            clearInterval(intervalo);
            abrilModalTiempo();
            return;
        }

        tiempo--; 
        sessionStorage.setItem('tiempoRestante', tiempo);
        contadorElemento.textContent = tiempo;
      
        if (tiempo === 0) {
            clearInterval(intervalo);
            
        }
    }, 1000);
}

function abrilModalTiempo() {
    // Obtener el modal
    var modal = new bootstrap.Modal(document.getElementById('tiempoTerminado'), {
        keyboard: false, // No cerrar con el teclado
        backdrop: 'static' // No cerrar haciendo clic fuera del modal
    });
    modal.show();
}


function actualizarTiempoEnModal() {
    var contadorModal = document.getElementById('number-modal');
 
    if (contadorModal) {
        var tiempoRestante = parseInt(sessionStorage.getItem('tiempoRestante'), 10);
        contadorModal.textContent = tiempoRestante;
    }

    if(parseInt(sessionStorage.getItem('tiempoRestante'), 10) === 5){
        abrilModalTiempo();
    }
}
