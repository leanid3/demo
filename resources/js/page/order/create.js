import {setupForm} from "../../modules/formHandler.js";

document.addEventListener('DOMContentLoaded', function () {
    // обработка изменения формы
    setupForm('#create-order-form', '#flash-message')
})
