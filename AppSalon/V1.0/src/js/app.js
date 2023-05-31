let pagina = 1;
const cita =
{
    Nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

/* const cors = require('cors');
app.use(cors);

var whitelist = ['http://localhost:3000/servicios.php'];

var corsOptions = 
{
    origin: function (origin, callback)
    {
        if (whiteList.indexOf(origin) != -1)
        {
            callback(null, true);
        }
        else
        {
            callback(new Error('Not allowed by CORS'));
        }
    }
}

app.get('/',cors(corsOptions), (req, res) =>
{
    res.json({mensaje: 'ok'});
}) */

document.addEventListener('DOMContentLoaded', function()
{
    iniciarApp();
})

function iniciarApp()
{
    mostrarServicios();

    //Resalta el DIV actual según el tab en el que se presione


    mostrarSeccion();
    //Resalta o muestra una sección según el tab en el que se presione
    cambiarSeccion();

    //Paginacion siguiente y anterior
    paginaSiguiente();

    paginaAnterior();

    /* Comprueba la paginación */
    botonesPaginador();

    /* Mostrar el resumen de la cita (o mensaje de error en el caso de no pasar la validación)*/
    monstrarResumen();

    //almacena el nombre de la cita en el objeto
    NombreCita();

    //Almacena la fecha de la cita en el objeto
    fechaCita();

    //Elemina fechas anteriores
    desabilitarFecha();

    //Almacena la hora de la cita en el objeto
    horaCita();
}

function mostrarSeccion()
{
    //Eleminar mostrar-seccion de la sección anterior
    const seccionAnterior = document.querySelector('.mostrar-seccion');
    if(seccionAnterior)
    {
        seccionAnterior.classList.remove('mostrar-seccion');
    }

    const seccionActual = document.querySelector(`#paso-${pagina}`);
    seccionActual.classList.add('mostrar-seccion');

    //Eleminar la clase de actual en  tab anterior
    const tabAnterior = document.querySelector('.tabs .actual');

    if(tabAnterior)
    {
    tabAnterior.classList.remove('actual')
    }
    /* Mostrar el TAB actual */
    const tab = document.querySelector(`[data-paso="${pagina}"]`);
    tab.classList.add('actual');
}

function cambiarSeccion()
{
    const enlaces = document.querySelectorAll('.tabs button');

    enlaces.forEach(enlace =>
        {
            enlace.addEventListener('click', e =>
            {
                e.preventDefault();
                pagina = parseInt(e.target.dataset.paso);

                //Mostrar la función de mostrarSección
                mostrarSeccion();

                botonesPaginador();
            })
        })
}

async function mostrarServicios()
{
    try 
    {
        const url = 'http://localhost/AppSalon/servicios.php'
        const resultado = await fetch(url);

        const db = await resultado.json();

 /*        console.log(db);
        const {servicios} = db; */
        //Generar HTML
        db.forEach( servicio => {
            const {ID, Nombre, Precio} = servicio;

            //DOM Scripting

            //Generar Nombre
            const NombreServicio = document.createElement('P');
            NombreServicio.textContent = Nombre;
            NombreServicio.classList.add('nombre-servicio');

            //Generar Precio
            const PrecioServicio = document.createElement('P');
            PrecioServicio.textContent = `$${Precio}`;
            PrecioServicio.classList.add('precio-servicio');

            //Generar div contenedor de servicio
            const servicioDiv = document.createElement('DIV');
            servicioDiv.classList.add('servicio');
            servicioDiv.dataset.IDServicio = ID;
            //Seleccione un servicio para la cita
            servicioDiv.onclick = seleccionarServicio;

            //Inyectar Precio y Nombre
            servicioDiv.appendChild(NombreServicio);
            servicioDiv.appendChild(PrecioServicio);
            //Inyectar
            document.querySelector('#servicios').appendChild(servicioDiv);
        })
    }catch (error)
    {
        console.log(error);
    }
}

function seleccionarServicio(e)
{
    let element
    //Forzar que el elemento al cual le damos click sea el DIV
    if(e.target.tagName === 'P')
    {
        element = e.target.parentElement;
    } else
    {
        element = e.target;
    }

    if(element.classList.contains('select'))
    {
        element.classList.remove('select');
        const ID = parseInt(element.dataset.idServicio);
        eleminarServicio(ID);
    }else
    {
        element.classList.add('select');

        const servicioObj = 
        {
            ID: parseInt(element.dataset.IDServicio),
            Nombre: element.firstElementChild.textContent,
            Precio: element.firstElementChild.nextElementSibling.textContent
        }

        //console.log(servicioObj);

        agregarServicio(servicioObj);
    }

    
}

function eleminarServicio (ID)
{
    const {servicios} = cita;
    cita.servicios = servicios.filter(servicio => servicio.ID !== ID);
    console.log(cita);
}

function agregarServicio(servicioObj)
{
    const {servicios} = cita;
    cita.servicios = [...servicios, servicioObj];
    console.log(cita);
}



function paginaSiguiente ()
{
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', () =>
    {
        pagina++;

        botonesPaginador();
        console.log(pagina);
    });

}

function paginaAnterior ()
{
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', () =>
    {
        pagina--;
        botonesPaginador();
        console.log(pagina);
    })
}

