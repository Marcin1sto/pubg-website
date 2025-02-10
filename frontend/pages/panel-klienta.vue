<script setup lang="ts">
import useC2CStore from "~/stores/useC2CStore";

const { isC2C } = storeToRefs(useC2CStore());

const questionsB2B = ref([
  {
    title: 'Jak nadać przesyłkę używając panelu BLPaczka?',
    description: '<iframe width="560" height="315" src="https://www.youtube.com/embed/-anuywq5yv4?si=z8fESfWZKYfldeDJ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>',
    isOpen: true
  },
  {
    title: 'Jak doładować konto Skarbonka?',
    description: '<iframe width="560" height="315" src="https://www.youtube.com/embed/Slar2vmk2gI?si=N_kr21NjsI75oqP-" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>',
    isOpen: false
  },
  {
    title: 'Jak połączyć BLPaczka z systemem BaseLinker?',
    description: '<iframe width="560" height="315" src="https://www.youtube.com/embed/bEHCIxvGeVE?si=4j8l-EkwEQRtVuaS" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>',
    isOpen: false
  },
]);

const questionsC2C = ref([
  {
    title: 'Jak nadać przesyłkę używając panelu BLPaczka?',
    description: '<iframe width="560" height="315" src="https://www.youtube.com/embed/-anuywq5yv4?si=z8fESfWZKYfldeDJ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>',
    isOpen: true
  },
  {
    title: 'Jak doładować konto Skarbonka?',
    description: '<iframe width="560" height="315" src="https://www.youtube.com/embed/Slar2vmk2gI?si=N_kr21NjsI75oqP-" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>',
    isOpen: false
  }
])

definePageMeta({
  middleware: 'default-layout',
})
</script>

<template>
  <div class="container page_header">
    <h1 class="page_header--title">Panel klienta</h1>
    <!--    <div class="page_header&#45;&#45;subtitle">Phasellus tempus. Etiam imperdiet imperdiet orci. Quisque id mi. Mauris turpis-->
    <!--      nunc, blandit et, volutpat molestie, porta ut, ligula. Vestibulum rutrum, mi nec elementum vehicula, eros quam-->
    <!--      gravida nisl, id fringilla neque ante vel mi. In hac habitasse platea dictumst. Suspendisse nisl elit, rhoncus-->
    <!--      eget, elementum ac, condimentum eget, diam. Sed in libero ut nibh placerat accumsan. In turpis. Quisque malesuada-->
    <!--      placerat nisl.-->
    <!--    </div>-->
  </div>

  <div class="container" v-if="!isC2C">
    <div class="cart question" v-for="(item, index) in questionsB2B" :key="index">
      <div class="question--title" @click.prevent="item.isOpen = !item.isOpen">
        {{ item.title }}
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" v-show="item.isOpen">
          <circle cx="20" cy="20" r="20" fill="#F2F5FB"/>
          <path d="M24.8125 21.6562L20.5022 16.625L16.1875 21.6562" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" v-show="!item.isOpen">
          <circle cx="20" cy="20" r="20" transform="matrix(1 0 0 -1 0 40)" fill="#F2F5FB"/>
          <path d="M24.8125 18.3438L20.5022 23.375L16.1875 18.3438" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>

      </div>
      <div class="beam"></div>
      <div class="question--description" v-show="item.isOpen" v-html="item.description"></div>
    </div>
  </div>

  <div class="container" v-if="isC2C">
    <div class="cart question" v-for="(item, index) in questionsC2C" :key="index">
      <div class="question--title" @click.prevent="item.isOpen = !item.isOpen">
        {{ item.title }}
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" v-show="item.isOpen">
          <circle cx="20" cy="20" r="20" fill="#F2F5FB"/>
          <path d="M24.8125 21.6562L20.5022 16.625L16.1875 21.6562" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" v-show="!item.isOpen">
          <circle cx="20" cy="20" r="20" transform="matrix(1 0 0 -1 0 40)" fill="#F2F5FB"/>
          <path d="M24.8125 18.3438L20.5022 23.375L16.1875 18.3438" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>

      </div>
      <div class="beam"></div>
      <div class="question--description" v-show="item.isOpen" v-html="item.description"></div>
    </div>
  </div>

  <Cta />
</template>

<style scoped lang="scss">
.page_header {
  margin-top: 56px;

  &--title {
    font-family: "Open Sans";
    font-size: 33.18px;
    font-weight: 600;
    line-height: 33.18px;
    text-align: left;
    color: #262B44;
  }

  &--subtitle {
    font-family: "Open Sans";
    font-size: 13.33px;
    font-weight: 400;
    line-height: 23.99px;
    text-align: left;
    margin-top: 32px;
    color: #262B44;
  }
}

.beam {
  width: 100%;
  height: 1px;
  background-color: #F2F2F2;
}

.question {
  //display: flex;
  //flex-direction: row;

  &--title {
    font-family: "Open Sans";
    font-size: 16px;
    font-weight: 700;
    line-height: 21.79px;
    text-align: left;
    padding: 40px;
    display: flex;
    justify-content: space-between;
    cursor: pointer;
    align-items: center;
    color: #262B44;
  }

  &--description {
    font-family: "Open Sans";
    font-size: 13px;
    font-weight: 400;
    line-height: 24px;
    padding: 40px;
    color: #262B44;

    a {
      font-family: "Open Sans";
      font-size: 13px;
      font-weight: 700;
      line-height: 24px;
      color: #4285F4;
      text-decoration: none;
    }
  }
}

.question--link {
  font-family: "Open Sans";
  font-size: 13px;
  font-weight: 700;
  line-height: 24px;
  color: #4285F4;
  text-decoration: none;
}

.cart {
  width: 100%;
  margin-top: 24px;
  border-radius: 8px;
  border: 1px solid #F2F2F2;
  box-shadow: 0px 0px 15px 0px #00000014;
  //padding: 40px;
  //display: flex;
  margin-bottom: 40px;
  background-color: white;
  color: black;

  @media screen and (max-width: 1000px) {
    //flex-direction: column;
    gap: 24px;
  }
}
</style>