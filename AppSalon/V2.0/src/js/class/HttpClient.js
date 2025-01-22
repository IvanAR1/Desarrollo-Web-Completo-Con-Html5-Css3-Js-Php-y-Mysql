import axios from "axios";
import { alerts } from "../class/alerts";

export class HttpClient
{
    alert = new alerts();

    urlParams(name)
    {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

    async get(url, data = [])
    {
        return await axios.get(url, {params: data})
        .catch((error) => {
            if(error.response.status === 401)
            {
                if(window.location.pathname !== "/")
                    window.location.href = "/";
            }
            let err = error.response.data;
            return this.alert.html(err);
        });
    }

    async post(url, data)
    {
        try {
            return await axios.post(url, data);
        } catch (error) {
            if(error.response.status === 401)
            {
                if(window.location.pathname !== "/")
                    window.location.href = "/";
            }
            let err = error.response.data;
            return this.alert.html(err);
        }
    }
    async put(url, data)
    {
        return axios.put(url, data)
        .catch((error) => {
            if(error.response.status === 401)
            {
                if(window.location.pathname !== "/")
                    window.location.href = "/";
            }
            let err = error.response.data;
            return this.alert.html(err);
        });
    }

    async delete(url, data)
    {
        return axios.delete(url, data)
        .catch((error) => {
            if(error.response.status === 401)
            {
                if(window.location.pathname !== "/")
                    window.location.href = "/";
            }
            let err = error.response.data;
            return this.alert.html(err);
        });
    }
}