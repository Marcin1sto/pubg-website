import $ from 'jquery'
export default defineNuxtPlugin( ( nuxtApp ) => {
    nuxtApp.hook( 'app:beforeMount', () => {
        window.jQuery = window.$ = $
        console.log($)
    } )
} )