<template>
  <div class="container">
    <div class="row">
      <h1 class="signin_header signin_header--desktop">Logowanie do <NuxtImg src="icons/blpLogoMain.png" width="200px" height="50px" class="signin_headerImg" /></h1>
      <h1 class="signin_header signin_header--mobile">Logowanie</h1>
    </div>

    <div class="row row--centeredMobile row--centered row--signin row--signinWithBanner">
<!--      <div class="signin_card">-->
<!--        <nuxt-link-locale to="#" class="signin_ghostButton"><NuxtImg src="icons/signin/google.png" width="22px" height="22px" class="signin_ghostButtonImg" /> Zaloguj się przez Google</nuxt-link-locale>-->
<!--        <nuxt-link-locale to="#" class="signin_ghostButton"><NuxtImg src="icons/signin/apple.png" width="22px" height="27px" class="signin_ghostButtonImg" /> Zaloguj się przez Apple</nuxt-link-locale>-->
<!--        <nuxt-link-locale to="#" class="signin_ghostButton"><NuxtImg src="icons/signin/microsoft.png" width="22px" height="22px" class="signin_ghostButtonImg" /> Zaloguj się przez Microsoft</nuxt-link-locale>-->
<!--        <nuxt-link-locale to="#" class="signin_ghostButton"><NuxtImg src="icons/signin/allegro.png" width="22px" height="25px" class="signin_ghostButtonImg" /> Zaloguj się przez Allegro</nuxt-link-locale>-->
<!--      </div>-->

      <nuxt-link-locale :to="firstBanner.url" v-show="Object.keys(firstBanner).length > 0">
        <img width="565px" height="443px" :alt="firstBanner?.container_name" :src="firstBanner?.s3" class="signin_banner"/>
      </nuxt-link-locale>

      <div class="signin_card">
        <div class="signin_row signin_row--marginBottom">
          <h2 class="signin_cardHeader">Zaloguj się</h2>
<!--          <nuxt-link-locale to="register" class="signin_cardLink">Nie masz konta? Zarejestruj się</nuxt-link-locale>-->
        </div>

        <div v-if="loginBarMessage" class="panel_infoContainer panel_infoContainer--success">
          <div class="row">
            <p class="panel_infoTxt">{{ loginBarMessage }}</p>
          </div>
        </div>

        <form class="login-form" method="post">
          <div class="row signin_majorError" v-if="responseError">
              {{ responseMessage }}
          </div>
          <div class="row signin_majorSuccess" v-if="router.currentRoute.value.query.registered">
            Dziękujemy za rejestrację. Zaloguj się do systemu.
          </div>
          <div class="signin_row">
            <label for="email" class="signin_label">Adres e-mail</label>
            <input name="email" type="text" class="signin_input" :class="v$.email.$error ? 'signin_input--error' : ''" v-model="v$.email.$model"/>
            <span v-if="v$.email.$error" class="signin_errorMsg signin_errorMsg--show">Nieprawidłowy adres e-mail!</span>
          </div>

          <div class="signin_row">
            <div class="row">
              <label for="password" class="signin_label">Hasło</label>
              <nuxt-link-locale to="remember" class="signin_cardLink" tabindex="-1">Nie pamiętam hasła</nuxt-link-locale>
            </div>
            <input name="password" type="password" class="signin_input" :class="v$.password.$error ? 'signin_input--error' : ''" v-model="v$.password.$model"/>
            <span v-if="v$.password.$error" class="signin_errorMsg signin_errorMsg--show">Hasło jest za krótkie!</span>
          </div>
          <div class="row">
            <button class="signin_button" @click="submit">Zaloguj się</button>
          </div>
          <div class="row">
            <nuxt-link-locale to="register" class="signin_button signin_button--ghost signin_button--desktop">Nie masz konta? Zarejestruj się</nuxt-link-locale>
            <nuxt-link-locale to="register" class="signin_button signin_button--ghost signin_button--mobile">Zarejestruj się</nuxt-link-locale>
          </div>
        </form>
        <FormSpinerLoaderWithText :loading="loading">Logowanie...</FormSpinerLoaderWithText>
      </div>
    </div>
  </div>
