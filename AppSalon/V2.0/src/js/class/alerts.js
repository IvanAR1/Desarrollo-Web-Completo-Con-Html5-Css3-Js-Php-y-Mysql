export class alerts
{
    constructor(){}
    swal(title, icon, text, textButton)
    {
        return Swal.fire({
            title: title,
            icon: icon,
            text: text,
            confirmButtonText:textButton,
            allowOutsideClick:false
          })
    }

    Toast(icon, title)
    {
        let toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })
        return toast.fire({
            icon:icon,
            title:title
        })
    }

    html(data)
    {
        $('#alerts').empty();
        $.each(data.errors, function(index, value)
        {
            $('#alerts').append(
                $('<p class="alert error">').text(value)
            ).show("fast");
        });
        $('#alerts').delay(3000).hide(3000);
    }
}