function botonesPaginador()
{
    const paginaSiguiente = document.querySelector('#siguiente');
    const paginaAnterior = document.querySelector('#anterior');

    if(pagina === 1)
    {
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }
     else if(pagina === 3)
    {
        paginaSiguiente.classList.add('ocultar');
        paginaAnterior.classList.remove('ocultar');

        monstrarResumen()
    } else
    {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }
    mostrarSeccion();
}

function monstrarResumen()
{
    //Desctructuring
    const {Nombre, fecha, hora, servicios} = cita;

    /* Seleccionar el resumen */
    const resumenDiv = document.querySelector('.contenido-resumen');

    /* Limpia el HTML previo */
    while(resumenDiv.firstChild)
    {
        resumenDiv.removeChild(resumenDiv.firstChild);
    }

    //Validación de objeto
    if (Object.values(cita).includes(''))
    {
        const sinServicios = document.createElement('P');
        sinServicios.textContent = "Faltan datos";

        sinServicios.classList.add('invalidar-cita');

        /* Agregar a resumen DIV */
        resumenDiv.appendChild(sinServicios);

        return;
    }

    const headingCita = document.createElement('H3');
    headingCita.textContent = 'Resumen de Cita';

    //Mostrar el resumen
    const NombreCita = document.createElement('P');
    NombreCita.innerHTML = `<span>Nombre: </span> ${Nombre}`;

    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha: </span> ${fecha}`;

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora:</span> ${hora}`;

    const serviciosCita = document.createElement('DIV');
    serviciosCita.classList.add('resumen-servicio');

    const headingServicios = document.createElement('H3');
    headingServicios.textContent = 'Resumen de Servicios';
    serviciosCita.appendChild(headingServicios);

    let cantidad = 0;

    /* Iterar sobre el arreglo de servicio */
    servicios.forEach( servicio =>
        {
            const {Nombre, Precio} = servicio
            const contenedorSerivicio = document.createElement('DIV');
            contenedorSerivicio.classList.add('contenedor-servicio');

            const textoServicio = document.createElement('P');
            textoServicio.textContent = Nombre;

            const precioServicio = document.createElement('P');
            precioServicio.textContent = Precio;
            precioServicio.classList.add('precio');

            const totalServicio = Precio.split('$')
            /* console.log(parseInt(totalServicio[1].trim())); */
            cantidad += parseInt(totalServicio[1].trim()) 

            

            //Colocar texto y precio en el div
            contenedorSerivicio.appendChild(textoServicio);
            contenedorSerivicio.appendChild(precioServicio);
            serviciosCita.appendChild(contenedorSerivicio);
        });

    resumenDiv.appendChild(headingCita);
    resumenDiv.appendChild(NombreCita);
    resumenDiv.appendChild(fechaCita);
    resumenDiv.appendChild(horaCita);

    resumenDiv.appendChild(serviciosCita);

    const cantidadPagar = document.createElement('P');
    cantidadPagar.classList.add('total');
    cantidadPagar.innerHTML = `<span>Total a pagar: </span> $${cantidad}`;
    resumenDiv.appendChild(cantidadPagar);
}

function NombreCita()
{
    const nombreInput = document.querySelector('#nombre');

    nombreInput.addEventListener('input', e => {
        const nombreTexto = e.target.value.trim();
        //Validación de que cada Nombre debe tener algo
        if(nombreTexto === "" || nombreTexto.length < 3)
        {
            mostrarAlerta('Nombre no válido', 'error');
        }else
        {
            const alerta = document.querySelector('.alerta');
            if(alerta)
            {
                alerta.remove();
            }
           cita.Nombre = nombreTexto;
        }
    })
}

function mostrarAlerta(mensaje, tipo)
{
    //No repetir alerta
    const alertaPrevia = document.querySelector('.alerta')
    if(alertaPrevia)
    {
        return;
    }

    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');

    if(tipo === 'error')
    {
        alerta.classList.add('error');

    }

    const formulario = document.querySelector('.formulario');
    formulario.appendChild (alerta);

    //Eleminar en ciertos segundos
    setTimeout(() =>
    {
        alerta.remove();
    }, 3000)
}

function fechaCita()
{
    const fechaInput = document.querySelector('#fecha');
    fechaInput.addEventListener('input', e => {

        const dia = new Date(e.target.value).getUTCDay();
        if([1].includes(dia))
        {
            e.preventDefault();
            fechaInput.value = '';
            mostrarAlerta('Los lunes no son válidos', 'error');
        }else
        {
            cita.fecha = fechaInput.value;
        }
    })
}

function desabilitarFecha()
{
    const inputFecha = document.querySelector('#fecha');

    const fechaAhora = new Date();
    const year = fechaAhora.getFullYear()
    const mes = fechaAhora.getMonth() + 1;
    const dia = fechaAhora.getDate() + 1;

    

    const fechaDeshabilitar = `${year}-${mes < 10 ? `0${mes}` : mes}-${dia < 10 ? `0${dia}` : dia}`
    

    inputFecha.min = fechaDeshabilitar;

    console.log(mes);
}

function horaCita() {
    // Recuperamos la Hora
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', e=>
    {
     const horaCita = e.target.value;
    const hora = horaCita.split(':');

     if(hora[0] < 9 || hora[0] == 14 || hora[0] > 21)
     {
        mostrarAlerta('Hora no válida', 'error');
        setTimeout(() =>
        {
            inputHora.value = '';
        },3000)
        
     }else
     {
         cita.hora = horaCita;
         console.log(cita);
     }
    }) 

}