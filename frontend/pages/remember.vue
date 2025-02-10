<template>
  <div class="container">
    <div class="row">
      <h1 class="signin_header signin_header--desktop"><NuxtImg src="icons/blpLogoMain.png" width="200px" height="50px" class="signin_headerImg" /></h1>
      <h1 class="signin_header signin_header--mobile"></h1>
    </div>

    <div class="row row--centeredMobile row--centered" v-if="!passwordRemembered">
<!--      <div class="signin_card">-->
<!--        <nuxt-link-locale to="#" class="signin_ghostButton"><NuxtImg src="icons/signin/google.png" width="22px" height="22px" class="signin_ghostButtonImg" /> Zaloguj się przez Google</nuxt-link-locale>-->
<!--        <nuxt-link-locale to="#" class="signin_ghostButton"><NuxtImg src="icons/signin/apple.png" width="22px" height="27px" class="signin_ghostButtonImg" /> Zaloguj się przez Apple</nuxt-link-locale>-->
<!--        <nuxt-link-locale to="#" class="signin_ghostButton"><NuxtImg src="icons/signin/microsoft.png" width="22px" height="22px" class="signin_ghostButtonImg" /> Zaloguj się przez Microsoft</nuxt-link-locale>-->
<!--        <nuxt-link-locale to="#" class="signin_ghostButton"><NuxtImg src="icons/signin/allegro.png" width="22px" height="25px" class="signin_ghostButtonImg" /> Zaloguj się przez Allegro</nuxt-link-locale>-->
<!--      </div>-->

      <div class="signin_card">
        <div class="signin_row signin_row--marginBottom">
          <h2 class="signin_cardHeader">Przypomnij hasło</h2>
        </div>

        <form class="login-form" method="post">
          <div class="signin_row">
            <label for="email" class="signin_label">Adres e-mail</label>
            <input name="email" type="text" class="signin_input" :class="v$.email.$error ? 'signin_input--error' : ''" v-model="v$.email.$model"/>
            <span v-if="v$.email.$error" class="signin_errorMsg signin_errorMsg--show">Nieprawidłowy adres e-mail!</span>
          </div>

          <div v-if="responseError" class="signin_errorMsg signin_errorMsg--show">
            {{ responseMessage }}
          </div>
          <div v-if="!responseError" class="signin_successMsg signin_successMsg--show">
            {{ responseMessage }}
          </div>
          <button class="signin_button" @click.prevent="submit">Przypomnij</button>
        </form>
        <FormSpinerLoaderWithText :loading="loading">Przypominanie hasła...</FormSpinerLoaderWithText>
      </div>
    </div>
    <div v-else class="row row--centeredMobile row--centered">
      Pomyślnie wysłano przypomnienie hasła. Sprawdź swoją skrzynkę e-mail.
    </div>
  </div>
</template>

<script lang="ts" setup>
  import {storeToRefs} from 'pinia';
  import {useAuthStore} from '~/stores/useAuthStore';
  import { useVuelidate } from '@vuelidate/core'
  import { required, email, minLength } from '@vuelidate/validators'
  import {useReCaptcha} from "vue-recaptcha-v3";

  const { rememberPassword, startLoadingAsyncData } = useAuthStore();
  const { passwordRemembered, responseError, responseMessage, loading, loginBarMessage } = storeToRefs(useAuthStore());
  const recaptchaInstance = useReCaptcha();
  const router = useRouter();
  const state = reactive({
    email: '',
    'g-recaptcha-response': ''
  });

  onMounted(() => {
    responseError.value = false;
    responseMessage.value = '';
  });

  const rules = computed(() => {
    return {
      email: { required, email },
    };
  });
  const nuxt = useNuxtApp();
  const submit = async (e) => {
    e.preventDefault();
    v$.value.$touch();

    if (v$.value.$invalid) {
      return;
    }
    loading.value = true;
    const token = await recaptchaInstance?.executeRecaptcha('login');

    if (token) {
      state["g-recaptcha-response"] = token;
    }

    let result = await rememberPassword(state);
    loading.value = false;
    if (result.success) {
      await router.push({ path: nuxt.$localePath('login'), query: { rememberSuccess: true } });
    }
  }

  const v$ = useVuelidate(rules, state);

  definePageMeta({
    middleware: 'default-layout',
  })
</script>