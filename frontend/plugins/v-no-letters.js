
export default defineNuxtPlugin((nuxtApp) => {
    nuxtApp.vueApp.directive('no-letters', {
        mounted(el) {
            el.addEventListener('keypress', (event) => {
                if (event.key && !/[0-9]|[\.,-]/.test(event.key)) {
                    event.preventDefault();
                }
            });
        }
    });
});
