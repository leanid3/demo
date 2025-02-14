import {showFlashMessage} from "./flash.js";

/**
 * форма создания заявки
 * @param formSelector
 * @param flashMessageSelector
 */
export function setupForm(formSelector, flashMessageSelector) {
    const form = document.querySelector(formSelector);
    const flashMessage = document.querySelector(flashMessageSelector);
    if (!form || !flashMessage) return;

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(form);
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        throw err;
                    });
                }
                return response.json();
            })
            .then(data => {
                document.querySelectorAll('[id$="_error"]').forEach(el => {
                    el.textContent = '';
                    el.classList.add('hidden');
                });

                showFlashMessage(data.message || 'Успешно!', true, flashMessage);

                form.reset();
            })
            .catch(error => {
                if (error.errors) {
                    for (const [key, messages] of Object.entries(error.errors)) {
                        const errorElement = document.getElementById(`${key}_error`);
                        if (errorElement) {
                            errorElement.textContent = messages.join(' ');
                            errorElement.classList.remove('hidden');
                        }
                    }
                } else {
                    showFlashMessage(error.message || 'Произошла ошибка.', false, flashMessage);
                }
            });
    });
}

