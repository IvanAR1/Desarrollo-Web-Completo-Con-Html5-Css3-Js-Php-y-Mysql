import { SessionStorage } from "../class/SessionStorage";
import { Services } from "./services";

export class tab
{
    session = new SessionStorage();
    step = 1;
    OnInit(){
        this.paginator();
        this.ShowSection();
        this.previousPage();
        this.nextPage();
        this.Tabs();
    }

    Tabs()
    {
        return $('.btn-tab').on("click", (e) => {
            e.preventDefault();
            let step = parseInt(e.target.dataset.step);
            this.step = step;
            this.ShowSection(step);
            this.paginator();
            if(step === 3){
                let services = new Services();
                services.showSummary(this.session.getArray('quotes'));
            };
        })
    }

    ShowSection()
    {
        let select = this.step;
        $('.show').removeClass('show');
        $(`.btn-tab`).removeClass('actual');
        $(`[data-step="${select}"]`).addClass('actual');
        $(`#step-${select}`).addClass('show');
    }

    paginator()
    {
        const previousPage = $('#before');
        const nextPage = $('#after');
        switch(this.step)
        {
            case 1:
                previousPage.addClass('hide');
                nextPage.removeClass('hide');
                break;
            case 2:
                previousPage.removeClass('hide');
                nextPage.removeClass('hide');
                break;
            case 3:
                previousPage.removeClass('hide');
                nextPage.addClass('hide');
                break;
        }        
    }

    previousPage()
    {
        const previousPage = $('#before');
        previousPage.on('click',()=>
        {
            if(this.step<=1)return;
            this.step--;
            this.paginator();
            this.ShowSection();
        })
    }

    nextPage()
    {
        const nextPage = $('#after');
        nextPage.on('click',()=>
        {
            if(this.step>=3)return;
            this.step++;
            this.paginator();
            this.ShowSection();
        })
    }
}