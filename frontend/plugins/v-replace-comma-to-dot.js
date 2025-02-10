export default defineNuxtPlugin((nuxtApp) => {
    nuxtApp.vueApp.directive('replace-comma-to-dot', {
        mounted(el) {
            el.addEventListener('input', (event) => {
                let value = event.target.value;

                // Sprawdzanie i zamiana przecinków na kropki
                if (value.includes(',')) {
                    value = value.replace(/,/g, '.');
                    event.target.value = value;

                    // Wywołanie zdarzenia input, aby zaktualizować model Vue
                    const inputEvent = new Event('input', { bubbles: true });
                    el.dispatchEvent(inputEvent);
                }
            });
        }
    });
});
