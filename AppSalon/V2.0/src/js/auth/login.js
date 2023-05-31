import { alerts } from "../class/alerts";
import { HttpClient as http} from "../class/HttpClient";

export class Login
{
    constructor(){
        this.Register();
        this.Login();
        this.Forgout();
        this.Rescue();
    }
    alert = new alerts();
    http = new http();
    Register(){
        return $(`#register`).on("submit", (e) => {
            e.preventDefault();
            let register$ = {
                users_name:$('#rname').val(),
                users_lname: $('#rlname').val() + ' ' + $('#rmotherLname').val(),
                users_cellphone:$('#rtel').val(),
                users_email: $('#remail').val(),
                users_password:$('#rpassword').val()
            }
            let rules = 
            {
                users_name:['required', "regex:^([A-Za-zÑñÁáÉéÍíÓóÚú]+['\-]{0,1}[A-Za-zÑñÁáÉéÍíÓóÚú]+)(\s+([A-Za-zÑñÁáÉéÍíÓóÚú]+['\-]{0,1}[A-Za-zÑñÁáÉéÍíÓóÚú]+))*$"],
                users_lname: 'required',
                users_cellphone:"required|min:10|regex:/^[\s()+-]*([0-9][\s()+-]*){6,20}$/",
                users_email: 'required',
                users_password:'required|min:8'
            }
            let validation = new Validator(register$, rules);
            if(validation.passes() != true)
            {
                this.alert.Toast('error','Los datos no son válidos')
            }
            else
            {
                return this.http.post('/api/signup',{register:register$}).done(function(info) {
                    let response = info;
                    if(response.status == 'OK')
                    {
                        return this.alert.swal('correcto','success','Se ha creado el usuario correctamente','¡Ingresa ahora!')
                        .then((result) => {
                            if (result.value || !result)
                            {
                                window.location.href = "/";
                            }
                        });
                    }
                })
            }

        })
    }
    Login(){
        return $(`#login`).on("submit", (e) => {
            e.preventDefault();
            let login$ = {
                users_email: $('#email').val(),
                users_password:$('#password').val()
            }
            let rules = 
            {
                users_email: 'required',
                users_password:'required|min:8'
            }
            let validation = new Validator(login$, rules);
            if(validation.passes() != true)
            {
                this.alert.Toast('error','Los datos no son válidos')
            }else{
                return this.http.post('/api/login',{login:login$}).done((info)=>{
                    if(info.status == 'OK')
                    {
                        this.alert.swal('correcto','success','Haz ingresado correctamente, ' + info.session.user_name ,"¡Vé a la página de inicio!")
                        .then((result) => {
                            if (result.value || !result)
                            {
                                window.location.href = info.redirect;
                            }
                        });
                    }
                });
                
            }
        })
    }
    Forgout(){
        return $(`#forgout`).on("submit", (e) => {
            e.preventDefault();
            let forgout$ = {
                users_email: $('#email').val(),
            }
            let rules = 
            {
                users_email: 'required|email',
            }
            let validation = new Validator(forgout$, rules);
            if(validation.passes() != true)
            {
                this.alert.Toast('error','Los datos no son válidos')
            }else{
                return this.http.post('/api/forgout',{forgout:forgout$}).done((info)=>{
                    if(info.status == 'OK')
                    {
                        this.alert.swal('¡Mensaje enviado!','success',info.message ,"¡Vé a la página de inicio!")
                        .then((result) => {
                            if (result.value || !result)
                            {
                                window.location.href = info.redirect;
                            }
                        });
                    }
                })
            }
        })
    }
    Rescue(){
        return $(`#rescue`).on("submit", (e) => {
            e.preventDefault();
            let rescue$ = {
                users_password:$('#password').val(),
                users_password_confirmation: $('#v-password').val(),
            }
            let rules = 
            {
                users_password:'required|min:8|confirmed',
                users_password_confirmation: 'required',
            }
            let validation = new Validator(rescue$, rules);
            if(validation.passes() != true)
            {
                this.alert.Toast('error','Las contraseñas no coincien o no tienen un formato válido.')
            }else{
                let token = this.http.urlParams('token');
                return this.http.put(`/api/rescue`,{rescue:rescue$, token:token}).done((info)=>{
                    if(info.status == 'OK')
                    {
                        this.alert.swal('¡Contraseña reestablecida!','success',info.message ,"¡Vé a la página de inicio!")
                        .then((result) => {
                            if (result.value || !result)
                            {
                                window.location.href = info.redirect;
                            }
                        });
                    }
                });
                
            }
        })
    }
}