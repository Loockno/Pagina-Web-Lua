fetch("navegacion.php")
    .then((response) => response.text())
    .then((text) => {
        const header = document.querySelector("header");
        if (header) {
            header.innerHTML = text;
        } else {
            const body = document.querySelector("body");
            body.insertAdjacentHTML("afterbegin", text);
        }
        // Llamar a la función para cambiar las imágenes después de agregar la navegación
        cambiarImagenNavegacion();
    })
    .catch((error) => console.error(error));

fetch('footer.html')
    .then(response => response.text())
    .then(text => {
        const footer = document.querySelector('footer');
        if (footer) {
            footer.innerHTML = text;
        } else {
            const body = document.querySelector('body');
            body.insertAdjacentHTML('afterbegin', text);
        }
    })
    .catch(error => console.error(error));

function cambiarImagenNavegacion() {
    // Obtener el nombre de la página actual
    var currentPage = window.location.pathname.split("/").pop();
    // Obtener las referencias a las imágenes de la barra de navegación
    var imgInicio = document.getElementById("img-inicio");
    var imgProductos = document.getElementById("img-productos");
    var imgNosotros = document.getElementById("img-nosotros");
    var imgRecetas = document.getElementById("img-recetas");

    // Cambiar las imágenes según la página actual
    if (currentPage === "index.php") {
        imgInicio.src = "img/INICIO2.svg";
        imgProductos.src = "img/PRODUCTOS.svg";
        imgNosotros.src = "img/NOSOTROS.svg";
        imgRecetas.src = "img/RECETAS.svg";

    } else if (currentPage === "productos.php") {
        imgInicio.src = "img/INICIO.svg";
        imgProductos.src = "img/PRODUCTOS2.svg";
        imgNosotros.src = "img/NOSOTROS.svg";
        imgRecetas.src = "img/RECETAS.svg";
    } else if (currentPage === "nosotros.html") {
        imgInicio.src = "img/INICIO.svg";
        imgProductos.src = "img/PRODUCTOS.svg";
        imgNosotros.src = "img/NOSOTROS2.svg";
        imgRecetas.src = "img/RECETAS.svg";
    } else if (currentPage === "recetas.php") {
        imgInicio.src = "img/INICIO.svg";
        imgProductos.src = "img/PRODUCTOS.svg";
        imgNosotros.src = "img/NOSOTROS.svg";
        imgRecetas.src = "img/RECETAS2.svg";
    }
}
    function loadChatButton() {
        fetch('chat.html') 
            .then(response => response.text())
            .then(html => {
                document.getElementById('chat-contenedor').innerHTML = html;
            })
            .catch(error => {
            });
    }

    window.addEventListener('load', loadChatButton);
