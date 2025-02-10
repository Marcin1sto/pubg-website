import {defineStore} from 'pinia';
const {getApiRoute} = useApiRoutes();

export const useCountriesStore = defineStore('countries', {
state: () => ({
    countries: [],
    countriesLoading: false,
  }),
  actions: {
    setCountries(countries) {
      this.countries = countries;
    },
    async fetchCountries() {
      this.countriesLoading = true;

      if (this.countries.length > 0) {
        this.countriesLoading = false;
        return;
      }

      const {data, pending, error}: any = await useTheFetch(getApiRoute('countries'));

      if (error?.value) {
        data.value = JSON.parse(error.value.data)
        this.countriesLoading = false;
      } else {
        data.value = JSON.parse(data.value)
      }

      if (data.value.success) {
        this.setCountries(data.value.data);
        this.countriesLoading = false;
      }
    }
  }
})