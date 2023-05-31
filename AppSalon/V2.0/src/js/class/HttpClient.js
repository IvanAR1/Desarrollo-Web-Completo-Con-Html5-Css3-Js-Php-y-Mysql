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

    get(url, data = [])
    {
        return $.ajax({
            url: url,
            type: 'GET',
            data: data,
        }).fail((jqXHR, textStatus, errorThrown) =>
        {
            let error = JSON.parse(jqXHR.responseText);
            return this.alert.html(error);
        });
    }
    post(url, data)
    {
        return $.ajax({
            url: url,
            type: 'POST',
            data: data,
        }).fail((jqXHR, textStatus, errorThrown) =>
        {
            let error = JSON.parse(jqXHR.responseText);
            return this.alert.html(error);
        });
    }
    put(url, data)
    {
        return $.ajax({
            url: url,
            type: 'PUT',
            data: data,
        }).fail((jqXHR, textStatus, errorThrown) =>
        {
            let error = JSON.parse(jqXHR.responseText);
            return this.alert.html(error);
        });
    }
}