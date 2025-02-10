<template>
  <v-layout>
    <div class="panel-container">
      <PanelLayoutLeftMenu class="mobile-hidden"/>
      <div class="right-content" :style="openedMenu ? 'width: calc(100% - 264px);' : 'width: calc(100% - 104px)'">
        <PanelLayoutTopMenu />
        <BannerPanelTop />
<!--        <div class="page-title">-->
<!--          <h1>{{ store.getPageName }}</h1>-->
<!--        </div>-->
        <v-main class="page-content">
          <div v-if="userExternalData?.Broker?.late_payment_invoices" style="box-sizing: unset; padding: 16px 32px; ">
            <div class="panel_infoContainer panel_infoContainer--error">
              <div class="row">
                <h3 class="panel_infoTitle">UWAGA!</h3>
              </div>
              <div class="row">
                <p class="panel_infoTxt">Posiadasz nieopłacone faktury!
                  <nuxt-link-locale :to="{name: 'panel-invoices', query: { payed: false }}">Sprawdź</nuxt-link-locale> »</p>
              </div>
            </div>
          </div>

          <div style="box-sizing: unset; padding: 16px 32px" v-show="successMessageShow" id="successPanelMessage">
            <div class="panel_infoContainer panel_infoContainer--success">
              <div class="row">
                <h3 class="panel_infoTitle">{{ successMessage.title }}</h3>
              </div>
              <div class="row">
                <p class="panel_infoTxt">{{ successMessage.message}}</p>
              </div>
            </div>
          </div>

          <div style="box-sizing: unset; padding: 16px 32px" v-show="errorMessageShow">
            <div class="panel_infoContainer panel_infoContainer--error" id="errorPanelMessage"
                 style="display: flex; justify-content: space-between; flex-wrap: nowrap">
              <div>
                <div class="row">
                  <h3 class="panel_infoTitle">{{ errorMessage.title }}</h3>
                </div>
                <div class="row">
                  <p class="panel_infoTxt">{{ errorMessage.message}}</p>
                </div>
              </div>
              <div style="color: white; cursor: pointer;" @click="errorMessageShow = false; errorMessage.title = ''; errorMessage.message = ''">
                <NuxtImg src="icons/close.png" width="23px" height="23px" class="modal_close"/>
              </div>
            </div>
          </div>
          <slot />
        </v-main>
      </div>
    </div>
  </v-layout>
</template>

<script setup lang="ts">
import useLeftMenuStore from "~/stores/useLeftMenuStore";
import usePageStore from "~/stores/usePageStore";
import {storeToRefs} from "pinia";
import useUserStore from "~/stores/useUserStore";

const router = useRouter();
const { openedMenu } = storeToRefs(useLeftMenuStore());
const { findActiveMenu } = useLeftMenuStore();
const store = usePageStore();
const { successMessage, successMessageShow, errorMessageShow, errorMessage } = storeToRefs(usePageStore());
const { userExternalData } = storeToRefs(useUserStore());
router.afterEach((to, from, failure) => {
  findActiveMenu(to.name);
});
const nuxt = useNuxtApp()

useHead({
  titleTemplate: (titleChunk) => {
    return titleChunk ? `${titleChunk} - BLPaczka` : 'BLPaczka';
  },
});

onBeforeRouteLeave((to, from) => {
  successMessageShow.value = false;
  errorMessageShow.value = false;
  successMessage.value = {
    title: '',
    message: '',
  };
  errorMessage.value = {
    title: '',
    message: '',
  };

});
</script>

<style scoped lang="scss">
@import "assets/styles/mobile.scss";

.panel-container {
  background-color: #ffffff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  min-height: 100vh;
  margin: 0;
  min-width: 100%;
  display: flex;
  max-width: 100vw;
}

.right-content {
  flex: 1;

  @media (max-width: 768px) {
    padding: 0;
  }
}

.page-content {
}

.page-title {
  padding-bottom: 32px;
  padding-left: 32px;

  h1 {
    font-family: Open Sans;
    font-size: 33px;
    font-weight: 600;
    line-height: 34px;
  }

  span {
    font-size: 14px;
    font-weight: 400;
    line-height: 32px;
  }

  @media (max-width: 768px) {
    display: none;
  }
}
</style>
<style>
.v-enter-active,
.v-leave-active {
  transition: opacity 0.3s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}

</style>