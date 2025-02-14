/**
 * сборка уведомления
 * @param message сообщение
 * @param isSuccess фдаг
 * @param flash блок уведомлений
 */
export function showFlashMessage(message, isSuccess, flash) {

    flash.classList.remove('bg-green-400', 'bg-red-400');

    flash.textContent = message;

    flash.classList.add(isSuccess ? 'bg-green-400' : 'bg-red-400');

    flash.classList.remove('opacity-0', 'invisible');
    flash.classList.add('opacity-100', 'visible');

    setTimeout(() => {
        flash.classList.remove('opacity-100', 'visible');
        flash.classList.add('opacity-0', 'invisible');
    }, 5000);
}
