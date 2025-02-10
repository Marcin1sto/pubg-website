<template>
  <div class="form_card">
    <button class="form_buttonSecondary" @click="fillForm">Wypełnij danymi testowymi</button>
  </div>
</template>

<script setup lang="ts">
import useOrderFormStore from "~/stores/panel/orderFormStore";
import {storeToRefs} from "pinia";

const {
  selectPackageDeliveryType,
  updateCourierSearchField,
  updateSortable,
  updatePickup
} = useOrderFormStore();

const {
  form
} = storeToRefs(useOrderFormStore());

const fillForm = () => {
  selectPackageDeliveryType('package');

  updateCourierSearchField('1', 'side_x');
  updateCourierSearchField('1', 'side_y');
  updateCourierSearchField('1', 'side_z');
  updateCourierSearchField('1', 'weight');
  updateCourierSearchField('Książki i dokumenty', 'package_content');
  updateCourierSearchField('PL', 'country_code');
  updateCourierSearchField('PL', 'postal_sender_country');

  updateSortable({
    code: 1,
    name: 'Standardowa'
  });

  form.value.sender = {
    name: 'Jan Kowalski',
    vat_company: 'Test Company Sp. z o.o.',
    vat_street: 'Testowa',
    vat_house_no: '15',
    vat_locum_no: '7',
    vat_postal: '00-001',
    vat_city: 'Warszawa',
    email: 'jan.kowalski@test.pl',
    phone: '500100200',
    no_pickup: true,
    country: 'PL'
  };

  form.value.recipient = {
    taker_name: 'Anna Nowak',
    taker_vat_company: 'Firma Odbiorcza S.A.',
    taker_street: 'Odbiorcza',
    taker_house_no: '30',
    taker_locum_no: '12',
    taker_postal: '00-002',
    taker_city: 'Kraków',
    taker_email: 'anna.nowak@test.pl',
    taker_phone: '600200300',
    country: 'PL',
    marketplace_sale_id: ''
  };

  form.value.services = {
    cover: '0',
    uptake: '0',
    inpost_weekend: false,
    delivery_private: false,
    bringing_and_unpack: false,
    bringing: false,
    return_pallet: false
  };

  updatePickup(false);

  nextTick(() => {
    const event = new Event('change', { bubbles: true });
    document.dispatchEvent(event);
  });
};
</script>