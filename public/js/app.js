const boton = document.getElementById('botonActivar');
const ventanaEmergente = document.getElementById('ventanaEmergente');
const alertaCompra = document.getElementById('compraConfirmada');
const menuHome = document.getElementById('menuHome');
function autoClickBoton() {
    if (window.innerWidth > 640) {
        boton.click();
    }
}
function ventanaEmergenteOn(active, ventana, ventana2) {
    let estado = 'oculto';
    active.addEventListener('click', function () {
        active.classList.toggle('flechaMenuE');
        if (estado === 'oculto') {
            active.classList.add('mt-[10rem]');
            ventana.classList.remove('max-sm:w-20');
            ventana.classList.remove('w-40');
            ventana.classList.add('w-screen')
            ventana2.classList.remove('max-sm:hidden');
            ventana2.classList.remove('w-full');
            ventana2.classList.add('w-[50%]');
            ventana.classList.add('sm:hidden');
            ventana.classList.add(
                'bg-transparent',
                'flex',
                'justify-center',
                'items-center',
                'bg-gradient-to-br',
                'from-opacity-10',
                'to-transparent',
                'backdrop-blur-lg',
                'shadow-lg'
            );

            estado = 'Activo';
        } else {
            ventana.classList.add('max-sm:w-20');
            ventana.classList.add('w-40');
            ventana.classList.remove('w-screen')
            ventana2.classList.add('max-sm:hidden');
            ventana.classList.remove('sm:hidden')
            ventana2.classList.add('w-full');
            ventana2.classList.remove('w-[50%]');
            ventana.classList.remove(
                'bg-transparent',
                'flex',
                'justify-center',
                'items-center',
                'bg-gradient-to-br',
                'from-opacity-10',
                'to-transparent',
                'backdrop-blur-lg',
                'shadow-lg'
            );
            // max-sm:w-20 w-40
            estado = 'oculto';
        }
    });
    autoClickBoton();
}
function alertas(targeta){
    setTimeout(()=>{
        targeta.classList='hidden'
    }, 2000)
}

alertas(alertaCompra);

ventanaEmergenteOn(boton, ventanaEmergente, menuHome);

//bashboard del usuario




// // Selección del botón y de la ventana emergente
// const boton = document.getElementById('flechaMenu');
// const ventanaEmergente = document.getElementById('menuHome');
// const estilosOriginalesMenu = ventanaEmergente.getAttribute('style');
// // const estilosOriginalesMenu = ventanaEmergente.getAttribute('class');
// const estilosOriginalesRow = ventanaEmergente.getAttribute('style');

// // Variable para seguir el estado
// let estado = 'oculto';

// // Evento de clic en el botón
// boton.addEventListener('click', function() {
//     if (estado === 'oculto') {
//         // Quitar todas las clases existentes y agregar una nueva
//         ventanaEmergente.setAttribute('style', 'menuEmergente');
//         boton.setAttribute('style', 'regresar');
//         estado = 'mostrado';
//     } else {
//         // Restaurar las clases originales
//         ventanaEmergente.setAttribute('style', estilosOriginalesMenu);
//         boton.setAttribute('style',estilosOriginalesRow);
//         ventanaEmergente.classList.remove('menuEmergente');
//         ventanaEmergente.classList.remove('regresar');
//         estado = 'oculto';
//     }
// });
