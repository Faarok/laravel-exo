import './bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import 'tom-select/dist/css/tom-select.bootstrap5.css';
import TomSelect from 'tom-select';
import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()

const selectInputMultiple = document.querySelector('select[multiple]');

if(selectInputMultiple)
{
    new TomSelect(selectInputMultiple, {
        plugins: {
            remove_button: {
                title: 'Supprimer'
            }
        }
    });
}