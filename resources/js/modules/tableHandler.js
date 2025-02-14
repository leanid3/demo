
import {showFlashMessage} from "./flash.js";
/**
 * изменение статуса заявок
 * @param orderId id заказа
 * @param newStatus статус заказа
 * @param token csrf токен
 * @param flash блок уведомлений
 */
export function handleStatusChange(orderId, newStatus, token, flash) {
    fetch(`/admin/orders/${orderId}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
            status: newStatus
        })
    })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            showFlashMessage(data.message, data.success, flash); // Показываем сообщение
        })
        .catch(error => {
            console.error('Ошибка:', error);
            showFlashMessage('Произошла ошибка: ' + (error.message || 'Неизвестная ошибка'), false, flash); // Показываем ошибку
        });
}


