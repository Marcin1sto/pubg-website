import {defineStore} from 'pinia';
import type {LocationQueryValue} from "vue-router";
import {createIPXH3Handler} from "ipx";

interface UserPayloadInterface {
  email: string;
  password: string;
  phone: string;
  policy: boolean;
  accept_courier: boolean;
  "g-recaptcha-response": string;
}

interface UserLoginInterface {
  email: string;
  password: string;
}

const {getApiRoute} = useApiRoutes();
export const useAuthStore = defineStore('auth', {
  persist: true,
  state: () => ({
    authenticated: false,
    isSemiUser: false,
    userSessionId: null,
    responseError: toRef(false),
    responseMessage: '',
    passwordRemembered: toRef(false),
    loading: false,
    loginBarMessage: '',
  }),
  actions: {
    startLoadingAsyncData() {
      this.loading = true;
      setTimeout(() => {
        this.loading = false;
      }, 4000);
    },
    checkIfUserIsAuthenticated() {
      const token = useCookie('token'); // get token from cookies

      if (token.value) {
        this.authenticated = true; // update the state to authenticated
      }
    },
    async sendNewPassword(rememberHash: string | LocationQueryValue[]) {
      const {data, pending, error}: any = await useTheFetch(getApiRoute('auth.sendNewPassword'), {
        method: 'POST',
        body: {
          rememberHash: rememberHash,
        }
      });
    },
    async authenticateUser(request: UserLoginInterface) {
      const {data, pending, error}: any = await useTheFetch(getApiRoute('auth.login'), {
        method: 'POST',
        body: {
          auth: {
            login: request.email,
            password: request.password
          },
          'g-recaptcha-response': request['g-recaptcha-response'] ?? '',
        }
      });

      if (data.value.success) {
        const token = useCookie('token');
        token.value = request.email + '/' + data?.value?.data.sess_id;
        this.authenticated = true;
        this.isSemiUser = data.value.data.is_semi_user;
        this.userSessionId = data.value.data.sess_id;
        this.responseError = false;
        this.responseMessage = '';
      } else {
        this.responseError = true;
        this.responseMessage = data.value.data.message ?? data.value.message;
        this.loading = false;
      }

    },
    async registerUser(request: UserPayloadInterface) {
      let requestBody = {
        email: request.email,
        password: request.password,
        phone: request.phone,
        accept: request.policy,
        accept_courier: request.accept_courier,
        "g-recaptcha-response": request["g-recaptcha-response"]
      };

      const config = useRuntimeConfig();
      const registerUseSmsVerification = config.public.REGISTER_USE_SMS_VERIFICATION === 'true';
      if (registerUseSmsVerification) {
        requestBody['sms_code'] = request.sms_code;
      }

      const {data, pending, error}: any = await useTheFetch(getApiRoute('auth.register'), {
        method: 'POST',
        body: requestBody,
      });

      if (error?.value) {
        if (typeof error.value.data === 'string') {
          data.value = JSON.parse(error.value.data)
        }

        if (typeof error.value.data === 'object') {
          data.value = error.value.data
        }
      }

      if (data.value.success) {
        this.responseError = false;
        this.responseMessage = '';
      } else {
        this.responseError = true;
        this.responseMessage = data.value.message ?? data.value.error;
      }

      return data.value;
    },
    async rememberPassword(state: string) {
      const {data, pending, error}: any = await useTheFetch(getApiRoute('auth.rememberPassword'), {
        method: 'POST',
        body: {
          User: {
            email: state.email
          },
          "g-recaptcha-response": state["g-recaptcha-response"]
        },
      });

      if (error?.value) {
        data.value = error.value.data
      }

      if (data?.value) {
        this.responseError = !data?.value.success;
        this.responseMessage = data?.value.message;
        this.loginBarMessage = data?.value.message;
        return data.value;
      }
    },
    async setNewToken(token: string) {
        const tokenCookie = useCookie('token');
        tokenCookie.value = token;
    },
    async logout() {
      const token = useCookie('token');
      const {userProfile} = storeToRefs(useUserStore());

      const {data, pending, error}: any = await useTheFetch(getApiRoute('auth.logout'), {
        method: 'POST',
        body: {
          auth: {
            login: userProfile?.value?.email,
            sess_id: token.value,
          }
        },
      });

      const auth = useCookie('auth');
      auth.value = null;
      const userCookie = useCookie('user');
      userCookie.value = null;

      this.authenticated = false;
      this.userSessionId = null;
      useUserStore().resetProfile();
      token.value = null;
      return true;
    },
  },
}, );