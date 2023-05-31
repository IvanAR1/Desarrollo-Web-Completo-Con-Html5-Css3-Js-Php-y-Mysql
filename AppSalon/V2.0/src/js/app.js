// src/js/main.js
import {Login} from './auth/login.js'
import { tab as Tab } from './page/tab.js';
//import { API } from './api/services.js';
import { Services } from './page/services.js';

$(document).ready(()=>
{
    let login = new Login();
    let tab = new Tab();
    tab.OnInit();
    let services = new Services();
    services.OnInit();
})