</template>

<style>

</style>

<script lang="ts" setup>
  import {storeToRefs} from 'pinia';
  import {useAuthStore} from '~/stores/useAuthStore';
  import { useVuelidate } from '@vuelidate/core'
  import { required, email, minLength } from '@vuelidate/validators'
  import {useReCaptcha} from "vue-recaptcha-v3";
  import * as yup from 'yup';
  import {useBannersStore} from "~/stores/useBannerStore";
  import useC2CStore from "~/stores/useC2CStore";

  const { authenticateUser, startLoadingAsyncData, sendNewPassword } = useAuthStore();
  const { authenticated, isSemiUser, loginBarMessage } = storeToRefs(useAuthStore());
  const { getUserBalance, getExternalUserData } = useUserStore();
  const { responseError, responseMessage, loading } = storeToRefs(useAuthStore());
  const recaptchaInstance = useReCaptcha();
  const router = useRouter();

  const state = reactive({
    email: '',
    password: '',
    'g-recaptcha-response': ''
  });

  const { getBanners } = useBannersStore();
  const { banners } = storeToRefs(useBannersStore());
  const firstBanner = ref({});
  const { isC2C } = storeToRefs(useC2CStore());

  watch(() => isC2C.value, () => {
    getBanners('login_page', isC2C.value);
  })

  onMounted(() => {
    loading.value = false;
    responseError.value = false;
    responseMessage.value = '';
    const authCookie = useCookie('auth');
    authCookie.value = null;
    getBanners('login_page', isC2C.value);

    if (router.currentRoute.value.query?.rememberHash) {
      loginBarMessage.value = 'Twoje nowe hasło zostało wysłane na podany adres e-mail. Sprawdź swoją skrzynkę odbiorczą.';
      sendNewPassword(router.currentRoute.value.query.rememberHash);
    } else if (router.currentRoute.value.query?.rememberSuccess) {
      loginBarMessage.value = 'Twoje nowe hasło zostało wysłane na podany adres e-mail. Sprawdź swoją skrzynkę odbiorczą.';
    } else {
      loginBarMessage.value = '';
    }
  });

  watch(() => banners.value, (newVal) => {
    if (newVal?.login_page?.length === 0) return;
      firstBanner.value = banners.value.login_page[0].Banner;
  }, { deep: true})

  const rules = computed(() => {
    return {
      email: { required, email },
      password: { required, minLength: minLength(8) },
    };
  });

  const submit = async (e) => {
    loading.value = true;
    authenticated.value = false
    e.preventDefault();
    v$.value.$touch();

    if (v$.value.$invalid) {
      loading.value = false;
      return;
    }

    const token = await recaptchaInstance?.executeRecaptcha('login');

    if (token) {
      state["g-recaptcha-response"] = token;
    }
    state.email = state.email.trim().toLowerCase();
    await authenticateUser(state);

    if (authenticated.value) {
      if (isSemiUser.value) {
        await router.push('/panel/user/profile');
        return;
      }

      const resultBalance = await getUserBalance();

      if (!resultBalance) {
        loading.value = false;
        responseError.value = true;
        responseMessage.value = 'Wystąpił błąd podczas pobierania danych użytkownika. Spróbuj ponownie później.';
        return;
      }

      const resultUserData = await getExternalUserData();

      if (!resultUserData.success) {
        loading.value = false;
        responseError.value = true;
        responseMessage.value = 'Wystąpił błąd podczas pobierania danych użytkownika. Spróbuj ponownie później.';
        return;
      }

      await router.push('/panel');
    }

    loading.value = false;
  }

  const v$ = useVuelidate(rules, state);

  definePageMeta({
    middleware: ['default-layout'],
  })
</script>