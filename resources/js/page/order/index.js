import {handleStatusChange} from "../../modules/tableHandler.js";

document.addEventListener('DOMContentLoaded', function () {
    const statusSelects = document.querySelectorAll('#update-status');
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    const flash = document.querySelector('#flash-message')

    //обработка события изменения статуса
    statusSelects.forEach(select => {
        select.addEventListener('change', function () {
            const orderId = this.dataset.orderId;
            const newStatus = this.value;
           handleStatusChange(orderId, newStatus, token, flash);
        });
    });

})
