<template>
  <div class="contact_container">
    <div class="contact_buttons">
      <div class="contact_button" :class="sections.contact ? 'contact_button--active' : ''" @click="toggleSection('contact')">
        <svg width="35" height="26" viewBox="0 0 35 26" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
              d="M28.2727 1V1.54545C28.2727 2.26877 27.9854 2.96246 27.4739 3.47393C26.9625 3.98539 26.2688 4.27273 25.5455 4.27273C24.8221 4.27273 24.1284 3.98539 23.617 3.47393C23.1055 2.96246 22.8182 2.26877 22.8182 1.54545V1H11.9091V1.54545C11.9091 2.26877 11.6218 2.96246 11.1103 3.47393C10.5988 3.98539 9.90514 4.27273 9.18182 4.27273C8.4585 4.27273 7.76481 3.98539 7.25335 3.47393C6.74188 2.96246 6.45455 2.26877 6.45455 1.54545V1H1V25H33.7273V1H28.2727Z"
              stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
              stroke-linejoin="round"/>
          <path d="M20.6367 9.72656H29.364M20.6367 14.0902H29.364M20.6367 18.4538H25.0004" stroke="currentColor"
                stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
          <path
              d="M10.8176 14.0962C12.6251 14.0962 14.0904 12.631 14.0904 10.8235C14.0904 9.01603 12.6251 7.55078 10.8176 7.55078C9.01017 7.55078 7.54492 9.01603 7.54492 10.8235C7.54492 12.631 9.01017 14.0962 10.8176 14.0962Z"
              stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
              stroke-linejoin="round"/>
          <path
              d="M10.8189 14.0898C10.0908 14.0969 9.37127 14.2483 8.70199 14.5351C8.03271 14.822 7.42695 15.2387 6.91972 15.7611C6.41249 16.2836 6.01387 16.9014 5.7469 17.5789C5.47993 18.2563 5.34991 18.98 5.36437 19.708V20.6353H16.2735V19.708C16.2879 18.98 16.1579 18.2563 15.8909 17.5789C15.624 16.9014 15.2253 16.2836 14.7181 15.7611C14.2109 15.2387 13.6051 14.822 12.9358 14.5351C12.2666 14.2483 11.547 14.0969 10.8189 14.0898Z"
              stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
              stroke-linejoin="round"/>
        </svg>
        <div>Kontakt</div>
      </div>
      <div class="contact_button"  :class="sections.form ? 'contact_button--active' : ''" @click="toggleSection('form')">
        <svg width="32" height="26" viewBox="0 0 32 26" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M31 7V1H1V7M31 7H1M31 7V25H1V7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round"/>
          <path d="M7 12H25M7 16H25M7 20H17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round"/>
          <path
              d="M4 4.5C4.27614 4.5 4.5 4.27614 4.5 4C4.5 3.72386 4.27614 3.5 4 3.5C3.72386 3.5 3.5 3.72386 3.5 4C3.5 4.27614 3.72386 4.5 4 4.5Z"
              stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path
              d="M7.5 4.5C7.77614 4.5 8 4.27614 8 4C8 3.72386 7.77614 3.5 7.5 3.5C7.22386 3.5 7 3.72386 7 4C7 4.27614 7.22386 4.5 7.5 4.5Z"
              stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path
              d="M11 4.5C11.2761 4.5 11.5 4.27614 11.5 4C11.5 3.72386 11.2761 3.5 11 3.5C10.7239 3.5 10.5 3.72386 10.5 4C10.5 4.27614 10.7239 4.5 11 4.5Z"
              stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <div>Formularz</div>
      </div>
    </div>
    <div class="cart" :style="sections.contact ? 'display: flex' : 'display:none'">

      <div class="contact_infoSection">
        <h3 class="title">Skontaktuj się z naszą obsługą klienta!</h3>
        <div class="contact_ContactInformation">
          <div>
            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                  d="M22.8371 18.2452L18.8457 15.6363C18.4456 15.3829 17.9631 15.2932 17.4985 15.3861C17.034 15.479 16.6231 15.7472 16.3512 16.1351C15.4685 17.2477 14.3171 19.0892 10.134 14.9074C5.95076 10.7256 7.75452 9.57461 8.86748 8.65384C9.25546 8.38205 9.52378 7.97128 9.61669 7.50688C9.7096 7.04248 9.61996 6.56014 9.36639 6.16009L6.75669 2.17008C6.41129 1.67133 5.95076 0.86566 4.87617 1.01912C3.80159 1.17258 1 2.74556 1 6.19845C1 9.65134 3.72483 13.8715 7.4475 17.593C11.1702 21.3144 15.3917 24 18.8074 24C22.223 24 23.8733 20.9308 23.9884 20.1635C24.1035 19.3962 23.336 18.5905 22.8371 18.2452Z"
                  stroke="#202020" stroke-width="1.7" stroke-miterlimit="10" stroke-linecap="round"
                  stroke-linejoin="round"/>
            </svg>
          </div>
          <a href="tel:+48 56 475 31 93" class="link">+48 56 475 31 93</a>
        </div>
        <div class="contact_ContactInformation" style="margin-bottom: 20px">
          <div>
            <svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1 1L12.5 11.5033L24 1" stroke="#202020" stroke-width="1.5" stroke-miterlimit="10"
                    stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M1 1H24V16.3333H1V1Z" stroke="#202020" stroke-width="1.5" stroke-miterlimit="10"
                    stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <a href="mailto:info@blpaczka.com" class="link">info@blpaczka.com</a>
        </div>
        <div class="contact_infoSection--information">
          <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 6.4L7.3 13L19 1" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10"
                  stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <span>Odpowiemy na maila <strong>w ciągu 24 godzin</strong></span>
        </div>
        <div class="contact_infoSection--information">
          <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 6.4L7.3 13L19 1" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10"
                  stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <span>Obieramy telefony <strong>pn-pt godz. 09.00 – 17.00</strong></span>
        </div>
        <div class="contact_infoSection--information">
          <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 6.4L7.3 13L19 1" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10"
                  stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <span>Zapewniamy <strong>pełne wsparcie</strong> w procesie zamówienia paczki</span>
        </div>
        <div class="contact_infoSection--information">
