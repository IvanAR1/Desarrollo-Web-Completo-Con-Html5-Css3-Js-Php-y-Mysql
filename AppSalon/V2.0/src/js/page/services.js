import { alerts } from "../class/alerts";
import { API } from '../api/services.js';
import { SessionStorage } from "../class/SessionStorage";
import { PassDateTime } from "../class/PassDateTime.js";
import { HttpClient as http} from "../class/HttpClient";

export class Services
{
    alert = new alerts();
    session = new SessionStorage();
    http = new http();

    OnInit(){
        let api = new API();
        if(window.location.pathname === "/index")
        {
            this.session.saveArray('quotes',{
                name:"",
                date:"",
                time:'',
                services:[],
            })
        }else{
            sessionStorage.clear()
        }
        this.showData(api.services())
        this.selectName();
        this.selectDate();
        this.selectTime();
        $("#reservation").on("click",()=>{
            this.reservation();
        });
    }

    showData(services)
    {
        services.then(Services=>{
            Services.forEach(service=>{
                const {id, services_name, services_price} = service;
                $('#quotes').append(
                    $(`<div class="service" data-service="${id}">`).append(
                        $('<p class="service-name">').text(services_name),
                        $('<p class="service-price">').text("$"+services_price),
                    ).on('click',e=>{this.selectService(service)}).show("fast")
                ).show("fast");
            })
        });
    }

    selectService(service)
    {
        const { id } = service;
        let quotes = this.session.getArray('quotes');
        const services = quotes.services;
        const divService = $(`[data-service="${id}"]`);
        if(services.some( add => add.id===id)){
            services.services = services.filter(add=>add.id !== id);
            divService.removeClass("select");
        }else{
            services.services = [...services,service];
            divService.addClass("select");
        }
        quotes.services=services.services;
        return this.session.saveArray('quotes',quotes);
    }

    selectName(){
        let quotes = this.session.getArray('quotes');
        quotes.name = $('#name').val() || "";
        return this.session.saveArray('quotes',quotes);
    }

    selectDate(){
        let date = $('#date');
        date.on('input',e=>{
            const day = new Date(e.target.value).getUTCDay();
            if([0,6].includes(day))
            {
                e.preventDefault();
                date.val("");
                this.alert.Toast('error','Los sábados y domingos no son válidos');
            }else{
                let quotes = this.session.getArray('quotes');
                quotes.date = date.val();
                return this.session.saveArray('quotes',quotes);
            }
        })
    }

    selectTime(){
        let time = $('#time');
        time.on('input',e=>{
            const hourQuote = e.target.value;
            const hour = hourQuote.split(':');
            if(hour[0] <= 8 || hour[0] == 14 || hour[0] >= 22)
            {
                this.alert.Toast('error','El local no habre antes de las 09:00am, durante las 02:00pm y después de las 09:00pm');    
                setTimeout(() =>
                {
                    time.val("");
                },100);
            }else{
                let quotes = this.session.getArray('quotes');
                quotes.time = time.val();
                return this.session.saveArray('quotes',quotes);
            }
        }) 
    }

    showSummary(quotes){
        const summary = $("#step-3");
        if(Object.values(quotes).includes('') || quotes.services.length === 0){
            html = `<p class="alert error">Hacen falta servicios o datos.</p>`;
            summary.html(html)
            return this.alert.Toast('error','Hacen falta servicios o datos.')
        }
        const {name, date, time, services} = quotes;
        const dateObj = PassDateTime.toLocaleDate(date, 'es-MX', {weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'});
        const timeObj = PassDateTime.toLocalTime(time);
        let html = `
            <div class="services">
                <h3>Resumen de servicios</h3>
                ${services.map(service=>
                    `
                    <div class="service">
                    <p>${service.services_name}</p>
                    <p><span>Precio: </span>$${service.services_price}</p>
                    </div>
                    `
                ).join('')}
            </div>
            <div class="summary">
                <h3>Resumen de cita</h3>
                <p>Nombre: ${name}</p>
                <p>Fecha: ${dateObj}</p>
                <p>Hora: ${timeObj}</p>
            </div>
        `;
        summary.html(html);
        $("#reservation").removeClass("hidden")
        //console.log(html);
    }

    reservation(){
        let quotes = this.session.getArray('quotes');
        this.http.post('/api/reservation',{quotes:quotes}).then(response=>{
            const info = response.data;
            console.log(info);
            if(info.status == 'OK')
            {
                this.alert.swal('correcto','success',info.message, 'OK')
            }
        })
    }
}