<script setup lang="ts">
import {storeToRefs} from "pinia";
import useUserStore from "~/stores/useUserStore";
import {useAuthStore} from "~/stores/useAuthStore";
import {onClickOutside} from "@vueuse/core";

const router = useRouter();
const { authenticated, isSemiUser } = storeToRefs(useAuthStore());
const { userExternalData } = storeToRefs(useUserStore());
const userName = ref('Witaj w BLPaczce!')
const { logout } = useAuthStore();
const target = ref(null);
let isC2C = userExternalData.value.Broker.consumer_account;

onClickOutside(target, event => clickOutside(event));

const logoutUser = async (e) => {
  e.preventDefault();

  let loggedOut = await logout();

  if (loggedOut || !authenticated) {
    await router.push('/logowanie');
  }
}

const userInitials = ref('BL')
const getUserInitials = () => {
  if (!userExternalData.value?.Broker?.name) {
    userInitials.value = 'BL';
    return;
  }

  let words = userExternalData.value?.Broker?.name.split(" ");
  let firstLetters = words.map(word => word.charAt(0).toUpperCase());
  userInitials.value = firstLetters.join("");
}

const clickOutside = (e) => {
  if (!showDropdown.value) return;

  if (!e.target.closest('.user_dropdown')) {
    showDropdown.value = false;
  }
}

const getUserName = () => {
  if (!userExternalData.value?.Broker?.name) {
    userName.value = 'Witaj w BLPaczce!';
    return;
  }

  let words = userExternalData.value?.Broker?.name.split(" ");
  userName.value = `Witaj ${words[0]}!`;
}

getUserName();
getUserInitials();

const showDropdown = ref(false);

</script>

<template>
  <div ref="target">
    <div class="section-item" @click="showDropdown = !showDropdown">
      <div class="circle">
        {{ userInitials }}
      </div>
      <IconArrowDown class="blue"/>
    </div>
    <div class="user_dropdown" :style="showDropdown ? 'display: block;' : 'display: none;'">
      <div class="user_dropdown_Item user_dropdown_Item--underLine user_dropdown_Item--title">{{userName}}</div>
      <div class="user_dropdown_Item user_dropdown_Item--underLine">
        <nuxt-link-locale to="panel-user-profile" @click="showDropdown = false">
          <div class="user_dropdown_Item--link">
            <IconBase name="settings" class="icon" />
            <span>Ustawienia osobiste</span>
          </div>
        </nuxt-link-locale>
        <!--          <div class="user_dropdown_Item&#45;&#45;link">-->
        <!--            <IconBase name="letter" class="icon" />-->
        <!--            <span>Wiadomości</span>-->
        <!--          </div>-->
        <nuxt-link-locale to="panel-invoices" @click="showDropdown = false" v-if="!isSemiUser">
          <div class="user_dropdown_Item--link">
            <IconBase name="invoices" class="icon" :style="userExternalData?.Broker?.late_payment_invoices ? 'color:red' : ''"/>
            <span :style="userExternalData?.Broker?.late_payment_invoices ? 'color:red' : ''">Faktury</span>
          </div>
        </nuxt-link-locale>
        <nuxt-link-locale to="panel-user-offers" @click="showDropdown = false" v-if="!isSemiUser && !isC2C">
          <div class="user_dropdown_Item--link">
            <IconBase name="offerts" class="icon" />
            <span>Indywidualne oferty</span>
          </div>
        </nuxt-link-locale>
        <!--          <div class="user_dropdown_Item&#45;&#45;link">-->
        <!--            <IconBase name="stars" class="icon" />-->
        <!--            <span>Punkty lojalnościowe</span>-->
        <!--          </div>-->
        <nuxt-link-locale to="panel-user-password" @click="showDropdown = false">
          <div class="user_dropdown_Item--link">
            <IconBase name="password" class="icon" />
            <span>Zmiana hasła</span>
          </div>
        </nuxt-link-locale>
      </div>
      <div class="user_dropdown_Item user_dropdown_Item--link  user_dropdown_Item--logout" @click="logoutUser">
        <IconBase name="logout" class="icon" />
        <div>Wyloguj się</div>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
.circle {
  position: relative;
  width: 40px;
  height: 40px;
  background-color: #4285F4;
  border-radius: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 14px;
  color: #F2F5FB;
  line-height: 18px;
  font-weight: 500;
}


a {
  text-decoration: none;
}

.icon {
  color: rgba(0, 0, 0, 0.57);
  display: flex;
  align-items: center;
  justify-content: center;
  width: 16px;
}

.user_dropdown {
  color: black;
  z-index: 200;
  position: absolute;
  min-width: 275px;
  background-color: #F2F5FB;
  border-radius: 8px;
  border: 1px solid #F2F2F2;
  box-shadow: 0 24px 24px 0 #0000000A;
  top: 64px;
  right: 32px;

  &_Item {
    padding: 16px;
    font-size: 14px;
    line-height: 19px;
    cursor: pointer;
    height: auto;

    &--underLine {
      border-bottom: 1px solid #C7D3EA;
    }

    &--title {
      font-weight: 700;
      font-size: 14px;
      line-height: 14px;
      font-family: Open Sans;
      cursor: context-menu;
    }

    &--logout {
      padding-top: 25px;
      padding-bottom: 25px;
      height: 30px;
    }

    &--link {
      display: flex;
      align-items: center;
      gap: 15px;
      font-size: 14px;
      line-height: 14px;
      font-weight: 400;
      height: 27px;
      color: black;
      text-decoration: none;

      &:hover {
        color: rgba(66, 133, 244, 1);
      }

      &:hover .icon {
        color: rgba(66, 133, 244, 1);
      }
    }
  }
}
</style>