<!--          <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--            <path d="M1 6.4L7.3 13L19 1" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10"-->
<!--                  stroke-linecap="round" stroke-linejoin="round"/>-->
<!--          </svg>-->
          <span class="title title--noMarginBottom" style="margin-top: 38px;">Pomagamy jeszcze wydajniej nadawać przesyłki!</span>
        </div>
      </div>
      <div class="verticalBeam" v-if="userExternalData.AccountManager"></div>
      <div class="protector" v-if="userExternalData.AccountManager">
        <h3 class="title">Skontaktuj się z osobistym doradcą!</h3>
        <p class="description">Twój doradca przeprowadzi Cię przez proces nadania paczki oraz udzieli odpowiedzi na nurtujące pytania.</p>
        <div class="contact_protectorSection">
          <div class="protectorImage"><NuxtImg width="140px" height="140px" style="border-radius: 180px" :src="userExternalData.AccountManager.s3"/> </div>
          <div class="protectorInformation">
            <span class="protectorInformation--name">{{ userExternalData.AccountManager.username }}</span>
            <span class="protectorInformation--position">{{ userExternalData.AccountManager.job_position}}</span>
            <div class="protectorContactInformation">
              <div>
                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                      d="M22.8371 18.2452L18.8457 15.6363C18.4456 15.3829 17.9631 15.2932 17.4985 15.3861C17.034 15.479 16.6231 15.7472 16.3512 16.1351C15.4685 17.2477 14.3171 19.0892 10.134 14.9074C5.95076 10.7256 7.75452 9.57461 8.86748 8.65384C9.25546 8.38205 9.52378 7.97128 9.61669 7.50688C9.7096 7.04248 9.61996 6.56014 9.36639 6.16009L6.75669 2.17008C6.41129 1.67133 5.95076 0.86566 4.87617 1.01912C3.80159 1.17258 1 2.74556 1 6.19845C1 9.65134 3.72483 13.8715 7.4475 17.593C11.1702 21.3144 15.3917 24 18.8074 24C22.223 24 23.8733 20.9308 23.9884 20.1635C24.1035 19.3962 23.336 18.5905 22.8371 18.2452Z"
                      stroke="#202020" stroke-width="1.7" stroke-miterlimit="10" stroke-linecap="round"
                      stroke-linejoin="round"/>
                </svg>
              </div>
              <a :href="`tel:`+userExternalData.AccountManager.phone" class="link">{{ userExternalData.AccountManager.phone }}</a>
            </div>
            <div class="protectorContactInformation">
              <div>
                <svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1 1L12.5 11.5033L24 1" stroke="#202020" stroke-width="1.5" stroke-miterlimit="10"
                        stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M1 1H24V16.3333H1V1Z" stroke="#202020" stroke-width="1.5" stroke-miterlimit="10"
                        stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
              <a :href="'mailto:'+userExternalData.AccountManager.email" class="link">{{ userExternalData.AccountManager.email }}</a>
            </div>
          </div>
        </div>
        <div class="row">
          <span class="title title--noMarginBottom">Już teraz zapraszamy do kontaktu!</span>
        </div>
      </div>
    </div>
    <div class="cart" :style="sections.form ? 'display: flex' : 'display:none'">
      <FormContact />
    </div>
  </div>
