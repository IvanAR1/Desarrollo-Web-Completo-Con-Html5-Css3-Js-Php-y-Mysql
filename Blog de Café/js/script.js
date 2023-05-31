//query Selector
const heading = document.querySelector("#heading")  //0 o 1 Elemento
console.log(heading);
heading.textContent = "Blog de café con consejos y cursos";


/* querySelectorAll
const enlaces = document.querySelectorAll(".navegacion a");
console.log(enlaces[0]);

getEmentById
const heading2 = document.getElementById ("heading");
console.log(heading2); //No es utilizado tanto ahora

//Generar un nuevo enlace
const nuevoEnlace = document.createElement("A")
Agregar href
nuevoEnlace.href = "nuevo-enlace.html";

Agregar el texto
nuevoEnlace.textContent = "Un nuevo enlace";

Agregar la clase
nuevoEnlace.classList.add("navegacion__enlace")

//Agregar al documento
const navegacion = document.querySelector(".navegacion");
navegacion.appendChild(nuevoEnlace) */


// Eventos
/* console.log(1);


//Con diferente sintaxis pero con misma función
window.addEventListener("load", function () //load espera a que el JS y los archivos que dependen del HTML estén listos
{
    console.log(2)
})

window.onload = function()
{
    console.log(3)
}

document.addEventListener("DOMContentLoaded", function()
{
    console.log(4);
}); //Solamente espera a que se descargue el HTML

console.log(5)

window.onscroll = function()
{
    console.log("scrolling...")
} */

//Seleccionar elementos y asociarles un evento
/* const btnEnviar = document.querySelector(".boton--primario");
btnEnviar.addEventListener("click", function(evento)
{
    console.log(evento);
    evento.preventDefault(); // Previene el evento por default, así que este es rerquerido en los formularios


    //Validar un formulario

    console.log("enviando formulario");
}) */

// Eventos de los Input y TextArea

const datos = 
{
    nombre: "",
    email: "",
    mensaje: "",
}

const nombre = document.querySelector("#nombre");
const email = document.querySelector("#email");
const mensaje = document.querySelector("#mensaje");
const formulario = document.querySelector(".formulario")

nombre.addEventListener("input", leerTexto);
email.addEventListener("input", leerTexto)
mensaje.addEventListener("input", leerTexto);

//El evento submit
formulario.addEventListener("submit", function(evento)
{
    evento.preventDefault();

    //Validar el formulario
    const {nombre, email, mensaje} = datos;
    if(nombre === "" || email === "" || mensaje === "")
    {
        mostrarAlerta("Se deben de llenar todos los campos", true)
        return; //Corta la ejecución
    }
    //Crear la alerta de Enviar correctamente
    mostrarAlerta("Mensaje Enviado Correctamente");


    //Enviar el formulario
    console.log("Enviando")
})

function leerTexto(e)
{
    datos[e.target.id] = e.target.value;

    console.log(datos);
}

//Muestra un error en pantalla
function mostrarAlerta(mensaje, error = null)
{
    const alerta = document.createElement("P")
    alerta.textContent = mensaje;

    if(error)
    {
        alerta.classList.add("error")

    }
    else
    {
        alerta.classList.add("correcto")
    }
    formulario.appendChild(alerta);
    setTimeout(() => 
    {
        alerta.remove();
    }, 5000);
}