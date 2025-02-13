import './bootstrap';

import Alpine from 'alpinejs';
import Inputmask from "inputmask/lib/inputmask.js";

window.Alpine = Alpine;
Alpine.start();
document.addEventListener('DOMContentLoaded', function () {
    Inputmask({
        mask: '8(999)-999-99-99',
        placeholder: '_'
    }).mask('#phone')


    document.querySelectorAll('#update-status').forEach(select => {
        try {
            select.addEventListener('change', function () {
                console.log('select')
                updateStatus(this.dataset.orderId, this.value);
            });
        } catch (e) {
            console.error(e)
        }
    });

})

function updateStatus(orderId, status) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/admin/orders/${orderId}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({status})
    })
        .then(response => response.json())
        .then(data => {
        })
        .catch(error => console.error('Ошибка:', error));
}

