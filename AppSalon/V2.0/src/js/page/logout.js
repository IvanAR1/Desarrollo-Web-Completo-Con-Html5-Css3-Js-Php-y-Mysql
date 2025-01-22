import { alerts } from "../class/alerts";
import { API } from '../api/services.js';
import { SessionStorage } from "../class/SessionStorage";
import { PassDateTime } from "../class/PassDateTime.js";
import { HttpClient as http} from "../class/HttpClient";

export class Logout
{
    http = new http();
    alert = new alerts();

    constructor(){
        this.logout();
    }

    logout(){
        $("#btn-logout").on("click",()=>{
            this.http.post('/api/logout').then((response)=>{
                if(response.data.status == 'OK')
                {
                    this.alert.Toast('success','Se ha cerrado la sesión')
                    .then(()=>{
                        window.location.href = "/";
                    });
                }
            })
        })
    }
}