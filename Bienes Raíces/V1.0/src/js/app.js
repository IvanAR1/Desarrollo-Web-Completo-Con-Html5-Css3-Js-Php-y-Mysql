document.addEventListener('DOMContentLoaded', function()
{
    eventListeners();

    darkMode();

    navegacionResponsive();

    borraMensaje();

    validateForm();
});

function darkMode()
{
    /* Código funcional profesor sin localStorage */
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

     if(prefiereDarkMode.matches)
     {
         document.body.classList.add('dark-mode');
     }else
     {
        document.body.classList.remove('dark-mode');
     }

     /* 
     Hacer que el darkMode se almacene en localstorage al momento que el usuario entre y prefiera darkmode en la página interna


     let darkMode = localStorage.getItem('darkMode');
     const darkModeToggle = document.querySelector('.dark-mode-boton');

     const enable = () => {
         document.body.classList.add('dark-mode');
         localStorage.setItem('darkMode', 'enabled');
     }

     const disable = () => {
         document.body.classList.remove('dark-mode');
         localStorage.setItem('darkMode', null);
     }

     if(darkMode === "enabled")
     {
         enable();
     }

     darkModeToggle.addEventListener('click', function()
     {  darkMode = localStorage.getItem('darkMode');
        if(darkMode !== 'enabled')
            {
                enable();
            }else
            {
                disable();
            }
     }) */

     const botonDarkMode = document.querySelector('.dark-mode-boton');
     botonDarkMode.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
     })
     

     
    
}


function borraMensaje()
{
    const mensajeConfirm = document.querySelector('.correcto');
    if(mensajeConfirm !== null)
    {
         setTimeout(function()
         {
             const padre = mensajeConfirm.parentElement;
             padre.removeChild(mensajeConfirm);
         }, 3500);
    }
    const mensajeError = document.querySelector('.error');
    if(mensajeError !== null)
    {
         setTimeout(function()
         {
             const padre = mensajeError.parentElement;
             padre.removeChild(mensajeError);
         }, 3500);
    }
}

function validateForm(e)
{
    e.preventDefault();
    var form = e.target.form;
            Swal.fire({
                title: 'Eliminar',
                text: "¿Está seguro que lo desea eliminar?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'No',
              }).then((result) => {
                if (result.value) {
                    form.submit();
                }
     })
}

function eventListeners()
{
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
    
}

function navegacionResponsive()
{
    const navegacion = document.querySelector('.navegacion');
    
    
        navegacion.classList.toggle('mostrar');
}