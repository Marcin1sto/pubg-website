<script setup lang="ts">

import usePageStore from "~/stores/usePageStore";
import useNotificationsStore from "~/stores/panel/useNotificationsStore";

const {getNotificationView, getNotificationsCount} = useNotificationsStore();
const {singleNotification} = storeToRefs(useNotificationsStore());
const router = useRouter();

onMounted(async () => {
  await getNotificationView(router.currentRoute.value.params.id);
  await getNotificationsCount();
});

const {t} = useI18n();
const {setPageValues} = usePageStore();
const content = ''
setPageValues(
    t('page.panel.user.notifications.title'),
);

useHead({
  title: t('page.panel.user.notifications.title')
});

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>

<template>
  <div class="container_notification">
    <nuxt-link-locale to="panel-user-notifications" class="orderDetails_backButton" style="margin-bottom: 20px">
      <NuxtImg src="icons/orderDetails/arrowLeft.png" width="37px" height="37px" class="orderDetails_backButtonImg"/>
      Wróć do powiadomień
    </nuxt-link-locale>

    <div class="blog_articleContainer">
      <div class="blog_header">
        <img :src="singleNotification.picture" alt="image" class="blog_headerImg">

        <div class="row">
          <span class="blogCard_subtitle">{{singleNotification.category}}</span>

          <span>{{singleNotification.publication_date}}</span>
        </div>

        <div class="row">
          <h1 class="blog_title">{{ singleNotification.title }}</h1>
        </div>
      </div>

      <div class="blog_article" v-html="singleNotification.body"></div>

      <div class="row">
        <img v-for="picture in singleNotification.pictures" :src="picture.picture_url" class="blog_img"/>
      </div>

      <h2 class="page_secondHeader" v-if="singleNotification?.files?.length > 0" style="margin-top: 20px">Dokumenty do pobrania</h2>
      <div style="padding-inline: 30px" v-if="singleNotification?.files?.length > 0">
        <div class="blog_documentList">
          <div class="blog_documentItem" v-for="file in singleNotification.files">
            <div class="icon">
              <svg width="30" height="32" viewBox="0 0 30 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.75 28H1V1H13L21 9V15" stroke="#202020" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M13.0039 1V9H21.0039" stroke="#202020" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M21.0039 31C25.4222 31 29.0039 27.4183 29.0039 23C29.0039 18.5817 25.4222 15 21.0039 15C16.5856 15 13.0039 18.5817 13.0039 23C13.0039 27.4183 16.5856 31 21.0039 31Z" stroke="#202020" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M21 18.9961V26.9961M21 26.9961L24 23.9961M21 26.9961L18 23.9961" stroke="#202020" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
            <div class="document-info">{{ file.title }}</div>
            <div class="document-info">Format: {{ file.ext.toString().toUpperCase() }}</div>
            <div class="download-button">
              <a :href="file.file_url" class="buttonSecondary" download>Pobierz plik</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
.container_notification {
  box-sizing: unset;
  padding: 16px 32px;
}
</style>