<script setup lang="ts">
import useUserStore from "~/stores/useUserStore";
import {email, minLength, required, requiredIf, helpers} from "@vuelidate/validators";
import {useVuelidate} from "@vuelidate/core";
import useComplaintsStore from "~/stores/panel/useComplaintsStore";
import usePageStore from "~/stores/usePageStore";
import {useTableStore} from "~/stores/useTableStore";

const props = defineProps({
  modalVisible: {
    type: Boolean,
    required: true,
    default: false,
  },
  order: {
    type: Object,
    required: true,
    default: () => ({}),
  },
})

const emit = defineEmits(['update:modalVisible', 'hide', 'update:orderComplaintSend'])
const complaintsSelected = ref('');
const complaintsOptions = [
  {name: 'Zagubienie', code: 'lostOrder'},
  {name: 'Uszkodzenie paczki', code: 'damageOrder'},
  {name: 'Nieregulaminowe wykonanie usługi transportu', code: 'irregularService'},
  {name: 'Ubytek zawartości paczki', code: 'lossInOrder'},
  {name: 'Reklamacja dopłaty', code: 'surchargeComplaint'},
]
const {userExternalData, getUseFullAddress} = storeToRefs(useUserStore())
const {createComplaint} = useComplaintsStore();

const form = ref({
  waybill_no: '',
  order_date: '',
  company_name: '',
  adres: '',
  email: '',
  phone: '',
  order_id: '',
  package_content: '',
  complaint_type: null,
  damage_description: '',
  bill_of_sale: [],
  photo_damage_box_indside: [],
  photo_damage_box_oudside: [],
  photo_damage_goods: [],
  damage_report: [],
  complaint_value: '',
  no_claims_in_courier: false,
  is_vat: '',
});

watch(() => props.modalVisible, () => {
  if (props.modalVisible) {
    const ApiRequest = ref(props.order.ApiRequest)
    const Order = ref(props.order.Order)

    form.value.waybill_no = ApiRequest.value?.waybill_no ?? '';
    form.value.order_date = Order.value?.created ?? '';
    form.value.company_name = userExternalData.value?.Broker?.vat_company ?? '';
    form.value.adres = getUseFullAddress.value ?? '';
    form.value.email = Order.value?.email ?? '';
    form.value.phone = Order.value?.phone ?? '';
    form.value.order_id = Order.value?.id ?? '';
    form.value.package_content = Order.value?.package_content ?? '';
    form.value.complaint_type = ref(null);
    form.value.damage_description = ref("");

    // Zaznaczenie pierwszej opcji typu formularza
    complaintsSelected.value = complaintsOptions[0].code;
    complaintSelectedCheck(['lostOrder'])
    v$.value.complaint_type.$model = complaintsOptions[0].code
  }

  v$.value.$reset()
  emit('update:modalVisible', props.modalVisible)
})

watch(() => complaintsSelected.value, () => {
  if (complaintsSelected.value === '') {
    complaintSelectedCheck([])
  }
})

const complaintSelectedCheck = (sections) => {
  return sections.includes(complaintsSelected.value)
}

const fileChanged = (event, key) => {
  var files = event.target.files || event.dataTransfer.files;

  if (!files.length) {
    return;
  }

  form.value[key] = files[0];
}

const file_size_validation = (value) => {
  if (value.length === 0) {
    return true;
  }

  let file = value;
  return !(file.size > 3145728);
};

const file_type_validation = (value) => {
  if (value.length === 0) {
    return true;
  }

  let file = value;
  return (['image/jpeg', 'image/png', 'application/pdf'].includes(file.type));
};

