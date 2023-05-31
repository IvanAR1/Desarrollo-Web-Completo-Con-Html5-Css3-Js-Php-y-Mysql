export class SessionStorage
{
    saveArray(key,array){
        let jsonString = JSON.stringify(array);
        sessionStorage.setItem(key, jsonString);
    }

    getArray(key){
        const storedJsonString = sessionStorage.getItem(key);
        return JSON.parse(storedJsonString);
    }
}