<script setup lang="ts">
import useC2CStore from "~/stores/useC2CStore";

const { isC2C } = storeToRefs(useC2CStore());

const questionsB2B = ref([
  {
    title: 'Czym jest BLPaczka?',
    description: 'BLPaczka to platforma logistyczna specjalizująca się w dostawach palet oraz paczek zarówno w kraju, jak i za granicę. Współpracujemy z zaufanymi partnerami logistycznymi, co pozwala nam zagwarantować wysoką jakość usług. Nasze usługi są dedykowane dla klientów biznesowych.',
    isOpen: true
  },
  {
    title: 'Jakie korzyści oferuje BLPaczka?',
    description: '1) <strong>Brak umów i minimum logistycznego</strong>: Nie musisz podpisywać żadnych umów, aby korzystać z naszych usług. Dzięki temu możesz elastycznie dostosować swoje potrzeby logistyczne bez zobowiązań. <br> 2) <strong>Szeroka gama firm kurierskich</strong>: Współpracujemy z kluczowymi partnerami logistycznymi, co pozwala na wybór najbardziej odpowiedniego przewoźnika pod względem ceny, czasu dostawy i specyficznych wymagań przesyłki. <br> 3) <strong>Wysoka jakość usług</strong>: Dzięki współpracy z zaufanymi partnerami logistycznymi, możemy zagwarantować wysoką jakość usług, terminowość oraz bezpieczeństwo przesyłek. <br> 4) <strong>Szeroki zakres usług</strong>: Oferujemy zarówno przesyłki paletowe, jak i dostawy paczek w kraju i za granicąi, co pozwala na kompleksowe zarządzanie logistyką Twojej firmy.',
    isOpen: false
  },
  {
    title: 'Czy jest możliwe nadawanie przesyłek za pomocą BLPaczki bez posiadania konta w BaseLinker?',
    description: 'Przesyłkę można nadać bezpośrednio z panelu użytkownika po zalogowaniu na blpaczka.com. Dostępne są również wtyczki oraz możliwość bezpośredniego połączenia z naszym API. Szczegóły na temat tych opcji znajdziesz w zakładce "Usprawnienia" po zalogowaniu.',
    isOpen: false
  },
  {
    title: 'Jak rozpocząć współpracę z BLPaczka?',
    description: 'Aby korzystać z BLPaczki, wystarczy zarejestrować się na naszej platformie lub dodać wtyczkę w BaseLinker (dotyczy wyłącznie klientów biznesowych, dla których korzystanie z platformy ma charakter zawodowy). Po rejestracji będziesz miał dostęp do naszych usług, szczegółowej oferty oraz opcji nadawania przesyłek. Jeśli masz jakiekolwiek pytania, nasz zespół obsługi klienta jest zawsze gotowy do pomocy pod adresem: <a href="mailto:info@blpaczka.com" class="question--link">info@blpaczka.com</a> oraz numerem telefonu: <a href="tel:+48 564 753 193" class="question--link">+48 56 475 31 93</a>',
    isOpen: false
  },
  {
    title: 'Jakie usługi logistyczne oferuje BLPaczka?',
    description: 'BLpaczka oferuje szeroki zakres usług zarówno w przypadku przesyłek krajowych jak i zagranicznych. Wprowadziliśmy również własną usługę przesyłek “BLPaczka Cross-Border” która pozwoliła w jeszcze większym stopniu zoptymalizować koszty przesyłek naszych klientów. Obsługujemy również przesyłki niestandardowe jak np. Meble.',
    isOpen: false
  },
  {
    title: 'Jak nadać pierwszą paczkę?',
    description: 'Przesyłkę możesz nadać bezpośrednio ze swojego panelu po zalogowaniu na blpaczka.com. Możesz również skorzystać z naszych wtyczek lub bezpośredniego połączenia z naszym API (nie dotyczy konsumentów/przedsiębiorców na prawach konsumenta – tacy klienci mogą nadać przesyłkę wyłącznie po zalogowaniu się do konta w ramach blpaczka.com). Jeżeli jesteś przedsiębiorcą, więcej szczegółów dotyczących tych dodatkowych opcji znajdziesz w zakładce „Usprawnienia” po zalogowaniu.',
    isOpen: false
  },
])