const rules = computed(() => {
  return {
    complaint_type: {required},
    order_id: {required},
    email: {required, email},
    phone: {required, minLength: minLength(9)},
    waybill_no: {required},
    order_date: {required},
    company_name: {requiredIf: requiredIf(!userExternalData.value.Broker.consumer_account)},
    adres: {required},
    is_vat: {requiredIf: requiredIf(!userExternalData.value.Broker.consumer_account)},
    complaint_value: {requiredIf: requiredIf(['lostOrder', 'damageOrder', 'lossInOrder'].includes(form.value.complaint_type))},
    package_content: {required},
    accident_description: {requiredIf: requiredIf(['damageOrder', 'lossInOrder'].includes(form.value.complaint_type))},
    damage_description: {requiredIf: requiredIf((['damageOrder', 'lossInOrder'].includes(form.value.complaint_type)))},
    damage_report: {requiredIf: requiredIf((['damageOrder', 'lossInOrder'].includes(form.value.complaint_type))), fileSizeValidation: file_size_validation, fileTypeValidation: file_type_validation},
    photo_damage_goods: {requiredIf: requiredIf((['damageOrder', 'lossInOrder'].includes(form.value.complaint_type))), fileSizeValidation: file_size_validation, fileTypeValidation: file_type_validation},
    photo_damage_box_oudside: {requiredIf: requiredIf((['damageOrder', 'lossInOrder'].includes(form.value.complaint_type))), fileSizeValidation: file_size_validation, fileTypeValidation: file_type_validation},
    photo_damage_box_indside: {requiredIf: requiredIf((['damageOrder', 'lossInOrder'].includes(form.value.complaint_type))), fileSizeValidation: file_size_validation, fileTypeValidation: file_type_validation},
    bill_of_sale: {requiredIf: requiredIf((['damageOrder', 'lossInOrder', 'lostOrder'].includes(form.value.complaint_type))), fileSizeValidation: file_size_validation, fileTypeValidation: file_type_validation},
    no_claims_in_courier: {requiredIf: requiredIf(['irregularService'].includes(form.value.complaint_type))},
  };
});
const v$ = useVuelidate(rules, form);
const router = useRouter()
const route = useRoute()
const { successMessage, errorMessage, errorMessageShow, successMessageShow } = storeToRefs(usePageStore());
const { items } = storeToRefs(useTableStore())
const modalRef = ref()
const createComplaintProcessing = ref(false)

const trySendComplaint = async (e) => {
  if (createComplaintProcessing.value) {
    return;
  }

  e.preventDefault();
  v$.value.$touch();

  if (v$.value.$invalid) {
    return;
  }

  let formData = new FormData();
  for (let key in form.value) {
    if (form.value[key] !== null || form.value[key] !== '') {
      formData.append(key, form.value[key]);
    }
  }
  createComplaintProcessing.value = true;

  if (userExternalData.value.Broker.consumer_account) {
    formData.append('is_vat', true);
  }

  let result = await createComplaint(formData)

  let tableItemAction = items.value.find((item) => item.id === props.order.Order.id).actions.content.find((action) => action.functionName === 'createComplaint');

  if (result.success) {
    tableItemAction.disabled = true;
    successMessageShow.value = true;
    successMessage.value.title = 'Reklamacja została złożona';
    successMessage.value.message = 'Dziękujemy za złożenie reklamacji. Wkrótce skontaktuje się z Tobą nasz konsultant.';

    setTimeout(() => {
      successMessageShow.value = false;
      successMessage.value.title = '';
      successMessage.value.message = '';
    }, 10000);

    const successSection = document.getElementById('successPanelMessage');
    successSection.style.display = 'block';
    if (successSection) {
      successSection.scrollIntoView({behavior: 'smooth', block: "end"});
    }

    emit('update:orderComplaintSend', true)
    emit('hide')
  } else {
    tableItemAction.disabled = true;
    errorMessageShow.value = true;
    errorMessage.value.title = 'Błąd';
    errorMessage.value.message = result.message
    const errorSection = document.getElementById('errorPanelMessage');
    errorSection.style.display = 'flex';

    if (errorSection) {
      errorSection.scrollIntoView({behavior: 'smooth', block: "end"});
    }

    emit('update:orderComplaintSend', false)
    emit('hide')
  }

  createComplaintProcessing.value = false;
}

const closeModal = () => {
  emit('hide')
}
</script>

