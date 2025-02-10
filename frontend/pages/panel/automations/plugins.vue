<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";
import {ref} from "vue";

const {t} = useI18n();
const {setPageValues} = usePageStore();

const nuxt = useNuxtApp();

const plugins = [
  {
    name: 'API',
    isLink: true,
    isNew: false,
    imageLink: '/icons/blpLogoMain.png',
    link: nuxt.$localePath('panel-automations-api')
  },
  {
    name: 'Allegro',
    isLink: true,
    isNew: false,
    imageLink: '/icons/allegro.png',
    link: nuxt.$localePath('panel-automations-allegro')
  },
  {
    name: 'Ebay',
    isLink: true,
    isNew: false,
    imageLink: '/icons/ebay.png',
    link: nuxt.$localePath('panel-automations-ebay')
  },
  {
    name: 'IdoSell',
    isLink: true,
    isNew: false,
    imageLink: '/icons/idosell.png',
    link: nuxt.$localePath('panel-automations-idosell')
  },
  // {
  //   name: 'BaseLinker',
  //   isLink: true,
  //   imageLink: '/icons/Baselinker-logo.png',
  //   link: nuxt.$localePath('panel-automations-baselinker')
  // },
  {
    name: 'WooCommerce',
    isLink: true,
    isNew: false,
    imageLink: '/images/plugins/woocommerce-logo-color-black.svg',
    link: 'https://wordpress.org/plugins/blpaczka/#description'
  },
  {
    name: 'PrestaShop',
    isLink: true,
    isNew: true,
    imageLink: '/images/plugins/prestashop/prestashop.svg',
    link: nuxt.$localePath('panel-automations-prestashop')
  },
  {
    name: 'Magento',
    isLink: true,
    isNew: true,
    imageLink: '/images/plugins/magento/magento.svg',
    link: nuxt.$localePath('panel-automations-magento')
  }
]

const apiKeyGenerateMessage = ref('');
const apiKeyGenerateSuccess = ref(null);
const {userExternalData} = storeToRefs(useUserStore());
const {saveApiKey} = useUserStore();
const generateNewKey = async () => {
  let apiKey = Math.random().toString(36).substr(2) + Math.random().toString(36).substr(2);
  let result = await saveApiKey(apiKey);

  apiKeyGenerateSuccess.value = result.success;
  if (result.success) {
    userExternalData.value.Broker.api_key = apiKey;
    apiKeyGenerateMessage.value = 'Klucz został wygenerowany poprawnie';
  } else {
    apiKeyGenerateMessage.value = 'Wystąpił błąd podczas generowania klucza';
  }
}

const showInfoModal = ref(false);
const showInfoModalType = ref('');

const contentTypes = {
  api_configuration: {
    title: 'Konfiguracja API',
    content: 'Jeśli masz dodatkowe pytania dotyczące konfiguracji skontaktuj się z nami pod adresem - tools@blpaczka.com'
  },
  allegro: {
    title: 'Allegro',
    content: 'Jeśli masz dodatkowe pytania dotyczące konfiguracji skontaktuj się z nami pod adresem -'
  }
}

setPageValues(
    t('page.panel.automations.plugins.title'),
);

useHead({
  title: t('page.panel.automations.plugins.title')
});

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>

<template>
  <div class="pricesDetails_container">
    <div class="pricesDetails_containerItems">
      <div v-for="plugin in plugins">
        <a :href="plugin.link" v-if="plugin.isLink" class="pricesDetails_containerItem pricesDetails_containerItem--plugin" :class="{ pricesDetails_containerItemPluginPromo: plugin.isNew }">
          <span class="pricesDetails_containerContent pricesDetails_containerContent--plugin">
            <img :src="plugin.imageLink" :alt="plugin.name" style="max-width: 150px"/>
          </span>

          <span class="pricesDetails_isNew" v-if="plugin.isNew">Nowość</span>

          <span class="pricesDetails_icon pricesDetails_icon--plugin" :class="{ pricesDetails_iconPluginIsNew: plugin.isNew }">
            <NuxtImg src="icons/plugin-icon.png" width="30px" height="30px"/>
          </span>
        </a>
      </div>
    </div>
  </div>




  <div class="plugins_container">
    <div class="plugins_containerItems">
      <div v-for="plugin in plugins">
        <a :href="plugin.link" v-if="plugin.isLink" class="plugins_containerItem plugins_containerItem--big">
          <span class="plugins_containerContent">
            <img :src="plugin.imageLink" :alt="plugin.name"  width="150px" style="margin-bottom: 8px"/>
            {{ plugin.name }}
          </span>
        </a>
      </div>

<!--      <div class="big">-->
<!--        <div class="calc_inputContainer calc_inputContainer&#45;&#45;fullWidth">-->
<!--          <div style="display: flex; width: 100%;">-->
<!--            <h3 class="calc_subtitle" style="width: max-content; cursor: pointer"-->
<!--                @click="showConfigurationApi = !showConfigurationApi">Konfiguracja API</h3>-->
<!--            <NuxtImg src="icons/tooltipIcon.png" style="margin-left: 5px; width: 11px; height: 11px" width="11px"-->
<!--                     height="11px" @click.prevent="showInfoModalType = 'api_configuration'; showInfoModal = true"/>-->
<!--          </div>-->
<!--          <label v-show="showConfigurationApi" for="" class="calc_label">Klucz autoryzacji do API (api_key)</label>-->
<!--          <div v-show="showConfigurationApi" class="calc_inputWithUnit calc_inputWithUnit&#45;&#45;wrap"-->
<!--               style="margin-bottom: 16px !important;">-->
<!--            <input type="text" id="" name="api_key" :value="userExternalData.Broker.api_key"-->
<!--                   class="calc_inputTxt calc_inputTxt&#45;&#45;withoutUnit calc_inputTxt&#45;&#45;fullWidth"/>-->
<!--            <button class="filters_buttonSecondary" @click.prevent="generateNewKey" style="margin-top: 10px">Generuj-->
<!--              nowy-->
<!--            </button>-->
<!--          </div>-->
<!--          <span v-if="apiKeyGenerateMessage" :class="[-->
<!--                        apiKeyGenerateSuccess ? 'calc_successMsg' : 'calc_errorMsg',-->
<!--                        apiKeyGenerateMessage ? 'calc_successMsg&#45;&#45;show' : 'calc_errorMsg&#45;&#45;show'-->

<!--                    ]">{{ apiKeyGenerateMessage }}</span>-->
<!--        </div>-->
<!--      </div>-->
    </div>
  </div>

  <Teleport to="body">
    <Modal :show="showInfoModal" @close="showInfoModal = false">
      <template #header>
        <h1 class="modal_title">{{ contentTypes[showInfoModalType].title }}</h1>
      </template>
      <template #body>
        <p class="modal_txt" v-html="contentTypes[showInfoModalType].content"></p>
      </template>
    </Modal>
  </Teleport>
</template>

<style scoped>
.plugins_container {
  padding: 32px;
  height: 100%;
  container-type: inline-size;
  container-name: pluginsContainer;
}

.plugins_containerItems {
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  gap: 16px;

  @container pluginsContainer (max-width: 435px) {
    justify-content: center;
  }
}

.plugins_containerItem {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 16px;
  border-radius: 8px;
  border: 2px solid #F2F2F2;
  background-color: #FFFFFF;
  width: 140px;
  height: 140px;
  font-weight: 700;
  font-size: 25px;
  text-decoration: none;
  color: #262B44;
}

.plugins_containerItem--big {
  width: 210px;
  height: 210px;
}

.plugins_containerContent {
  display: flex;
  justify-content: center;
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