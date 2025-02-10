<script setup lang="ts">

const props = defineProps({
  disabled: {
    type: Boolean,
    default: false
  },
  byShortName: {
    type: String,
    default: null
  }
})

const selectedCountry = ref({
  "name": "Polska",
  "shortName": "PL",
  "fileName": "Polska.png"
})
const isOpen = ref(false);
const emit = defineEmits(['change'])
const countries = [
  {
    "name": "Polska",
    "shortName": "PL",
    "fileName": "Polska.png"
  },
  {
    "name": "Austria",
    "shortName": "AT",
    "fileName": "Austria.png"
  },
  {
    "name": "Belgia",
    "shortName": "BE",
    "fileName": "Belgia.png"
  },
  {
    "name": "Bułgaria",
    "shortName": "BG",
    "fileName": "Bułgaria.png"
  },
  {
    "name": "Chorwacja",
    "shortName": "HR",
    "fileName": "Chorwacja.png"
  },
  {
    "name": "Czechy",
    "shortName": "CZ",
    "fileName": "Czechy.png"
  },
  {
    "name": "Dania",
    "shortName": "DK",
    "fileName": "Dania.png"
  },
  {
    "name": "Estonia",
    "shortName": "EE",
    "fileName": "Estonia.png"
  },
  {
    "name": "Finlandia",
    "shortName": "FI",
    "fileName": "Finlandia.png"
  },
  {
    "name": "Francja",
    "shortName": "FR",
    "fileName": "Francja.png"
  },
  {
    "name": "Germany",
    "shortName": "DE",
    "fileName": "Germany.png"
  },
  {
    "name": "Grecja",
    "shortName": "GR",
    "fileName": "Grecja.png"
  },
  {
    "name": "Hiszpania",
    "shortName": "ES",
    "fileName": "Hiszpania.png"
  },
  {
    "name": "Holandia",
    "shortName": "NL",
    "fileName": "Holandia.png"
  },
  {
    "name": "Irlandia Pn",
    "shortName": "IE",
    "fileName": "irlandiapn.png"
  },
  {
    "name": "Kanada",
    "shortName": "CA",
    "fileName": "Kanada.png"
  },
  {
    "name": "Litwa",
    "shortName": "LT",
    "fileName": "Litwa.png"
  },
  {
    "name": "Luksemburg",
    "shortName": "LU",
    "fileName": "Luksemburg.png"
  },
  {
    "name": "Monako",
    "shortName": "MC",
    "fileName": "Monako.png"
  },
  {
    "name": "Norwegia",
    "shortName": "NO",
    "fileName": "Norwegia.png"
  },
  {
    "name": "Portugalia",
    "shortName": "PT",
    "fileName": "Portugalia.png"
  },
  {
    "name": "Rumunia",
    "shortName": "RO",
    "fileName": "Rumunia (2).png"
  },
  {
    "name": "Szwajcaria",
    "shortName": "CH",
    "fileName": "Szwajcaria.png"
  },
  {
    "name": "Szwecja",
    "shortName": "SE",
    "fileName": "Szwecja.png"
  },
  {
    "name": "Słowacja",
    "shortName": "SK",
    "fileName": "Słowacja.png"
  },
  {
    "name": "Słowenia",
    "shortName": "SI",
    "fileName": "Słowenia.png"
  },
  {
    "name": "USA",
    "shortName": "US",
    "fileName": "USA.png"
  },
  {
    "name": "Watykan",
    "shortName": "VA",
    "fileName": "Watykan.png"
  },
  {
    "name": "Wielka Brytania",
    "shortName": "GB",
    "fileName": "Wielka Brytania.png"
  },
  {
    "name": "Węgry",
    "shortName": "HU",
    "fileName": "Węgry.png"
  },
  {
    "name": "Włochy",
    "shortName": "IT",
    "fileName": "Włochy.png"
  },
  {
    "name": "Łotwa",
    "shortName": "LV",
    "fileName": "Łotwa.png"
  }
];
import {onClickOutside} from "@vueuse/core";

// const selectedCountry = ref({});
const selectCountry = (country) => {
  selectedCountry.value = country;
  isOpen.value = false;

  emit('countryChange', country);
};
const target = ref(null);
const clickOutside = (e) => {
  if (!isOpen.value) return;

  if (!e.target.closest('.calc_countryList')) {
    isOpen.value = false;
  }
}
onClickOutside(target, event => clickOutside(event));

const toggle = () => {
  if (props.disabled) return;

  isOpen.value = !isOpen.value;
}

onMounted(() => {
  if (props.byShortName !== 'PL') {
    const country = countries.find(country => country.shortName === props.byShortName);
    if (country) {
      selectCountry(country);
    }
  }
})

watch(() => props.byShortName, (newVal) => {
  if (newVal) {
    const country = countries.find(country => country.shortName === newVal);
    if (country) {
      selectCountry(country);
    }
  }
})
</script>

<template>
  <div ref="target" class="calc_inputContainer calc_inputContainer--chooseCountry" :class="disabled ? 'calc_inputContainer--disabled' : ''">
    <span class="calc_label">Kraj</span>

    <div class="calc_countryButton" :class="isOpen ? 'calc_countryButton--open' : ''" @click="toggle">
      <span class="calc_countryButtonFlag" :class="disabled ? 'calc_countryButtonFlag--disabled' : ''">
        <NuxtImg v-if="selectedCountry.fileName" :src="'icons/selectCountry/countries/' + selectedCountry.fileName" width="20px" height="16px" class="calc_countryButtonFlagImg"/>
      </span>

      <span class="calc_countryButtonArrow" v-show="!disabled">
        <NuxtImg v-if="!isOpen" src="icons/selectCountry/arrowDown.png" width="23px" height="23px"/>
        <NuxtImg v-else src="icons/selectCountry/arrowUp.png" width="23px" height="23px"/>
      </span>

      <span class="calc_countryButtonArrow" v-show="disabled">
        <span class="calc_countryListName">PL</span>
      </span>
    </div>

    <ul class="calc_countryList" :class="isOpen ? 'calc_countryList--open' : ''">
      <li class="calc_countryListItem" v-for="country in countries" :key="country.name" @click.prevent="selectCountry(country)">
        <input type="radio" id="radio20" name="country" value="" class="calc_countryListRadio" />
        <label for="radio20" class="calc_countryListLabel">
                    <span class="calc_countryListFlag">
                      <NuxtImg :src="'icons/selectCountry/countries/' + country.fileName" width="20px" height="16px" class="calc_countryButtonFlagImg"/>
                    </span>
          <span class="calc_countryListName">{{ country.shortName }}</span>
        </label>
      </li>
    </ul>
  </div>
</template>

<style scoped>

</style>