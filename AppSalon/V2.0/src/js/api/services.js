import { HttpClient as Http} from "../class/HttpClient";

export class API
{
    http = new Http();

    async services()
    {
        let data = await this.http.get('/api/services');
        return Promise.resolve(data.message);
    }
}