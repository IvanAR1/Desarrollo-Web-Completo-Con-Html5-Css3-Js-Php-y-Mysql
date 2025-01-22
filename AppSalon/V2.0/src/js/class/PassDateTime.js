export class PassDateTime{
    static toLocaleDate(date, format, options = {}){
        const day = new Date(date).getDate() + 2;
        const month = new Date(date).getMonth();
        const year = new Date(date).getFullYear();
        return new Date(Date.UTC(year, month, day)).toLocaleDateString(format, options);
    }

    static toLocalTime(time){
        let [hour, minute] = time.split(':').map(Number);
        const period = hour >= 12 ? 'pm' : 'am';
        hour = hour % 12 || 12;
        return `${hour}:${minute.toString().padStart("2", 0)} ${period}`;
    }
    
}