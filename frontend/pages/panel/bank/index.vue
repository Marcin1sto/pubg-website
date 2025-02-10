<template>
  <div style="box-sizing: unset; padding: 16px 32px" v-if="router.currentRoute.value.query.success">
    <div class="panel_infoContainer panel_infoContainer--success">
      <div class="row">
        <h3 class="panel_infoTitle">{{ router.currentRoute.value.query.success === 'CONFIRMED' ? 'Sukces!' : 'Ksiegowanie' }}</h3>
      </div>
      <div class="row">
        <p class="panel_infoTxt">{{ router.currentRoute.value.query.success === 'CONFIRMED' ? 'Doładowaliśmy Twoją skarbonkę!' : 'Ksiegujemy Twoją płatność' }}</p>
      </div>
    </div>
  </div>

  <div class="information_section">

      <div class="cardInfo_card">
        <div class="header">
          <h2 class="cardInfo_title"><span class="cardInfo_txt">Saldo Twojej Skarbonki:</span> <span class="cardInfo_highlighted">{{ formatBalance() }} zł</span></h2>
        </div>
        <div class="feature">
          <span class="feature-icon">
            <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1 6.4L7.3 13L19 1" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10"
                    stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>Wpłacaj kiedy chcesz
        </div>
        <div class="feature">
          <span class="feature-icon">
            <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1 6.4L7.3 13L19 1" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10"
                    stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>Korzystaj kiedy chcesz
        </div>
        <div class="feature">
          <span class="feature-icon">
            <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1 6.4L7.3 13L19 1" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10"
                    stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>Opłacaj przesyłki
        </div>
        <a @click.prevent="showRechargeModalModal = true" class="button" style="margin-top: 20px;" target="_blank">Doładuj skarbonkę</a>
      </div>


      <div class="cardInfo_card" v-if="userExternalData?.Broker?.credit_saldo && !isC2C">
        <div class="header">
          <h2 class="cardInfo_title"><span class="cardInfo_txt">Saldo kredytu kupieckiego:</span> <span class="cardInfo_highlighted">{{ formatCreditSaldo() }} zł</span></h2>
        </div>
        <div class="feature">
          <span class="feature-icon">
            <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1 6.4L7.3 13L19 1" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10"
                    stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          Nadawaj teraz, płać później
        </div>
        <div class="feature">
          <span class="feature-icon">
            <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1 6.4L7.3 13L19 1" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10"
                    stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          2-tygodniowy okres rozliczeniowy
        </div>
        <div class="feature">
          <span class="feature-icon">
            <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1 6.4L7.3 13L19 1" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10"
                    stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          7-dniowy termin płatności
        </div>

        <a :href="nuxt.$localePath({ name: 'panel-contact'})" class="button"
           style="margin-top: 20px;" target="_blank">Złóż wniosek</a>
      </div>


      <div class="cardInfo_card" v-if="!isC2C">
        <div class="header">
          <h2 class="cardInfo_title"><span class="cardInfo_txt">Linia odnawialna FlexKapitał</span><span class="cardInfo_highlighted">Nowość</span></h2>
        </div>
        <div class="feature">
          <span class="feature-icon">
            <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1 6.4L7.3 13L19 1" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10"
                    stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          Linia finansowa do 100.000 PLN
        </div>
        <div class="feature">
          <span class="feature-icon">
            <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1 6.4L7.3 13L19 1" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10"
                    stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          Darmowy wniosek w 100% online
        </div>
        <div class="feature">
          <span class="feature-icon">
            <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1 6.4L7.3 13L19 1" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10"
                    stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          Możliwość wcześniejszej spłaty
        </div>
        <a href="https://www.finiata.pl/blpaczka-finiata-dla-firm/" class="button"
           style="margin-top: 20px;" target="_blank">Sprawdź ofertę</a>
        <div class="footer-finiata">
          Powered by <NuxtImg src="/images/finiata-logo-dark.svg" width="52px"/>
        </div>
      </div>

  </div>
