import './bootstrap';

import 'tom-select/dist/css/tom-select.bootstrap5.css';
import TomSelect from 'tom-select';

import Alpine from 'alpinejs';
const modules = import.meta.glob('./components/*.js', { eager: true });

const components = Object.fromEntries(
    Object.entries(modules).map(([path, module]) => {
        const name = path.match(/\/([^/]+)\.js$/)[1].replace(/-([a-z])/g, (_, c) => c.toUpperCase()); // Convertit "image-component" en "imageComponent"
        return [name, module.default || module];
    })
);

window.Alpine = Alpine;
Alpine.start();

document.querySelectorAll('select[multiple]').forEach((element) => {
    let settings = {
        plugins: {
            remove_button: {
                title: 'Supprimer'
            }
        }
    };

    new TomSelect(element, settings);
});