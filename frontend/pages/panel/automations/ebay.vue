<script setup lang="ts">

import {ref} from "vue";
import useEbayStore from "~/stores/useEbayStore";

const showInfoModal = ref(false);
const showInfoModalType = ref('');

const contentTypes = {
  api_configuration: {
    title: 'Konfiguracja Ebay',
    content: 'Jeśli masz dodatkowe pytania dotyczące konfiguracji skontaktuj się z nami pod adresem - tools@blpaczka.com'
  },
}

const {getProfile, unlinkAccount} = useEbayStore();
const {ebayProfile, ebayOauthRedirect} = storeToRefs(useEbayStore());
await getProfile();

let unlinkEbayAccount = async () => {
  if(confirm('Czy na pewno chcesz usunąć powiązanie konta?')){
    await unlinkAccount();
  } else {
    return false;
  }
}

let linkEbayProfile = async () => {
  console.log(ebayOauthRedirect);
  window.location.href = ebayOauthRedirect.value.oauth_url;
}

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})

</script>

<template>
  <div class="plugins_container">
    <div class="plugins_containerItems">
      <div>
        <div class="plugins_containerItem plugins_containerItem--big" style="font-size: 14px">
          <span class="plugins_containerContent" style="margin-right: 20px">
            <img src="/icons/ebay.png" alt="Ebay" width="150px" style="margin-bottom: 8px"/>
            Ebay
          </span>

          <div v-if="ebayProfile.profile">
            <h3>Profil ebay jest skonfigurowany</h3>
            <br/>
            <span style="color:grey">
              Login: {{ ebayProfile.profile.EbayProfile.login }}<br/>
            </span>
            <nuxt-link-locale to="panel-sales" class="link">
              Przejdź do sprzedaży
            </nuxt-link-locale>
            <br/><br/><br/>
            <button @click="unlinkEbayAccount()"
                    class="btn btn-block cta_button"
                    style="background: #1f7ae0; border: #1f7ae0;">Usuń powiązanie konta
            </button>
          </div>
          <div v-else>
            Konto nie jest powiązane<br/>
            <button @click="linkEbayProfile()" class="btn btn-block btn-primary py-2 text-center rounded cta_button"
                    style="background: #1f7ae0; border: #1f7ae0;">Powiąż konto Ebay
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

</template>


<style scoped>
.plugins_container {
  padding: 32px;
  height: 100%;
}

.plugins_containerItems {
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  gap: 16px;
}

.plugins_containerItem {
  display: flex;
  justify-content: left;
  align-items: center;
  padding: 16px;
  border-radius: 8px;
  border: 2px solid #F2F2F2;
  background-color: #FFFFFF;
  width: 250px;
  height: 140px;
  font-weight: 700;
  font-size: 25px;
  text-decoration: none;
  color: #262B44;
}

.plugins_containerItem--big {
  width: 1000px;
  height: 210px;
}

.plugins_containerContent {
  display: flex;
  justify-content: left;
  flex-wrap: wrap;
  flex-direction: column;
  align-items: center;
  font-family: Open Sans;
  font-size: 16px;
  font-weight: 400;
  color: #262B44;
}

.plugins_containerItem--big .plugins_containerContent {
  font-size: 21px;
}
</style>