<!--  <div class="information_section">-->
<!--   <ButtonSecondary @click.prevent="showRechargeModalModal = true">Doładuj skarbonkę</ButtonSecondary>-->
<!--  </div>-->
  <div class="form_filters">
    <div class="filters_container">
      <div class="filters_row">
        <button class="orderDetails_backButton" @click="showFilters = !showFilters">
          {{ showFilters ? 'Ukryj' : 'Pokaż' }} filtry
          <NuxtImg :src="!showFilters ? 'icons/orderDetails/arrowDown.png' : 'icons/orderDetails/arrowUp.png'"
                   width="37px" height="37px" class="filters_backButtonImg"/>
        </button>
      </div>

      <div class="filters_content" v-show="showFilters">
        <div class="row row--alignStart row--alignBaseline row--gap16">
          <div class="form_inputContainer200">
            <InputTextWithLabel label-text="Kwota od" @change="searchParams.value_from = $event"
                                :input-model-value="searchParams.value_from"/>
          </div>
          <div class="form_inputContainer200">
            <InputTextWithLabel label-text="Kwota do" @change="searchParams.value_to = $event"
                                :input-model-value="searchParams.value_to"/>
          </div>
          <div class="form_inputContainer200">
            <InputTextWithLabel label-text="W opisie" @change="searchParams.desc = $event"
                                :input-model-value="searchParams.desc"/>
          </div>
          <InputFilterDatepicker :disable-year-select="false" :label="'Data od'" @change="searchParams.date_from = $event"
                                 :value="searchParams.date_from"/>
          <InputFilterDatepicker :disable-year-select="false" :label="'Data do'" @change="searchParams.date_to = $event"
                                 :value="searchParams.date_to"/>
        </div>
        <div class="filters_contentButtonsContainer">
          <button class="filters_buttonPrimary" @click="fetchWithFilters">Szukaj</button>
          <button class="filters_buttonSecondary" v-show="Object.values(searchParams).length > 0" @click="clearFilters">
            Wyczyść filtry
          </button>
        </div>
      </div>
    </div>
  </div>

  <Table />


  <Teleport to="body">
    <Modal :show="showRechargeModalModal" @close="showRechargeModalModal = false">
      <template #header>
        <h1 class="modal_title modal_title--big">Doładowywanie skarbonki</h1>
      </template>
      <template #body>
        <div class="form_errorMessageAlert" id="errorMessageAlert" v-show="responseRechargeError">
          <div class="form_errorMessageAlert--title"><NuxtImg src="icons/orderForm/checkError.png"/><span>Uwaga!</span></div>
          <div class="form_errorMessageAlert--text">{{ responseRechargeError }}</div>
        </div>

        <div style="display: flex; justify-content: center; align-items: center; flex-direction: column">
          <div class="modal_txt" style="margin-bottom: 15px">Podaj kwotę za którą chcesz doładować konto.</div>
          <div class="form_inputContainer300">
            <input type="number" id="" name="" v-model="rechargeAmount"
                   class="form_inputTxt form_inputTxt--withoutUnit"
                   @change.prevent="rechargeAmount = $event.target.value; checkValue($event.target.value)"
                   min="5" max="100000"
            />
            <span class="signin_errorMsg signin_errorMsg--show" v-if="rechargeAccountCheck">Wartość doładowania musi się mieścić <br> pomiędzy 5zł a 100 000zł</span>
          </div>
          <ButtonSecondary @click.prevent="rechargeAccount">Doładuj</ButtonSecondary>
        </div>
        <FormSpinerLoaderWithText :loading="rechargeAccountLoading">Procesowanie...</FormSpinerLoaderWithText>
      </template>
    </Modal>
  </Teleport>
</template>

<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";
import useBankStore from "~/stores/panel/useBankStore";
import {useTableStore} from "~/stores/useTableStore";
import useUserStore from "~/stores/useUserStore";
import {ref} from "vue";

const {t} = useI18n();
const {setPageValues} = usePageStore();
const nuxt = useNuxtApp()
setPageValues(
    t('page.panel.bank.title'),
);

const showFilters = ref(true);
const rechargeAccountCheck = ref(false);
const checkValue = (value) => {
  if (value < 5 || value > 100000) {
    rechargeAccountCheck.value = true;
    return;
  }

  if (value >= 5 && value <= 100000) {
    rechargeAccountCheck.value = false;
  }
}

const tableHeaders = [
  {key: 'price', label: t('bank.table.price'), sortable: true},
  {key: 'created', label: t('bank.table.created'), sortable: true},
  {key: 'description', label: t('bank.table.description'), sortable: false},
];

