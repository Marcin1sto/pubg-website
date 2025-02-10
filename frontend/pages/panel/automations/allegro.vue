<script setup lang="ts">

import useAllegroStore from "~/stores/useAllegroStore";

const {getProfile, unlinkAccount} = useAllegroStore();
const {allegroProfile, allegroOauthRedirect} = storeToRefs(useAllegroStore());
await getProfile();

let unlinkAllegroAccount = async () => {
  if(confirm('Czy na pewno chcesz usunąć powiązanie konta?')){
    await unlinkAccount();
  } else {
    return false;
  }
}

let linkAllegroProfile = async () => {
  console.log(allegroOauthRedirect);
  window.location.href = allegroOauthRedirect.value.oauth_url;
}

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})

</script>

<template>
  <div class="plugins_container">
    <div class="plugins_containerItems">
      <div class="plugins_containerItem plugins_containerItem--big plugins_containerItem--details" style="font-size: 14px">
        <span class="plugins_containerContent" style="margin-right: 20px">
          <img src="/icons/allegro.png" alt="Allegro" width="150px" style="margin-bottom: 8px"/>
          Allegro
        </span>

        <div v-if="allegroProfile.profile">
          <h3>Profil allegro jest skonfigurowany</h3>

          <span style="color:grey">
            Login: {{ allegroProfile.profile.AllegroProfile.login }}<br/>
            Imię i nazwisko: {{
              allegroProfile.profile.AllegroProfile.first_name
            }} {{ allegroProfile.profile.AllegroProfile.last_name }}<br/>
          </span>
          <nuxt-link-locale to="panel-sales" class="link">
            Przejdź do sprzedaży
          </nuxt-link-locale>
          <br/><br/><br/>
          <button @click="unlinkAllegroAccount()"
                  class="btn btn-block cta_button"
                  style="background: #1f7ae0; border: #1f7ae0;">Usuń powiązanie konta
          </button>
        </div>
        <div v-else>
          Konto nie jest powiązane<br/>
          <button @click="linkAllegroProfile()" class="btn btn-block btn-primary py-2 text-center rounded cta_button"
                  style="background: #1f7ae0; border: #1f7ae0;">Powiąż konto Allegro
          </button>
        </div>
      </div>
    </div>

    <div class="plugins_infoContainer">
      <div class="row">
        <h1 class="plugins_infoTitle">Opis powiązania z Allegro</h1>
      </div>
      <div class="row">
        <p class="plugins_infoTxt">1. Aby skorzystać z importu sprzedaży musisz powiązać swoje konto Allegro z BLPaczką. W tym celu kliknij button “Powiąż konto Allegro”.</p>
      </div>
      <div class="row row--centered">
        <NuxtImg src="images/plugins/allegro/allegro-step-1.png" class="plugins_infoImg"/>
      </div>
      <div class="row">
        <p class="plugins_infoTxt">2. Zaloguj się do serwisu Allegro używając swojego Loginu i Hasła.</p>
      </div>
      <div class="row row--centered">
        <NuxtImg src="images/plugins/allegro/allegro-step-2.png" class="plugins_infoImg"/>
      </div>
      <div class="row">
        <p class="plugins_infoTxt">3. Autoryzuj przekazywanie danych z Allegro do BLPaczki</p>
      </div>
      <div class="row row--centered">
        <NuxtImg src="images/plugins/allegro/allegro-step-3.png" class="plugins_infoImg"/>
      </div>
      <div class="row row--centered">
        <NuxtImg src="images/plugins/allegro/allegro-step-4.png" class="plugins_infoImg"/>
      </div>
      <div class="row">
        <p class="plugins_infoTxt">4. Import sprzedanych przedmiotów odbywa się automatycznie po powiązaniu konta z Allegro. Wszystkie zaimportowane aukcje znajdziesz tutaj <NuxtLink to="https://blpaczka.com/panel/sales" class="plugins_infoLink">https://blpaczka.com/panel/sales</NuxtLink></p>
      </div>
      <div class="row">
        <p class="plugins_infoTxt">5. Aby wygenerować etykietę dla wybranej aukcji wybierz opcje NADAJ. Następnie uzupełnij formularz i zatwierdź zamówienie.</p>
      </div>
    </div>
  </div>
</template>