const questionsC2C = ref([
  {
    title: 'Jak działa BLPaczka?',
    description: '<strong>BLPaczka</strong> to platforma logistyczna, która umożliwia wygodne i szybkie nadawanie paczek oraz przesyłek o nietypowych wymiarach na terenie całej Polski. Dzięki współpracy z zaufanymi firmami kurierskimii możemy zagwarantować wysoką jakość usług, atrakcyjne ceny i terminowe dostawy. Nasza oferta jest dostosowana do potrzeb klientów indywidualnych, którzy cenią sobie bezpieczeństwo, oszczędność i niezawodność w przesyłkach krajowych. ',
    isOpen: true
  },
  {
    title: 'Jakie korzyści oferuje BLPaczka?',
    description: '1) <strong>Bez umów i zobowiązań</strong>: Współpracujemy z wiodącymi firmami kurierskimi, dzięki czemu możesz wybrać przewoźnika, który najlepiej odpowiada Twoim potrzebom – pod względem ceny, czasu dostawy i rodzaju przesyłki. <br> 3) <strong>Gwarancja jakości i bezpieczeństwa</strong>: Dzięki współpracy ze sprawdzonymi firmami kurierskimi m.in. InPost, ORLEN Paczka, DPD czy DHL zapewniamy terminowe dostawy i pełne bezpieczeństwo Twoich przesyłek. <br> 4) <strong>Przesyłki dostosowane do Twoich potrzeb</strong>: Oferujemy zarówno przesyłki paczkowe, jak i o nietypowych rozmiarach na terenie całej Polski. Niezależnie od wielkości przesyłki, możesz liczyć na naszą kompleksową obsługę.',
    isOpen: false
  },
  {
    title: 'Jak nadać paczkę w BLPaczka?',
    description: 'Nadanie paczki z BLPaczka jest szybkie i proste! Załóż bezpłatne konto na stronie  <a href="https://blpaczka.com/rejestracja" class="question--link">https://blpaczka.com/rejestracja</a>, uzupełnij swoje dane, a następnie przejdź do procesu nadawania przesyłki w panelu użytkownika. W zakładce “Nadaj paczkę” po wypełnieniu danych przesyłki zobaczysz porównanie dostępnych kurierów. Po dokonaniu płatności będzie dostępna etykieta do pobrania w panelu klienta. <br> Nadaj paczkę w kilku prostych krokach i ciesz się wygodą wysyłki z BLPaczka!',
    isOpen: false
  },
  {
    title: 'Jakie usługi logistyczne oferuje BLPaczka?',
    description: 'BLPaczka oferuje szeroki zakres usług dla klientów indywidualnych, umożliwiając wygodne nadawanie przesyłek krajowych. Dzięki naszej ofercie możesz łatwo wysłać zarówno standardowe paczki, jak i o większych rozmiarach, takie jak np. meble czy opony. Dbamy o to, aby Twoje przesyłki były dostarczane szybko, bezpiecznie i w atrakcyjnej cenie. Współpracujemy z zaufanymi przewoźnikami, co pozwala nam optymalizować koszty i oferować korzystne warunki wysyłki.',
    isOpen: false
  }
])

definePageMeta({
  middleware: 'default-layout',
})
</script>

<template>
  <div class="container page_header">
    <h1 class="page_header--title">Pytania i odpowiedzi</h1>
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

  margin-bottom: 40px;
  background-color: white;
  color: black;

  @media screen and (max-width: 1000px) {
    gap: 24px;
  }
}
</style>