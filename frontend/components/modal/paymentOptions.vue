<script setup lang="ts">
const props = defineProps({
  selectedPayment: {
    type: String,
    default: ''
  },
  showModal: {
    type: Boolean,
    default: false
  },
  action: {
    type: Function,
    default: () => {
      console.log('Action not provided')
    }
  },
  backText: {
    type: String,
    default: 'Wróć do koszyka'
  },
  loading: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits(['change', 'show', 'hide'])
const emitChange = (event: Event) => {
  emit('change', event.target.defaultValue)
}

const closeModal = () => {
  emit('hide')
}

const isAvailablePayment = (payment) => {
  return Object.keys(paymentOptions.value).includes(payment);
}

const paymentNotSelectedError = ref(false)
const tryPay = () => {
  if (!props.selectedPayment) {
    paymentNotSelectedError.value = true;
    return;
  } else {
    paymentNotSelectedError.value = false;
  }

  props.action()
}

const {paymentOptions} = storeToRefs(useUserStore());
</script>

<template>
  <Teleport to="body">
    <Modal :show="showModal" @close="showModal = false; closeModal()">
      <template #header>
        <div class="row">
          <h3 class="modal_title modal_title--big">Wybierz rodzaj płatności</h3>
        </div>
      </template>
      <template #body>
        <div style="position: relative">
          <div class="row">
            <div class="modal_paymentContainer">
              <input type="radio" id="radio110" name="qwerty" value="paynow" class="form_radioInput" @change="emitChange" v-if="isAvailablePayment('paynow')"/>
              <label for="radio110" v-if="isAvailablePayment('paynow')"
                     @click="selectedPayment = 'paynow';"
                     :style="selectedPayment === 'paynow' ? 'border: 2px solid #4285F4;' : ''"
                     class="form_radioLabelTile form_radioLabelTile--primary">
                <NuxtImg src="icons/orderForm/logo_paynow.png" width="70px" height="" style="margin-bottom: 7px"/>
                Online
              </label>

              <input type="radio" id="radio111" name="qwerty" value="pay_later" class="form_radioInput"
                     @change="emitChange" v-if="isAvailablePayment('pay_later')"/>
              <label for="radio111" v-if="isAvailablePayment('pay_later')"
                     @click="selectedPayment = 'pay_later';"
                     :style="selectedPayment === 'pay_later' ? 'border: 2px solid #4285F4;' : ''"
                     class="form_radioLabelTile form_radioLabelTile--primary">
                <NuxtImg src="icons/orderForm/przelew.png" width="34px" height="32px" style="margin-bottom: 7px"/>
                Przelew
              </label>

              <input type="radio" id="radio112" name="qwerty" value="bank" class="form_radioInput" @change="emitChange"
                     v-if="isAvailablePayment('bank')"/>
              <label for="radio112" v-if="isAvailablePayment('bank')"
                     @click="selectedPayment = 'bank';"
                     :style="selectedPayment === 'bank' ? 'border: 2px solid #4285F4;' : ''"
                     class="form_radioLabelTile form_radioLabelTile--primary">
                <NuxtImg src="icons/orderForm/skarbonka.png" width="32px" height="32px" style="margin-bottom: 8px"/>
                Skarbonka</label>
            </div>
          </div>
          <div class="modal_paymentContainer" style="margin-top: 20px">
            <span v-show="paymentNotSelectedError" class="calc_errorMsg calc_errorMsg--show" style="font-size: 15px">Proszę o wybranie sposobu płatności.</span>
          </div>
          <div class="orderForm_summaryModalButtonsContainer">
            <button class="orderForm_buttonGhost" @click.prevent="showModal = false; closeModal()">{{
                backText
              }}
            </button>
            <button class="orderForm_buttonPrimary" @click.prevent="tryPay">Zamawiam i płacę</button>
          </div>
          <FormSpinerLoaderWithText :loading="loading">Procesowanie zamówienia...</FormSpinerLoaderWithText>
        </div>
      </template>
    </Modal>
  </Teleport>
</template>

<style scoped>

</style>
