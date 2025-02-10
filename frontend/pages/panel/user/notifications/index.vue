<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";
import useNotificationsStore from "~/stores/panel/useNotificationsStore";

const { getNotifications, getNotificationsCount } = useNotificationsStore();
const { notifications } = storeToRefs(useNotificationsStore());

onMounted(async () => {
  await getNotifications();
  await getNotificationsCount();

  notifications.value = notifications.value.map((notification) => {
    return {
      ...notification.Notification,
    };
  });
});

const { t } = useI18n();
const { setPageValues } = usePageStore();

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
  <div class="blogCard_notificationWrapper">
    <div class="row" style="gap: 16px; justify-content: flex-start;">
      <nuxt-link-locale class="blogCard blogCard--notification" :to="{ name: 'panel-user-notifications-id', params: { id: notification.id }}" v-for="notification in notifications">
        <div class="blogCard_txtContainer blogCard_txtContainer--notification">
          <span class="blogCard_subtitleWrapper">
            <span class="blogCard_subtitle blogCard_subtitle--notification" :class="notification.is_read ? 'blogCard_subtitle--isRead' : ''">{{ notification.category }}</span>
          </span>

          <span class="blogCard_date blogCard_date--notification blogCard_date--notificationMobile">{{notification.publication_date}}</span>

          <span class="blogCard_summaryWrapper">
            <h3 class="blogCard_title blogCard_title--notification" :class="notification.is_read ? 'title--isRead' : ''">{{ notification.title }}</h3>
            <p class="blogCard_txt blogCard_txt--notification" v-html="notification.preview_text"></p>
          </span>

          <span class="blogCard_date blogCard_date--notification blogCard_date--notificationDesktop">{{notification.publication_date}}</span>
          <span class="blogCard_link" :class="notification.is_read ? 'blogCard_link--isRead' : ''">Czytaj więcej</span>
        </div>
      </nuxt-link-locale>
    </div>
  </div>
</template>

<style scoped lang="scss">
.new {
  flex: 1;
  background-color: #e1e5fb;
  color: #4285f4;
  margin-left: 20px;
  display: flex;
  justify-content: center;
  border-radius: 8px;
  align-items: center;
  max-width: 100px;
  font-size: 16px;
  padding: 2px;
  min-width: 104px;
}

.read_more {
  width: 100%;
  text-align: right;
  font-size: 16px;
  text-decoration: none;
}

.item-description {
  font-size: 13px;
  color: #262B44;
  //white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  width: 200px;
  height: 60px;
}

.title {
  text-decoration: none;
  color: black;
  font-size: 17px;
  font-weight: 700;
  margin-bottom: 8px;

  &--isRead {
    color: rgba(35, 34, 34, 0.6);
  }
}

.item-header {
  display: flex;
  align-items: center;
  font-size: 17px;
  font-weight: 700;
  margin-bottom: 8px;
  justify-content: space-between;

  img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    margin-right: 16px;
  }
}

.grid-container {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-gap: 10px;
  padding: 10px;

  @media (max-width: 768px) {
    grid-template-columns: repeat(2, 1fr);
  }

  @media (max-width: 480px) {
    grid-template-columns: repeat(1, 1fr);
  }
}

.grid-item  {
  display: flex;
  flex-direction: column;
  padding: 16px;
  border-radius: 8px;
  border: 2px solid #F2F2F2;
  background-color: #FFFFFF;
  box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.0784313725);
  font-size: 25px;
  text-decoration: none;
  color: #262B44;
  max-height: 150px;
  min-height: 150px;
}
</style>