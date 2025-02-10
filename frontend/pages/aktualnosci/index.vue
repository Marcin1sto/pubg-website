<script setup lang="ts">
import useNewsStore from "~/stores/useNewsStore";

const { getNews } = useNewsStore();
const { news, article } = storeToRefs(useNewsStore());

onMounted(async () => {
  await getNews();

  news.value = news.value.map((article) => {
    return {
      ...article.News,
    };
  });

  news.value = news.value.filter((article) => article.slug);
});

const { t } = useI18n();

useHead({
  title: t('page.news.title')
});
</script>

<template>
  <div class="container">
    <div class="row">
      <h1 class="news_header">Aktualności</h1>
    </div>

    <div class="row row--blogList">
      <nuxt-link-locale :to="{ name: 'aktualnosci-slug', params: { slug: article.slug }}" class="blogCard blogCard--blogSite" v-for="article in news">
        <div class="blogCard_imgContainer">
          <NuxtImg :src="article.picture" class="blogCard_img" />
        </div>
        <div class="blogCard_txtContainer blogCard_txtContainer--blogSite">
          <span class="blogCard_subtitle">{{ article.category }}</span>
          <h3 class="blogCard_title">{{ article.title }}</h3>
          <span class="blogCard_date">{{article.publication_date}}</span>
          <p class="blogCard_txt" v-html="article.preview_text"></p>
          <span class="blogCard_link">Czytaj więcej</span>
        </div>
      </nuxt-link-locale>
    </div>
  </div>

  <Cta />
</template>