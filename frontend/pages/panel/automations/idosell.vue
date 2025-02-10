<script setup lang="ts">

import {ref} from "vue";
import useIdoSellStore from "~/stores/useIdoSellStore";

const showInfoModal = ref(false);
const showInfoModalType = ref('');

const contentTypes = {
  api_configuration: {
    title: 'Konfiguracja IdoSell',
    content: 'Jeśli masz dodatkowe pytania dotyczące konfiguracji skontaktuj się z nami pod adresem - tools@blpaczka.com'
  },
}

const {getProfile, unlinkAccount, saveKey} = useIdoSellStore();
const {keyDomain, key, domain} = storeToRefs(useIdoSellStore());
await getProfile();

let unlinkIdosellAccount = async () => {
  if (confirm('Czy na pewno chcesz usunąć powiązanie konta?')) {
    await unlinkAccount();
  } else {
    return false;
  }
}

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})

</script>

<template>
  <div class="plugins_container">

      <div>
        <div class="plugins_containerItem plugins_containerItem--big" style="font-size: 14px; width: 940px">
          <span class="plugins_containerContent" style="margin-right: 20px">
            <img src="/icons/idosell.png" alt="Idosell" width="150px" style="margin-bottom: 8px"/>
            IdoSell
          </span>

          <div v-if="keyDomain">
            <h3>Profil IdoSell jest skonfigurowany</h3>

            <span style="color:grey">
              Klucz: ***********************************<br/>
              Domena: {{ keyDomain.IdoSellKey.domain }}
            </span>
            <br/><br/>
            <nuxt-link-locale to="panel-sales" class="link">
              Przejdź do sprzedaży
            </nuxt-link-locale>
            <br/><br/>
            <button @click="unlinkAccount()"
                    class="btn btn-block cta_button"
                    style="background: #1f7ae0; border: #1f7ae0;">Usuń powiązanie konta
            </button>
          </div>
          <div v-else>

            <div class="form_filters">
              Konto nie jest powiązane z IdoSell
              <div class="filters_container">
                <div class="filters_row">
                  <span class="filters_searchInputContainer">
                    <input type="text" placeholder="Domena sklepu" class="filters_searchInput" :value="domain"
                           @change="domain = $event.target.value">
                    <button><NuxtImg src="icons/orderDetails/arrowLeft.png" width="21px" height="21px"
                                     class="filters_searchButton"/></button>
                  </span>
                </div>
                <div class="filters_row">
                  <span class="filters_searchInputContainer">
                    <input type="text" placeholder="Klucz API" class="filters_searchInput" :value="key"
                           @change="key = $event.target.value">
                    <button><NuxtImg src="icons/orderDetails/arrowLeft.png" width="21px" height="21px"
                                     class="filters_searchButton"/></button>
                  </span>
                </div>
              </div>
              <div class="filters_contentButtonsContainer">
                <button class="filters_buttonPrimary" @click="saveKey">Zapisz</button>
              </div>
            </div>
          </div>
        </div>

    </div>

    <div class="plugins_infoContainer">
      <div class="row">
        <h1 class="plugins_infoTitle">Opis powiązania z IdoSell</h1>
      </div>
      <div class="row">
        <p class="plugins_infoTxt">1. Aby skorzystać z importu sprzedaży musisz powiązać swoje konto IdoSell z BLPaczką.
          W tym celu zaloguj się do swojego panelu sklepu pod przykładowym adresem:
          https://clientXXX.idosell.com/panel.</p>
      </div>
      <div class="row">
        <p class="plugins_infoTxt">2. Przejdź do zakładki "Administracja" [1] -> "Klucze dostępowe do Admin Api" [2] -> Kliknij "+ Dodaj nowy klucz" [3].</p>
      </div>
      <div class="row row--centered">
        <NuxtImg src="images/plugins/idosell/idosell-step-1.png" class="plugins_infoImg"/>
      </div>
      <div class="row">
        <p class="plugins_infoTxt">2. W zakładce "Dodawanie nowego klucza" wybierz "Klucz Api" [1]. Następnie opcjonalnie uzupełnij "Nazwę aplikacji", i "Email w razie potrzeby kontaktu" [2].
        <br/>
          Na dole strony znajdź radio button do zarządzania "OMS" i włącz "Odczyt i zapis" [3]. Kliknij "Dodaj" [4].
        </p>
      </div>
      <div class="row row--centered">
        <NuxtImg src="images/plugins/idosell/idosell-step-2.png" class="plugins_infoImg"/>
      </div>
      <div class="row">
        <p class="plugins_infoTxt">3. Kliknij "Pokaż aktywne klucze"</p>
      </div>
      <div class="row row--centered">
        <NuxtImg src="images/plugins/idosell/idosell-step-3.png" class="plugins_infoImg"/>
      </div>
      <div class="row">
        <p class="plugins_infoTxt">4. Wyświetlony klucz API skopiuj powyżej wraz z domeną w postaci "clientXXX.idosell.com"</p>
      </div>
      <div class="row row--centered">
        <NuxtImg src="images/plugins/idosell/idosell-step-4.png" class="plugins_infoImg"/>
      </div>
      <div class="row">
        <p class="plugins_infoTxt">5. Import sprzedanych przedmiotów odbywa się automatycznie po powiązaniu konta z
          Idosell. Wszystkie zaimportowaną sprzedaż znajdziesz tutaj
          <NuxtLink to="https://blpaczka.com/panel/sales" class="plugins_infoLink">https://blpaczka.com/panel/sales
          </NuxtLink>
        </p>
      </div>
      <div class="row">
        <p class="plugins_infoTxt">6. Aby wygenerować etykietę dla wybranej sprzedaży wybierz opcje NADAJ. Następnie
          uzupełnij formularz i zatwierdź zamówienie.</p>
      </div>
    </div>

  </div>

</template>