</template>

<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";

const {t} = useI18n();
const {setPageValues} = usePageStore();
const sections = ref({
  contact: true,
  form: false,
  messages: false
});

const { userExternalData } = useUserStore();

const toggleSection = (section: string) => {
  Object.keys(sections.value).forEach((key) => {
    sections.value[key] = key === section;
  });
};

setPageValues(
    t('page.panel.contact.title'),
    false
);

useHead({
  title: t('page.panel.contact.title')
});

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>

<style scoped lang="scss">
.link {
  color: #262B44;
  text-decoration: none;
}

.toggleForm {
  display: flex;
  flex-direction: column;
  gap: 24px;
  text-align: left;
  margin-bottom: 20px;
  color: #262B44;

  &--button {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 16px;
  }
}

.verticalBeam {
  border: 2px solid #F2F2F2;
  width: 2px;

  @media screen and (max-width: 1600px) {
    width: 100%;
  }
}

.title {
  font-family: Open Sans;
  font-size: 23px;
  font-weight: 600;
  line-height: 23px;
  margin-bottom: 32px;
  color: #262B44;

  &--noMarginBottom {
    margin-bottom: 0;
  }
}

.description {
  font-family: Open Sans;
  font-size: 16px;
  font-weight: 400;
  line-height: 29px;
  color: #262B44;
}

.protector {
  max-width: 590px;

  .contact_protectorSection {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 40px;
    margin-top: 26px;
    margin-bottom: 39px;
    color: #262B44;

    @media screen and (max-width: 600px) {
      display: block;
    }


    .protectorInformation {
      display: flex;
      flex-direction: column;
      gap: 16px;
      font-family: Open Sans;
      font-size: 16px;
      font-weight: 400;
      line-height: 22px;
      color: #262B44;

      &--name {
        font-family: Open Sans;
        font-size: 16px;
        font-weight: 700;
        line-height: 22px;
        color: #262B44;
      }

      &--position {
        font-family: Open Sans;
        font-size: 16px;
        font-weight: 400;
        line-height: 21px;
        color: #262B44;
      }
    }

    .protectorContactInformation {
      display: flex;
      gap: 16px;
      align-items: center;
      font-family: Open Sans;
      font-size: 23px;
      font-weight: 600;
      line-height: 31px;
      color: #262B44;

      @media screen and (max-width: 720px) {
        font-size: 16px;
      }
    }
  }
}

.contact_ContactInformation {
  display: flex;
  gap: 16px;
  text-align: left;
  align-items: center;
  font-family: Open Sans;
  font-size: 23px;
  font-weight: 600;
  line-height: 31px;
  color: #262B44;
}

.contact_infoSection {
  display: flex;
  gap: 15px;
  //margin-top: 16px;
  flex-direction: column;


  &--information {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 10px;
    font-family: Open Sans;
    font-size: 16px;
    font-weight: 400;
    line-height: 22px;
    color: #262B44;

    &--bold {
      font-weight: 600;
    }
  }
}

.contact_buttons {
  display: flex;
  //justify-content: space-between;
  gap: 16px;
}

.contact_button {
  width: 140px;
  height: 90px;
  border-radius: 8px;
  border: 2px solid #F2F2F2;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  flex-direction: column;
  gap: 11px;
  cursor: pointer;

  &--active {
    color: #4285F4;
    border: 2px solid #4285F4;
  }
}

.contact_container {
  padding-inline: 32px;
}

.cart {
  margin-top: 24px;
  width: max-content;
  height: max-content;
  border-radius: 8px;
  border: 1px solid #F2F2F2;
  box-shadow: 0px 0px 15px 0px #00000014;
  padding: 40px;
  display: flex;
  gap: 70px;
  margin-bottom: 20px;

  @media screen and (max-width: 799px) {
    width: auto;
  }

  @media screen and (max-width: 1600px ) {
    flex-direction: column;
    gap: 24px;
  }
}
</style>