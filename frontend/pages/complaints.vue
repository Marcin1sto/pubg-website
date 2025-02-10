<script setup lang="ts">
import useC2CStore from "~/stores/useC2CStore";

const { isC2C } = storeToRefs(useC2CStore());

const questionsB2B = ref([
  {
    title: 'Jak długo trwa proces reklamacji u przewoźnika?',
    description: 'Przekażemy otrzymaną od Ciebie reklamację usługi przewozu do przewoźnika, z którego usług skorzystałeś/-aś. Szczegóły dotyczące tego procesu znajdziesz w naszym Regulaminie. Przewoźnik rozpatrzy Twoją reklamację w terminie przewidzianym w swoim regulaminie, ale nie dłuższym niż wynikający z przepisów prawa (tj. zwykle w terminie 30 dni od wpływu reklamacji do przewoźnika, przy czym w przypadkach określonych w przepisach prawa ten termin może zostać wydłużony). Zachęcamy naszych przewoźników do skrócenia tego czasu. Szczegółowe informacje dotyczące procesu rozpatrywania reklamacji znajdziesz w regulaminie wybranego przez Ciebie przewoźnika. Nasz Dział Obsługi Klienta będzie regularnie informował Cię o statusie sprawy. Po otrzymaniu od przewoźnika odpowiedzi na Twoją reklamację, niezwłocznie przekażemy Ci wiadomość o jej wyniku.',
    isOpen: true
  },
  {
    title: 'Jak mogę zgłosić reklamację dotyczącą uszkodzonej paczki?',
    description: 'Proces reklamacyjny jest prosty i bezproblemowy, dzięki kompleksowej pomocy działu Obsługi Klienta. Na stronie <a href="blpaczka.com" class="question--link">blpaczka.com</a> w zakładce “Zamówienia - historia paczek” znajdziesz przycisk "Reklamacja", który przeniesie Cię do częściowo wypełnionego formularza reklamacyjnego. Wystarczy, że uzupełnisz resztę danych i dołączysz potrzebne dokumenty (protokół szkody, potwierdzenie wartości przesyłki, zdjęcia uszkodzeń, opis szkody), a my zajmiemy się resztą. Po otrzymaniu zgłoszenia przekażemy go do odpowiedniego przewoźnika, który zajmie się dalszym procesem reklamacyjnym. Korzystanie z formularza przyspiesza rozpatrzenie reklamacji oraz pozwala na śledzenie statusu zgłoszenia.',
    isOpen: false
  },
  {
    title: 'Co zrobić, jeśli paczka nie została dostarczona?',
    description: 'Jeśli Twoja paczka nie dotarła w ustalonym terminie, nie martw się - nasz dział Obsługi Klienta jest gotowy do podjęcia natychmiastowych działań. Wystarczy, że skontaktujesz się z nami i prześlesz potwierdzenie wartości paczki. Jeśli minęło już 30 dni od nadania przesyłki, złożymy reklamację do przewoźnika i będziemy Cię regularnie informować o postępach sprawy. Naszym celem jest zapewnienie Ci kompleksowej obsługi i szybkiego rozwiązania problemu, dlatego możesz mieć pewność, że zrobimy wszystko, co w naszej mocy, aby Twoja paczka została odnaleziona lub zrekompensowana.',
    isOpen: false
  },
  {
    title: 'Czy mogę śledzić status mojej reklamacji?',
    description: 'Status reklamacji możesz śledzić,, logując się na Panelu Klienta na naszej stronie internetowej. W sekcji "Reklamacje" znajdziesz aktualne informacje dotyczące postępu reklamacji. Ponadto, będziemy na bieżąco informować Cię drogą mailową o wszelkich zmianach i decyzjach związanych ze zgłoszeniem.',
    isOpen: false
  },
  {
    title: 'Jakie wsparcie oferujemy w zakresie reklamacji?',
    description: 'Zapewniamy kompleksowe wsparcie w zakresie reklamacji, aby cały proces był dla Ciebie prosty i komfortowy Nasz zespół obsługi klienta jest dostępny, aby pomóc Ci w każdym etapie procesu reklamacyjnego. Wystarczy, że zalogujesz się na <a href="blpaczka.com" class="question--link">blpaczka.com</a>, przejdziesz do zakładki "Zamówienia - historia paczek" i skorzystasz z prostego, częściowo wypełnionego formularza. Uzupełnij go dołącz potrzebne dokumenty, a my zajmiemy się dalszymi krokami. Przekażemy Twoje zgłoszenie do odpowiedniego przewoźnika i będziemy Cię na bieżąco informować o statusie sprawy, zapewniając szybkie i skuteczne rozwiązanie.',
    isOpen: false
  },
]);

