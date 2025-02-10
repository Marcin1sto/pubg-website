import {defineStore} from 'pinia';
import usePreOrderStore from "~/stores/panel/usePreOrderStore";
import {useReCaptcha} from "vue-recaptcha-v3";

const { getApiRoute, formatApiGetRoute } = useApiRoutes();
const useUserStore = defineStore('user', {
  persist: true,
  state: () => ({
    userProfile: {},
    userExternalData: {},
    balance: "0,00",
    isFulfill: false,
    loading: false,
    verificationSmsResponse: {},
    verificationSmsErrorMessage: '',
    paymentOptions: [],
    panel_top_images_visible: true,
    panel_top_txt_banner_visible: true,
  }),
  actions: {
    startLoadingAsyncData() {
      this.loading = true;
      setTimeout(() => {
        this.loading = false;
      }, 1000);
    },
    resetProfile() {
      this.userProfile = {};
      this.balance = "0,00";
      this.userExternalData = {};
      this.isFulfill = false;
      this.panel_top_images_visible = true;
      this.panel_top_txt_banner_visible = true;
    },
    formatBalance() {
      return this.balance.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    },
    formatCreditSaldo() {
      return this.userExternalData?.Broker?.credit_saldo.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") ?? null;
    },
    async saveUserProfile(state: object) {
      let link = getApiRoute('user.update');
      const { isSemiUser } = storeToRefs(useAuthStore());

      if (isSemiUser.value) {
        link = getApiRoute('user.updateSemiUser');
      }

      const {data, pending, error}: any = await useTheFetch(link, {
        method: 'POST',
        body: {
          ...state
        }
      });

      if (error?.value) {
        data.value = error.value.data
      }

      if (data.value.success) {
        this.userProfile = data.value.data;
      }

      return data.value;
    },
    async saveApiKey(apiKey: string) {
      const {data, pending, error}: any = await useTheFetch(getApiRoute('user.saveApiKey'), {
        method: 'POST',
        body: {
          User: {
            api_key: apiKey
          }
        }
      });

      if (error?.value) {
        data.value = error.value.data
      }

      return data.value;
    },
    async sendForUserVerificationSMS(request) {
      let route = getApiRoute('user.sendSmsApi');
      const {data, pending, error}: any = await useTheFetch(route, {
        method: 'POST',
        body: request
      });

      if (error?.value) {
        this.verificationSmsResponse = {
          success: false,
          message: 'Wystąpił błąd podczas wysyłania SMS'
        }
      }

      if (data.value.success) {
        this.verificationSmsResponse = {
          success: true,
          message: data.value.message
        }
      } else {
        if (data.value.message) {
          this.verificationSmsErrorMessage = {
            success: false,
            message: data.value.message
          }

          this.verificationSmsResponse = {
            success: false,
            message: data.value.message
          }
        }
      }
    },
    async fetchGusData(vat_nip) {
      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('user.gus', { nip: vat_nip }), {
        method: 'GET',
      });

      if (error?.value) {
        console.error('Wystąpił błąd podczas ładowania danych z gus')
        return error.value.data
      }

      if (data.value.success) {
        return data.value;
      }
    },
    async updateGusData() {
      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('user.gusUpdate', {}), {
        method: 'GET',
      });

      if (error?.value) {
        console.error('Wystąpił błąd podczas ładowania danych z gus')
        return error.value.data
      }

      if (data.value.success) {
        return data.value;
      }
    },
    async resetUserPassword(request) {
      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('user.resetUserPassword', {}), {
        method: 'POST',
        body: request
      });

      if (error?.value) {
        return error.value.data
      }

      if (data.value.success) {
        return data.value;
      }
    },
    async getUserBalance() {
      const {data, pending, error}: any = await useTheFetch(getApiRoute('user.balance'), {
        method: 'GET',
      });

      if (error?.value) {
        console.error('Wystąpił błąd podczas ładowania salda')
        return false;
      }

      if (data.value.success) {
        this.balance = data.value.data.bank_saldo;
        return true;
      }
    },
    async fetchPaymentOptions() {
      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('user.paymentOptions', {}), {
        method: 'GET',
      });

      if (error?.value) {
        return error.value.data
      }

      if (data.value.success) {
        this.paymentOptions = data.value.data.payments;
      }
    },
    async getExternalUserData() {
      let link = getApiRoute('user.profile');
      const { isSemiUser } = storeToRefs(useAuthStore());

      if (isSemiUser.value) {
        link = getApiRoute('user.getProfileSemiUser');
      }


      const { getPreOrder } = usePreOrderStore();
      const {data, pending, error}: any = await useTheFetch(link, {
        method: 'get'
      });

      if (error?.value) {
        return false;
      }

      if (data.value?.success) {
        this.userExternalData = data.value.data;
        const { isSemiUser } = storeToRefs(useAuthStore());

        if (!isSemiUser.value) {
          await getPreOrder();
          await this.fetchPaymentOptions();
        }

        return data.value;
      }
    },
  },
  getters: {
    getUseFullAddress() {
      return this.userExternalData?.Broker?.vat_street +
      ' ' + this.userExternalData?.Broker?.vat_house_no + (this.userExternalData?.Broker?.vat_locum_no ? '/' + this.userExternalData?.Broker?.vat_locum_no : '') +
        ', ' + this.userExternalData?.Broker?.vat_postal + ' ' + this.userExternalData?.Broker?.vat_city;
    }
  }
});

export default useUserStore;