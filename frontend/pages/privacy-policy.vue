<script setup lang="ts">
  definePageMeta({
    middleware: 'default-layout',
  })
</script>

<template>
  <div class="container page_header">
    <h1 class="page_header--title">Polityka Prywatności</h1>
<!--    <div class="page_header&#45;&#45;subtitle">Phasellus tempus. Etiam imperdiet imperdiet orci. Quisque id mi. Mauris turpis-->
<!--      nunc, blandit et, volutpat molestie, porta ut, ligula. Vestibulum rutrum, mi nec elementum vehicula, eros quam-->
<!--      gravida nisl, id fringilla neque ante vel mi. In hac habitasse platea dictumst. Suspendisse nisl elit, rhoncus-->
<!--      eget, elementum ac, condimentum eget, diam. Sed in libero ut nibh placerat accumsan. In turpis. Quisque malesuada-->
<!--      placerat nisl-->
<!--    </div>-->
  </div>


  <div class="container">
    <h2 class="page_secondHeader">Dokumenty</h2>
    <div class="beam"></div>
    <div class="blog_documentList">
      <div class="blog_documentItem">
        <div class="icon">
          <svg width="30" height="32" viewBox="0 0 30 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M14.75 28H1V1H13L21 9V15" stroke="#202020" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M13.0039 1V9H21.0039" stroke="#202020" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M21.0039 31C25.4222 31 29.0039 27.4183 29.0039 23C29.0039 18.5817 25.4222 15 21.0039 15C16.5856 15 13.0039 18.5817 13.0039 23C13.0039 27.4183 16.5856 31 21.0039 31Z" stroke="#202020" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M21 18.9961V26.9961M21 26.9961L24 23.9961M21 26.9961L18 23.9961" stroke="#202020" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <div class="document-info">Polityka Prywatności Platformy BL Paczka</div>
        <div class="document-info document-info--hideMobile">Format: PDF</div>
        <div class="document-info document-info--hideMobile">Rozmiar: 2,00 MB</div>
        <div class="download-button">
          <a href="/files/Polityka_Prywatnosci_Platformy_BL_Paczka.pdf" class="buttonSecondary" download>Pobierz plik</a>
        </div>
      </div>
    </div>
  </div>


  <Cta />
</template>

<style scoped lang="scss">
.beam {
  height: 2px;
  width: 100%;
  background-color: #F2F2F2;
}

.page_secondHeader {
  font-family: "Open Sans";
  font-size: 16px;
  font-weight: 700;
  line-height: 22px;
  text-align: left;
  margin-bottom: 32px;
  margin-top: 32px;
}

.page_header {
  margin-top: 56px;

  &--title {
    font-family: "Open Sans";
    font-size: 33px;
    font-weight: 600;
    line-height: 33px;
    text-align: left;
  }

  &--subtitle {
    font-family: "Open Sans";
    font-size: 13px;
    font-weight: 400;
    line-height: 24px;
    text-align: left;
    margin-top: 32px;
  }
}

.buttonSecondary {
  font-size: 12px;
  font-weight: 700;
  line-height: 22px;
  color: #4285F4;
  padding: 4px 10px;
  border: 2px solid #4285F4;
  border-radius: 100px;
  max-height: 54px;
  text-decoration: none;
  margin-right: 16px;
  cursor: pointer;
  transition-property: all;
  transition-duration: 0.2s;
  transition-timing-function: ease;

  &:hover {
    color: #ffffff;
    background-color: #4285F4;
    border: 2px solid #4285F4;
  }
}

</style>