const questionsC2C = ref([
  {
    title: 'Jak długo trwa proces reklamacji u przewoźnika?',
    description: 'Przekażemy otrzymaną od Ciebie reklamację usługi przewozu do przewoźnika, z którego usług skorzystałeś/-aś. Szczegóły dotyczące tego procesu znajdziesz w naszym <a href="https://blpaczka.com/regulations" class="question--link">Regulaminie</a>. Przewoźnik rozpatrzy Twoją reklamację w terminie przewidzianym w swoim regulaminie, ale nie dłuższym niż wynikający z przepisów prawa (tj. zwykle w terminie 30 dni od wpływu reklamacji do przewoźnika, przy czym w przypadkach określonych w przepisach prawa ten termin może zostać wydłużony). Zachęcamy naszych przewoźników do skrócenia tego czasu. Szczegółowe informacje dotyczące procesu rozpatrywania reklamacji znajdziesz w regulaminie wybranego przez Ciebie przewoźnika. Nasz Dział Obsługi Klienta będzie regularnie informował Cię o statusie sprawy. Po otrzymaniu od przewoźnika odpowiedzi na Twoją reklamację, niezwłocznie przekażemy Ci wiadomość o jej wyniku.',
    isOpen: true
  },
  {
    title: 'Jak mogę zgłosić reklamację dotyczącą uszkodzonej paczki?',
    description: 'Proces reklamacyjny jest szybki i wygodny dzięki wsparciu naszego Działu Obsługi Klienta. Po zalogowaniu do panelu BLPaczki w zakładce "Historia Paczek" znajdziesz przycisk "Reklamacja", który przeniesie Cię do częściowo wypełnionego formularza. Wystarczy uzupełnić brakujące dane, dołączyć wymagane dokumenty (np. protokół szkody, potwierdzenie wartości przesyłki, zdjęcia uszkodzeń, opis szkody), a my zajmiemy się resztą. Po otrzymaniu zgłoszenia przekażemy je do przewoźnika, który przeprowadzi dalszy proces reklamacyjny. Pamiętaj, że reklamację dotyczącą uszkodzenia przesyłki należy zgłosić w ciągu 7 dni od daty doręczenia paczki.',
    isOpen: false
  },
  {
    title: 'Co zrobić, jeśli paczka nie została dostarczona?',
    description: 'Jeśli Twoja paczka nie została doręczona do odbiorcy, skontaktuj się z nami i prześlij potwierdzenie jej wartości. Skontaktujemy się niezwłocznie z przewoźnikiem za pośrednictwem, którego została nadana paczka. W sytuacji, gdy minęło 30 dni od nadania przesyłki, złożymy reklamację do przewoźnika. Będziemy Cię na bieżąco informować o postępach sprawy. Naszym celem jest zapewnienie pełnej obsługi i szybkiego rozwiązania problemu, dlatego możesz być pewny, że zrobimy wszystko, co w naszej mocy, aby paczka została odnaleziona lub zrekompensowana.',
    isOpen: false
  },
  {
    title: 'Jakie wsparcie oferujemy w zakresie reklamacji?',
    description: 'Zapewniamy kompleksowe wsparcie w zakresie reklamacji, aby cały proces był dla Ciebie prosty i komfortowy. Nasz dział obsługi klienta jest dostępny od poniedziałku do piątku w godzinach 9-17, aby pomóc Ci na każdym etapie procesu reklamacyjnego. Wystarczy, że po zalogowaniu do panelu BLPaczki w zakładce "Historia Paczek" znajdziesz przycisk "Reklamacja", który przeniesie Cię do częściowo wypełnionego formularza. Uzupełnij go, dołącz potrzebne dokumenty, a my zajmiemy się dalszymi krokami. Przekażemy Twoje zgłoszenie do odpowiedniego przewoźnika i będziemy Cię na bieżąco informować o statusie sprawy, zapewniając szybkie i skuteczne rozwiązanie.',
    isOpen: false
  },
])

definePageMeta({
  middleware: 'default-layout',
})
</script>

<template>
  <div class="container page_header">
    <h1 class="page_header--title">Reklamacje</h1>
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