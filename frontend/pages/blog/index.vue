<script setup lang="ts">
import useArticlesStore from "~/stores/useArticlesStore";

const { getArticles, fetchCategories } = useArticlesStore();
const { articles, getCategories } = storeToRefs(useArticlesStore());

onMounted(async () => {
  await getArticles();
  await fetchCategories();
});


const selectedCategory = ref(null);
const { t } = useI18n();

watch(() => selectedCategory.value, async () => {
  await getArticles(selectedCategory.value);
})

useHead({
  title: t('page.articles.title')
});
</script>

<template>
  <div class="container">
    <div class="row">
      <h1 class="news_header">Blog</h1>
    </div>

    <div class="row row--blogCategories">
      <span v-for="category in getCategories"
            :class="selectedCategory == category.slug ? '' : 'blogCard_subtitle--notSelected'"
            class="blogCard_subtitle blogCard_subtitle--tag"
            @click.prevent="selectedCategory === category.slug ? selectedCategory = null : selectedCategory = category.slug"
      >
        {{ category.name }}
      </span>
    </div>

    <div class="row row--blogList">
      <nuxt-link-locale :to="{ name: 'blog-slug', params: { slug: article.slug }}" class="blogCard blogCard--blogSite" v-for="article in articles">
        <div class="blogCard_imgContainer">
          <img :src="article.picture" class="blogCard_img" />
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