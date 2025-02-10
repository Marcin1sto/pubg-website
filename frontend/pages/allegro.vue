<script setup lang="ts">
import useAllegroStore from "~/stores/useAllegroStore";

const {receiveToken} = useAllegroStore();
const {allegroError} = storeToRefs(useAllegroStore());
definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
const route = useRoute();
let code = route.query.code;
console.log(code);
if (code) {
  receiveToken(code);
}
</script>

<template>
  <div v-if="allegroError">
    <div class="container cta">
      <div class="row row--centered">
        Niestety, coś poszło nie tak. Spróbuj ponownie.
        <br/>
        <div class="row row--centered" style="font-size: small; color: grey">
          {{ allegroError }}
        </div>

        <div class="row row--centered">
          <nuxt-link-locale to="panel-automations-allegro" class="cta_button">Skonfiguruj wtyczkę Allegro
          </nuxt-link-locale>
        </div>
      </div>

    </div>

  </div>
  <div v-else>
    <div class="container cta">
      <div class="row row--centered">
        Przekierowywanie...

      </div>
    </div>
  </div>
</template>
