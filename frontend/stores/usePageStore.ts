import {defineStore} from "pinia";
import useNotificationsStore from "~/stores/panel/useNotificationsStore";
import usePreOrderStore from "~/stores/panel/usePreOrderStore";

const usePageStore = defineStore('page', {
  state: () => ({
    pageName: '',
    isRequiredMessage: false,
    forceCloseMenu: false,
    successMessageShow: false,
    successMessage: {
      title: '',
      message: '',
    },
    errorMessageShow: false,
    errorMessage: {
      title: '',
      message: '',
    },
  }),
  actions: {
    setPageValues(name: string, forceCloseMenu: boolean = false) {
      this.pageName = name
      this.forceCloseMenu = forceCloseMenu

      if (!this.isRequiredMessage) {
        this.successMessageShow = false
        this.errorMessageShow = false

        this.errorMessage = {
          title: '',
          message: '',
        }
        this.successMessage = {
          title: '',
          message: '',
        }
      }

      if (forceCloseMenu) {
        const { toggleMenu } = useLeftMenuStore();
        toggleMenu()
      }

      const { getNotificationsCount } = useNotificationsStore();
      getNotificationsCount()

      const { getPreOrder } = usePreOrderStore();
      const { isSemiUser } = storeToRefs(useAuthStore());
      if (!isSemiUser.value) {
        getPreOrder()
      }
    },
  },
  getters: {
    getPageName() {
      return this.pageName
    },
    isDevelopment() {
      const config = useRuntimeConfig();
      return config.public.APP_ENV === 'development'
    }
  },
})

export default usePageStore;