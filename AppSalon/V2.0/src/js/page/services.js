/* import { alerts } from "../class/alerts";
import { API } from '../api/services.js';

export class Services
{

    quotes = {
        name:"",
        date:"",
        time:'',
        services:[],
    };
    alert = new alerts();

    OnInit(){
        let api = new API();
        this.showData(api.services())
        this.selectName();
        this.selectDate();
        this.selectTime();
        this.setSessionData();
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
                    ).click(e=>{this.selectService(service)}).show("fast")
                ).show("fast");
            })
        });
    }

    selectService(service)
    {
        const { id } = service;
        const { services } = this.quotes;
        const divService = $(`[data-service="${id}"]`);
        if(services.some( add => add.id===id)){
            this.quotes.services = services.filter(add=>add.id !== id);
            return divService.removeClass("select");
        }else{
            this.quotes.services = [...services,service];
            return divService.addClass("select");
        }
    }

    selectName(){
        return this.quotes.name = $('#name').val();        
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
                this.quotes.date = date.val();
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
                this.quotes.time = time.val();
            }
        }) 
    }

    showSummary(){
        const summary = $(".content-summary");
        summary.empty();
        if(Object.values(this.quotes).includes('') || this.quotes.services.length === 0){
            return this.alert.Toast('error','Hacen falta servicios o datos.')
        }
        const {name, date, time, services} = this.quotes;
        var html = `<span>Nombre: </span><span>${name}</span>`;
        html += `<span>Fecha: </span><span>${date}</span>`;
        html += `<span>Hora: </span><span>${time}</span>`;
        summary.html(html)
        //console.log(html);
    }
} */

import { alerts } from "../class/alerts";
import { API } from '../api/services.js';
import { SessionStorage } from "../class/SessionStorage";

export class Services
{
    alert = new alerts();
    session = new SessionStorage();

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
                    ).click(e=>{this.selectService(service)}).show("fast")
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
        quotes.name = $('#name').val();
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
        const summary = $(".content-summary");
        if(Object.values(quotes).includes('') || quotes.services.length === 0){
            return this.alert.Toast('error','Hacen falta servicios o datos.')
        }
        const {name, date, time, services} = quotes;
        var html = `<span>Nombre: </span><span>${name}</span>`;
        html += `<span>Fecha: </span><span>${date}</span>`;
        html += `<span>Hora: </span><span>${time}</span>`;
        summary.html(html)
        //console.log(html);
    }
}