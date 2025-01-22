import { SessionStorage } from "../class/SessionStorage";
import { Services } from "./services";

export class tab
{
    session = new SessionStorage();
    step = 1;
    OnInit(){
        this.Paginator();
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
            this.Paginator();
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

    Paginator()
    {
        if(!$("#reservation").hasClass('hidden'))
            $("#reservation").addClass('hidden');
        const previousPage = $('#before');
        const nextPage = $('#after');
        switch(this.step)
        {
            case 1:
                previousPage.addClass('hidden');
                nextPage.removeClass('hidden');
                break;
            case 2:
                previousPage.removeClass('hidden');
                nextPage.removeClass('hidden');
                break;
            case 3:
                previousPage.removeClass('hidden');
                nextPage.addClass('hidden');
                let services = new Services();
                services.showSummary(this.session.getArray('quotes'));
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
            this.Paginator();
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
            this.Paginator();
            this.ShowSection();
        })
    }
}