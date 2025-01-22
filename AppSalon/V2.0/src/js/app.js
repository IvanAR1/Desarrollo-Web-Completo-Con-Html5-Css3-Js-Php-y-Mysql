// src/js/main.js
import {Login} from './auth/login.js'
import { tab as Tab } from './page/tab.js';
//import { API } from './api/services.js';
import { Services } from './page/services.js';
import { Logout } from './page/logout.js';

document.addEventListener('DOMContentLoaded', () => {
    switch(window.location.pathname)
    {
        case "/": case "/forgout": case "/register": case "/signup":
            new Login();
            break;
        case "/index":
            let tab = new Tab()
            tab.OnInit()
            let services = new Services()
            services.OnInit()
            new Logout()
            break;
    }
});