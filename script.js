// Contenido de script.js
const DEBUG = false;
const TELEFONO_CONTACTO = '573015228008'; // Tu número de teléfono
document.addEventListener('DOMContentLoaded', function () {
    async function buscarFabricante(event) {
        event.preventDefault(); // Evita el comportamiento predeterminado del formulario
        const macPrefix = document.getElementById('macPrefix').value.trim(); // Remueve espacios en blanco
        if (DEBUG) {
            console.log("Buscando fabricante para el prefijo MAC:", macPrefix);
        }

        // Mapeo de fabricantes a operadores
        const operadores = {
            "Hefei": "Claro Dura",
            "MitraStar": "Movistar",
            "Vantiva": "Claro o Tigo",
            "Askey Computer": "Movistar",
            "Arris": "Tigo Clon o Claro Dura",
            "Sagemcom": "Claro Dura",
            "Hitron": "Claro o Tigo",
            "COMMSCOPE": "Claro o Tigo",
            "CASTLENET": "Claro Dura",

            // Agrega más fabricantes y operadores aquí
        };

        try {
            const response = await fetch(`https://acilwifi.com.co/mac-lookup.php?macPrefix=${macPrefix}`, {
                method: 'GET',
                cache: 'no-cache' // Desactiva el uso de caché
            });

            if (!response.ok) {
                if (response.status === 500) {
                    console.error("Error del servidor (500): El fabricante no está registrado o hay un problema en el servidor.");
                    document.getElementById('resultado').textContent = 'El fabricante no está registrado o hubo un problema con el servidor.';
                    return;
                }
                throw new Error('Error al conectar con la API');
            }

           const data = await response.json(); // Correctamente nombrada como "data"
              if (DEBUG) {
                  console.log('Datos de la API:', data);
              }

            if (data && data.data) {
                const fabricante = data.data.organization_name || 'No encontrado';

                // Buscar operador asociado al fabricante
                const operador = Object.keys(operadores).find(key => fabricante.toLowerCase().includes(key.toLowerCase())) 
                    ? operadores[Object.keys(operadores).find(key => fabricante.toLowerCase().includes(key.toLowerCase()))]
                    : 'Operador desconocido';

                document.getElementById('resultado').textContent = `Fabricante: ${fabricante} - Operador: ${operador}`;
            } else {
                document.getElementById('resultado').textContent = 'Fabricante no encontrado';
            }
        } catch (error) {
            console.error('Error en la solicitud:', error);
            alert('Hubo un problema al realizar la solicitud.');
        }
    }

    // Agregar el evento al formulario después de que el DOM esté completamente cargado
    const formulario = document.getElementById('formulario');
    if (formulario) {
        formulario.addEventListener('submit', buscarFabricante);
    }
});






function enviarMensaje(mensaje) {
    const url = `https://wa.me/${TELEFONO_CONTACTO}?text=${encodeURIComponent(mensaje)}`;
    window.open(url, '_blank');
}

function comprarProducto(nombreProducto) {
    const mensaje = `¡Hola! Estoy interesado en comprar el producto "${nombreProducto}". ¿Puedes proporcionarme más detalles?`;
     const url = `https://wa.me/${TELEFONO_CONTACTO}?text=${encodeURIComponent(mensaje)}`;
    window.open(url, '_blank');
}

function toggleDescription(btn) {
    const productContainer = btn.closest('.Product-1');
    const description = productContainer.querySelector('.description');
    
    if (description.style.display === 'none' || description.style.display === '') {
        description.style.display = 'block';
        btn.innerText = 'Ocultar Descripción';
    } else {
        description.style.display = 'none';
        btn.innerText = 'Ver Descripción';
    }
}

function enviarWhatsApp(event) {
    event.preventDefault();
    const mensaje = document.querySelector('[name="tel"]').value;
    const url = `https://wa.me/${TELEFONO_CONTACTO}?text=${encodeURIComponent(mensaje)}`;
    window.open(url, '_blank');
}


