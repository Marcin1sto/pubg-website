<template>
  <div class="container page_header">
    <h1 class="page_header--title page_header--titleCentered">Kontakt</h1>
    <div class="page_header--subtitle page_header--subtitleCentered">Zapraszamy do kontaktu. Odpowiemy <b>w ciągu 24 godzin.</b></div>
  </div>
  <div class="container cart_container">
    <div class="cart cart_container--child">
      <div class="cart_container--child--title">Jestem zainteresowany ofertą</div>
      <div class="cart_container--child--subtitle">Kontakt dla nowych klientów:</div>
      <div class="navigation_row buttons">
        <a href="mailto:oferta@blpaczka.com" class="navigation_buttonSecondary">oferta@blpaczka.com</a>
      </div>
    </div>
    <div class="cart cart_container--child">
      <div class="cart_container--child--title">Mam sprawę/pytanie</div>
      <div class="cart_container--child--subtitle">Kontakt dla obecnych klientów:</div>
      <div class="navigation_row buttons">
        <a href="mailto:info@blpaczka.com" class="navigation_buttonSecondary">info@blpaczka.com</a>
      </div>
    </div>
  </div>
  <div class="container page_secondHeader">
    <h2 class="cta_title">Potrzebujesz więcej informacji? Skontaktuj się z nami.</h2>
  </div>
  <div class="contact_container" id="contactForm">
    <div class="line"></div>
    <div class="contact_container--grid" style="">
      <div class="image">
        <NuxtImg src="images/helpDesk.svg" width="502px" height="400px"/>
      </div>
      <div class="cart cart--form">
        <FormContact :use-checkbox-section="true"/>
      </div>
    </div>
  </div>
  <Cta />
</template>

<script setup lang="ts">
const router = useRouter();
const {authenticated} = storeToRefs(useAuthStore());
const {checkIfUserIsAuthenticated} = useAuthStore();
checkIfUserIsAuthenticated();

const showContactSection = () => {
  const contactSection = document.getElementById('contactForm');
  if (contactSection) {
    contactSection.scrollIntoView({ behavior: 'smooth', block: "end" });
  }
}

definePageMeta({
  middleware: 'default-layout',
})
</script>

<style scoped lang="scss">
.buttons {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;

  .navigation_buttonSecondary {
    margin-right: 0;
  }
}
.cart_container {
  display: flex;
  gap: 18px;

  @media screen and (max-width: 899px) {
    flex-wrap: wrap;
    justify-content: center;
    gap: 0;
  }

  &--child {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 33px !important;
    width: calc(100% - 60px);

    &--title {
      font-family: "Open Sans";
      font-size: 23.04px;
      font-weight: 600;
      line-height: 23.04px;
      margin-bottom: 10px;
      color: #262B44;
      text-align: center;
    }

    &--subtitle {
      font-family: "Open Sans";
      font-size: 16px;
      font-weight: 600;
      line-height: 19.2px;
      margin-bottom: 32px;
      color: #262B44;
    }
  }
}

.page_secondHeader {
  display: flex;
  justify-content: center;
  font-family: "Open Sans", serif;
  font-size: 24px;
  font-weight: 600;
  line-height: 36px;
  text-align: center;
  color: #262B44;
}

.page_header {
  margin-top: 56px;

  &--title {
    font-family: "Open Sans", serif;
    font-size: 33px;
    font-weight: 600;
    line-height: 33px;
    margin-bottom: 32px;
    color: #262B44;
  }

  &--titleCentered {
    text-align: center;
  }

  &--subtitle {
    font-family: Open Sans;
    font-size: 16px;
    font-weight: 600;
    line-height: 19px;
    color: #262B44;
  }

  &--subtitleCentered {
    text-align: center;
  }
}

.contact_container {
  height: max-content;
  display: flex;
  justify-content: center;
  position: relative;

  &--grid {
    display: flex;
    justify-content: space-evenly;
    max-width: 1400px;
    z-index: 1;
    flex: 1;
  }
}

.image {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 20px;

  @media screen and (max-width: 1149px) {
    display: none;
  }
}

.line {
  height: 322px;
  background-color: #F2F5FB;
  display: flex;
  justify-content: center;
  width: 100%;
  top: 50%;
  transform: translateY(-50%);
  position: absolute;
}

.cart {
  width: 564px;
  max-width: 100%;
  margin-top: 24px;
  border-radius: 8px;
  border: 1px solid #F2F2F2;
  box-shadow: 0px 0px 15px 0px #00000014;
  padding: 40px;
  display: flex;
  margin-bottom: 40px;
  background-color: white;
  color: black;
}

.cart.cart--form {
  @media screen and (max-width: 639px) {
    width: calc(100% - 60px);
  }
}
</style>