const rechargeAmount = ref(null);
const showRechargeModalModal = ref(false);
const rechargeAccountLoading = ref(false);
const responseRechargeError = ref(null);

const { getBanks, rechargeBank } = useBankStore();
const { getUserBalance, formatBalance, formatCreditSaldo } = useUserStore();
const { userExternalData } = storeToRefs(useUserStore());
const { tableItems, searchParams } = storeToRefs(useBankStore());
const { setItems, setHeaders, startLoadingAsyncData } = useTableStore();
setHeaders(tableHeaders);
const router = useRouter();
await getUserBalance();

const isC2C = userExternalData.value.Broker.consumer_account;

const rechargeAccount = async () => {
  if (rechargeAccountCheck.value) {
    return;
  }

  rechargeAccountLoading.value = true;
  let result = await rechargeBank(rechargeAmount.value);

  if (result.success) {
    if (result.data.paymentUrl) {
      window.location.href = result.data.paymentUrl;
      rechargeAccountLoading.value = false;
      return;
    }
  }

  responseRechargeError.value = result.message;
  rechargeAccountLoading.value = false;
};

const asyncData = async () => {
  startLoadingAsyncData();
  await getBanks();
  await setHeaders(tableHeaders)
  await setItems(tableItems.value);
};

await asyncData();

const { page } = storeToRefs(useTableStore());

onMounted(async () => {
  page.value = 1;
});

let unwatchBanksPage = watch(page, (newValue) => {
  searchParams.value.page = newValue;
  asyncData();
});

onBeforeRouteLeave((to, from, next) => {
  unwatchBanksPage();
  next();
});

watch(searchParams, (newValue) => {
  if (newValue === '') {
    clearFilters();
    return;
  }

  asyncData();
}, {deep: true});

const clearFilters = async () => {
  searchParams.value = {};
  await getBanks();
  await setItems(tableItems.value);
}

const fetchWithFilters = async () => {
  startLoadingAsyncData();
  await getBanks();
  await setItems(tableItems.value);
}
useHead({
  title: t('page.panel.bank.title')
});

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>

<style scoped>
.feature {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
  gap: 10px;
}

.header {
  display: flex;
  font-size: 18px;
  color: #333;
  margin-bottom: 20px;
  justify-content: space-between;
}

.cardInfo_title {
  display: flex;
  font-size: 18px;
  font-weight: 400;
  line-height: 1.5;
  color: #333;
  gap: 16px;
  align-items: center;
  width: 100%;
  flex-wrap: wrap;
}

.cardInfo_txt {
  @container informationSectionContainer (min-width: 1050px) and (max-width: 1249px) {
    width: 100%;
  }

  @container informationSectionContainer (min-width: 730px) and (max-width: 865px) {
    width: 100%;
  }

  @container informationSectionContainer (max-width: 549px) {
    width: 100%;
  }
}

.cardInfo_highlighted {
  background-color: #e1e5fb;
  color: #4285f4;
  display: flex;
  justify-content: center;
  border-radius: 8px;
  align-items: center;
  font-size: 16px;
  padding: 4px 12px;
}

.information_section {
  font-family: "Open Sans", sans-serif;
  display: flex;
  flex-wrap: wrap;
  padding-inline: 32px;
  gap: 16px;
  container-type: inline-size;
  container-name: informationSectionContainer;
}

.cardInfo_card {
  font-family: "Open Sans", sans-serif;
  border-radius: 8px;
  padding: 20px;
  box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.0784313725);
  background-color: #ffffff;
  color: #262B44;
  width: calc(33% - 10px);

  @container informationSectionContainer (max-width: 1049px) {
    width: calc(50% - 8px);
  }

  @container informationSectionContainer (max-width: 729px) {
    width: 100%;
  }
}

.button {
  text-align: center;
  text-decoration: none;
  display: block;
  font-size: 16px;
  cursor: pointer;
  color: #ffffff;
  background-color: #4285F4;
  padding: 8px 24px;
  border: 2px solid #4285F4;
  border-radius: 100px;
  transition-property: all;
  transition-duration: 0.2s;
  transition-timing-function: ease;
}

.button:hover {
  color: #4285F4;
  background-color: #ffffff;
}

.footer-finiata {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 5px;
  text-align: center;
  margin-top: 20px;
  font-size: 12px;
  color: #666;
}
</style>