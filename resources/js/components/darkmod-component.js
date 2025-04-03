import Alpine from "alpinejs";

const darkmodComponent = {
    changeMod: async function(element) {
        const btn = element;
        const body = document.querySelector('body');

        if(body.dataset.theme === 'dark')
        {
            body.dataset.theme = 'light';
            element.querySelector('i').classList.replace('fa-moon', 'fa-sun');
        }
        else
        {
            body.dataset.theme = 'dark';
            element.querySelector('i').classList.replace('fa-sun', 'fa-moon');
        }
    }
};

Alpine.data('darkmodHandler', () => ({
    changeMod(event) {
        darkmodComponent.changeMod(event.currentTarget);
    }
}));