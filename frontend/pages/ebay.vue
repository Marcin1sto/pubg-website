<script setup lang="ts">
import useEbayStore from "~/stores/useEbayStore";

const {receiveToken} = useEbayStore();
const {ebayError} = storeToRefs(useEbayStore());
definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
const route = useRoute();
let code = route.query.code;

if (code) {
  receiveToken(code);
}
</script>

<template>
  <div v-if="ebayError">
    <div class="container cta">
      <div class="row row--centered">
        Niestety, coś poszło nie tak. Spróbuj ponownie.
        <br/>
        <div class="row row--centered" style="font-size: small; color: grey">
          {{ ebayError }}
          <br/>
          Code: {{ code }}
        </div>

        <div class="row row--centered">
          <nuxt-link-locale to="panel-automations-ebay" class="cta_button">Skonfiguruj wtyczkę Ebay
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
