import {showFlashMessage} from "./flash.js";

export function initCarCrud() {
    // Удаление автомобиля
    window.deleteCar = function(id) {
        if (confirm('Вы уверены?')) {
            fetch(`/admin/cars/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.querySelector(`[data-car-id="${id}"]`).remove();
                        showFlashMessage(data.message, true, document.querySelector('#flash-message'));
                    }
                });
        }
    }

    // Обработка форм
    document.querySelectorAll('.car-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const url = this.action;
            const method = this.dataset.method || 'POST';

            fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        // Обновление карточки при редактировании
                        const card = document.querySelector(`[data-car-id="${data.car.id}"]`);
                        if (card) {
                            card.outerHTML = data.html;
                        }
                        showFlashMessage(data.message, true, document.querySelector('#flash-message'));
                    }
                });
        });
    });
}
