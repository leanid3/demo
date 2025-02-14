import './bootstrap';

import Alpine from 'alpinejs';
import Inputmask from "inputmask/lib/inputmask.js";
import {initCarCrud} from "./modules/carCrud.js";

window.Alpine = Alpine;
Alpine.start();
document.addEventListener('DOMContentLoaded', function () {
    //маска телефона
    Inputmask({
        mask: '8(999)-999-99-99',
        placeholder: '_'
    }).mask('#phone')
    document.addEventListener('DOMContentLoaded', function() {
        initCarCrud();
    });
})