<template>
  <Teleport to="body">
    <Modal :show="modalVisible" @close="modalVisible = false; closeModal()" ref="modalRef">
      <template #header>
        <h1 class="modal_title modal_title--big">Złóż reklamację na paczkę.</h1>
      </template>
      <template #body>
        <div style="display: flex; justify-content: center; align-items: center; flex-direction: column">
          <InputFilterSelect
              :container-class="'form_inputContainerMax'"
              :base-value="complaintsSelected"
              :is-required="true"
              :options="complaintsOptions"
              @change="complaintsSelected = $event; v$.complaint_type.$model = $event"
              label="Powód reklamacji"
              :error-msg="v$.complaint_type.$error ? 'Pole jest wymagane.' : ''"
          />
          <div class="row row--orderForm complaints_container">
            <div style="width: 100%; min-width: 810px;">
              <div class="row ">
                <div class="orderForm_inputContainer400">
                  <label for="" class="calc_label">Nr etykiety lub listu przewozowego <i>*</i></label>
                  <div class="calc_inputWithUnit calc_inputWithUnit--wrap calc_inputWithUnit--noMargin">
                    <input type="text" id="" name="" v-model="v$.waybill_no.$model"
                           class="calc_inputTxt calc_inputTxt--withoutUnit calc_inputTxt--fullWidth" readonly/>
                    <span v-show="v$.waybill_no.$error"
                          class="calc_errorMsg calc_errorMsg--show">Pole jest wymagane</span>
                  </div>
                </div>

                <div class="orderForm_inputContainer400">
                  <label for="" class="calc_label">Data nadania <i>*</i></label>
                  <div class="calc_inputWithUnit calc_inputWithUnit--wrap calc_inputWithUnit--noMargin">
                    <input type="text" id="" name="" v-model="v$.order_date.$model"
                           class="calc_inputTxt calc_inputTxt--withoutUnit calc_inputTxt--fullWidth"/>
                    <span v-show="v$.order_date.$error"
                          class="calc_errorMsg calc_errorMsg--show">Pole jest wymagane</span>
                  </div>
                </div>
              </div>
              <div class="row ">
                <div class="orderForm_inputContainer400" v-if="!userExternalData.Broker.consumer_account">
                  <label for="" class="calc_label">Nazwa firmy <i>*</i></label>
                  <div class="calc_inputWithUnit calc_inputWithUnit--wrap calc_inputWithUnit--noMargin">
                    <input type="text" id="" name="" v-model="v$.company_name.$model"
                           class="calc_inputTxt calc_inputTxt--withoutUnit calc_inputTxt--fullWidth"/>
                    <span v-show="v$.company_name.$error" class="calc_errorMsg calc_errorMsg--show">Pole jest wymagane</span>
                  </div>
                </div>

                <div class="orderForm_inputContainer400">
                  <label for="" class="calc_label">Adres<i>*</i></label>
                  <div class="calc_inputWithUnit calc_inputWithUnit--wrap calc_inputWithUnit--noMargin">
                    <input type="text" id="" name="" v-model="v$.adres.$model"
                           @change="form.adres = $event.target.value"
                           class="calc_inputTxt calc_inputTxt--withoutUnit calc_inputTxt--fullWidth"/>
                    <span v-show="v$.adres.$error" class="calc_errorMsg calc_errorMsg--show">Pole jest wymagane</span>
                  </div>
                </div>
              </div>
              <div
                  v-if="!userExternalData.Broker.consumer_account"
                  style="display: flex; justify-content: center; align-items: center; flex-direction: column; margin-top: 20px">
                <InputFilterSelect
                    label="Firma jest płatnikiem VAT"
                    :options="[{name: 'Tak', code: 'true'}, {name: 'Nie', code: 'false'}]"
                    :is-required="true"
                    :error-msg="v$.is_vat.$error ? 'Pole jest wymagane.' : ''"
                    v-model="form.is_vat"
                />
              </div>
              <div class="row ">
                <div class="orderForm_inputContainer400">
                  <label for="" class="calc_label">Adres email<i>*</i></label>
                  <div class="calc_inputWithUnit calc_inputWithUnit--wrap calc_inputWithUnit--noMargin">
                    <input type="text" id="" name="" v-model="v$.email.$model"
                           class="calc_inputTxt calc_inputTxt--withoutUnit calc_inputTxt--fullWidth"/>
                    <span v-show="v$.email.$error" class="calc_errorMsg calc_errorMsg--show">Pole jest wymagane</span>
                  </div>
                </div>

                <div class="orderForm_inputContainer400">
                  <label for="" class="calc_label">Telefon<i>*</i></label>
                  <div class="calc_inputWithUnit calc_inputWithUnit--wrap calc_inputWithUnit--noMargin">
                    <input type="text" id="" name="" v-model="v$.phone.$model"
                           class="calc_inputTxt calc_inputTxt--withoutUnit calc_inputTxt--fullWidth"/>
                    <span v-show="v$.phone.$error" class="calc_errorMsg calc_errorMsg--show">Pole jest wymagane</span>
                  </div>
                </div>
              </div>
              <div class="row " v-show="complaintSelectedCheck(['lostOrder'])">
                <div class="orderForm_inputContainer400">
                  <label for="" class="calc_label">Kwota roszczenia<i>*</i></label>
                  <div class="calc_inputWithUnit calc_inputWithUnit--wrap calc_inputWithUnit--noMargin">
                    <input type="text" id="complaint_value_id" name="complaint_value"
                           v-model="v$.complaint_value.$model"
                           class="calc_inputTxt calc_inputTxt--withoutUnit calc_inputTxt--fullWidth"/>
                    <span v-show="v$.complaint_value.$error" class="calc_errorMsg calc_errorMsg--show">Pole jest wymagane</span>
                  </div>
                </div>

                <div class="orderForm_inputContainer400">
                  <label for="" class="calc_label">Zawartość przesyłki<i>*</i></label>
                  <div class="calc_inputWithUnit calc_inputWithUnit--wrap calc_inputWithUnit--noMargin">
                    <input type="text" id="" name="" v-model="v$.package_content.$model"
                           class="calc_inputTxt calc_inputTxt--withoutUnit calc_inputTxt--fullWidth"/>
                    <span v-show="v$.package_content.$error" class="calc_errorMsg calc_errorMsg--show">Pole jest wymagane</span>
                  </div>
                </div>
              </div>
              <div class="row " v-show="complaintSelectedCheck(['damageOrder', 'lossInOrder'])">
                <div class="orderForm_inputContainer400">
                  <label for="" class="calc_label">Rodzaj uszkodzenia (do 100 znaków)<i>*</i></label>
                  <div class="calc_inputWithUnit calc_inputWithUnit--wrap calc_inputWithUnit--noMargin">
                    <input type="text" id="" name="" v-model="v$.damage_description.$model"
                           class="calc_inputTxt calc_inputTxt--withoutUnit calc_inputTxt--fullWidth" maxlength="100"/>
                    <span v-show="v$.damage_description.$error"
                          class="calc_errorMsg calc_errorMsg--show">Pole jest wymagane</span>
                  </div>
                </div>

                <div class="orderForm_inputContainer400">
                  <label for="" class="calc_label">Kwota roszczenia<i>*</i></label>
                  <div class="calc_inputWithUnit calc_inputWithUnit--wrap calc_inputWithUnit--noMargin">
                    <input type="text" id="" name="" v-model="v$.complaint_value.$model"
                           class="calc_inputTxt calc_inputTxt--withoutUnit calc_inputTxt--fullWidth" maxlength="100"/>
                    <span v-show="v$.complaint_value.$error" class="calc_errorMsg calc_errorMsg--show">Pole jest wymagane</span>
                  </div>
                </div>
              </div>
              <div
                  style="display: flex; justify-content: center; align-items: center; flex-direction: column; margin-top: 10px;">
                <InputTextAreaWithLabel
                    v-model="v$.accident_description.$model"
                    label-text="Opis zdarzenia (do 1000 znaków)"
                    :validation-error-message="v$.accident_description.$error ? 'Pole jest wymagane.' : ''"
                    max-length="1000"
                />
              </div>
              <div
                  style="text-align: center; margin-top: 15px; margin-bottom: 10px; font-family: 'Open Sans'; font-size: 13px"
                  v-show="complaintSelectedCheck(['damageOrder', 'lossInOrder'])">
                Załączniki wymagane do złożenia reklamacji (format pliku: jpg, png, pdf)
                Maksymalny rozmiar każdego pliku 3mb
              </div>
              <div class="row " v-show="complaintSelectedCheck(['damageOrder', 'lossInOrder'])">
                <div class="orderForm_inputContainer400" style="margin-top: 10px">
                  <label for="" class="calc_label">Protokół szkody<i>*</i></label>
                  <div style="display: flex; flex-direction: column;">
                    <input type="file" id="" name="damage_report" class=""
                           @change="fileChanged($event, 'damage_report')"
                           accept=".jpg,.jpeg,.png,.pdf"
                    />
                    <span v-show="v$.damage_report.$errors?.find(error => error.$validator == 'requiredIf')" class="calc_errorMsg calc_errorMsg--show">Pole jest wymagane</span>
                    <span v-show="v$.damage_report.$errors?.find(error => error.$validator == 'fileSizeValidation')" class="calc_errorMsg calc_errorMsg--show">Wgrany plik przekracza dozwoloną wielość. Plik nie może być większy niż 3 MB.</span>
                    <span v-show="v$.damage_report.$errors?.find(error => error.$validator == 'fileTypeValidation')" class="calc_errorMsg calc_errorMsg--show">Wgrany plik ma niepoprawny typ. Dozwolone typy: jpg, png, pdf</span>
                  </div>
                </div>

                <div class="orderForm_inputContainer400" style="margin-top: 10px">
                  <label for="" class="calc_label">Zdjęcie uszkodzenia towaru<i>*</i></label>
                  <div style="display: flex; flex-direction: column;">
                    <input type="file" id="" name="photo_damage_goods"
                           @change="fileChanged($event, 'photo_damage_goods')"
                           accept=".jpg,.jpeg,.png,.pdf"
                    />
                    <span v-show="v$.photo_damage_goods.$errors?.find(error => error.$validator == 'requiredIf')" class="calc_errorMsg calc_errorMsg--show">Pole jest wymagane</span>
                    <span v-show="v$.photo_damage_goods.$errors?.find(error => error.$validator == 'fileSizeValidation')" class="calc_errorMsg calc_errorMsg--show">Wgrany plik przekracza dozwoloną wielość. Plik nie może być większy niż 3 MB.</span>
                    <span v-show="v$.photo_damage_goods.$errors?.find(error => error.$validator == 'fileTypeValidation')" class="calc_errorMsg calc_errorMsg--show">Wgrany plik ma niepoprawny typ. Dozwolone typy: jpg, png, pdf</span>
                  </div>
                </div>
              </div>
              <div class="row " v-show="complaintSelectedCheck(['damageOrder', 'lossInOrder'])"
                   style="margin-top: 10px">
                <div class="orderForm_inputContainer400">
                  <label for="" class="calc_label">Zdjęcie opakowania/uszkodzenia zewnętrznego<i>*</i></label>
                  <div style="display: flex; flex-direction: column;">
                    <input type="file" id="" name="photo_damage_box_oudside"
                           @change="fileChanged($event, 'photo_damage_box_oudside')"
                           accept=".jpg,.jpeg,.png,.pdf"
                    />
                    <span v-show="v$.photo_damage_box_oudside.$errors?.find(error => error.$validator == 'requiredIf')" class="calc_errorMsg calc_errorMsg--show">Pole jest wymagane</span>
                    <span v-show="v$.photo_damage_box_oudside.$errors?.find(error => error.$validator == 'fileSizeValidation')" class="calc_errorMsg calc_errorMsg--show">Wgrany plik przekracza dozwoloną wielość. Plik nie może być większy niż 3 MB.</span>
                    <span v-show="v$.photo_damage_box_oudside.$errors?.find(error => error.$validator == 'fileTypeValidation')" class="calc_errorMsg calc_errorMsg--show">Wgrany plik ma niepoprawny typ. Dozwolone typy: jpg, png, pdf</span>
                  </div>
                </div>

                <div class="orderForm_inputContainer400">
                  <label for="" class="calc_label">Zdjęcie opakowania/uszkodzenia wewnętrznego<i>*</i></label>
                  <div style="display: flex; flex-direction: column;">
                    <input type="file" id="" name="photo_damage_box_indside"
                           @change="fileChanged($event, 'photo_damage_box_indside')"
                           accept=".jpg,.jpeg,.png,.pdf"
                    />
                    <span v-show="v$.photo_damage_box_indside.$errors?.find(error => error.$validator == 'requiredIf')" class="calc_errorMsg calc_errorMsg--show">Pole jest wymagane</span>
                    <span v-show="v$.photo_damage_box_indside.$errors?.find(error => error.$validator == 'fileSizeValidation')" class="calc_errorMsg calc_errorMsg--show">Wgrany plik przekracza dozwoloną wielość. Plik nie może być większy niż 3 MB.</span>
                    <span v-show="v$.photo_damage_box_indside.$errors?.find(error => error.$validator == 'fileTypeValidation')" class="calc_errorMsg calc_errorMsg--show">Wgrany plik ma niepoprawny typ. Dozwolone typy: jpg, png, pdf</span>
                  </div>
                </div>
              </div>
              <div
                  style="margin-top: 10px; display: flex; justify-content: flex-start; align-items: flex-start; flex-direction: column;"
                  v-show="complaintSelectedCheck(['damageOrder', 'lossInOrder', 'lostOrder'])">
                <label for="" class="calc_label">Dokument potwierdzający wartość zakupu (paragon/faktura). Format pliku:
                  jpg, png, pdf), maksymalny rozmiar 3mb<i>*</i></label>
                <div style="display: flex; flex-direction: column;">
                  <input type="file" id="" name=""
                         @change="fileChanged($event, 'bill_of_sale')"
                         accept=".jpg,.jpeg,.png,.pdf"
                  />
                  <span v-show="v$.bill_of_sale.$errors?.find(error => error.$validator == 'requiredIf')" class="calc_errorMsg calc_errorMsg--show">Pole jest wymagane</span>
                  <span v-show="v$.bill_of_sale.$errors?.find(error => error.$validator == 'fileSizeValidation')" class="calc_errorMsg calc_errorMsg--show">Wgrany plik przekracza dozwoloną wielość. Plik nie może być większy niż 3 MB.</span>
                  <span v-show="v$.bill_of_sale.$errors?.find(error => error.$validator == 'fileTypeValidation')" class="calc_errorMsg calc_errorMsg--show">Wgrany plik ma niepoprawny typ. Dozwolone typy: jpg, png, pdf</span>
                </div>
              </div>
              <div style="margin-top: 10px" v-show="complaintSelectedCheck(['irregularService'])">
                <div class="row row--checkboxContainer">
                  <input type="checkbox" id="consent" name="consent"
                         @change="v$.no_claims_in_courier.$model = $event.target.checked;"/>
                  <label for="consent" class="signin_label signin_label--checkbox">Oświadczenie o zrzeczeniu się prawa
                    do dochodzenia roszczeń u przewoźnika<i>*</i></label>
                </div>
                <div v-if="v$.no_claims_in_courier.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</div>
              </div>
            </div>
          </div>
        </div>
        <div class="orderForm_summaryModalButtonsContainer">
          <button class="orderForm_buttonGhost" @click.prevent="modalVisible = false; closeModal()">Zamknij</button>
          <button class="orderForm_buttonPrimary" @click.prevent="trySendComplaint">Złóż</button>
        </div>
      </template>
    </Modal>
  </Teleport>
</template>

<style scoped>
.orderForm_inputContainer400 {
  margin-top: 10px;
}

.form_inputContainerMax {
  width: 100%;
  margin-bottom: 16px;
}

.form_inputContainer300 {
  display: flex;
  flex-wrap: wrap;
  align-content: flex-start;
  //width: 100%;
  //max-width: 300px;
  margin-bottom: 16px;
}
</style>