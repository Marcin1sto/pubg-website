<template>
  <div class="orderForm_stepper">
    <ul class="orderForm_stepperList">
      <li class="orderForm_stepperListItem">
        <a href="#przesylka" class="orderForm_stepperLink">
          <IconStatus :color="sectionsDone.packages.color" class="orderForm_stepperCheck"/>
          <span class="orderForm_stepperTxt">Przesyłka</span>
        </a>
        <NuxtImg src="icons/orderForm/arrow.png" width="30px" height="12px" class="orderForm_stepperArrow"/>
      </li>
      <li class="orderForm_stepperListItem">
        <a href="#nadanie" class="orderForm_stepperLink">
          <IconStatus :color="sectionsDone.sender.color" class="orderForm_stepperCheck"/>
          <span class="orderForm_stepperTxt">Nadanie</span>
        </a>
        <NuxtImg src="icons/orderForm/arrow.png" width="30px" height="12px" class="orderForm_stepperArrow"/>
      </li>
      <li class="orderForm_stepperListItem">
        <a href="#doreczenie" class="orderForm_stepperLink">
          <IconStatus :color="sectionsDone.recipient.color" class="orderForm_stepperCheck"/>
          <span class="orderForm_stepperTxt">Doręczenie</span>
        </a>
        <NuxtImg src="icons/orderForm/arrow.png" width="30px" height="12px" class="orderForm_stepperArrow"/>
      </li>
      <li class="orderForm_stepperListItem">
        <a href="#uslugi" class="orderForm_stepperLink">
          <IconStatus :color="sectionsDone.services.color" class="orderForm_stepperCheck"/>
          <span class="orderForm_stepperTxt">Usługi</span>
        </a>
        <NuxtImg src="icons/orderForm/arrow.png" width="30px" height="12px" class="orderForm_stepperArrow"/>
      </li>
      <li class="orderForm_stepperListItem">
        <a href="#kurier" class="orderForm_stepperLink">
          <IconStatus :color="sectionsDone.courier.color" class="orderForm_stepperCheck"/>
          <span class="orderForm_stepperTxt">Kurier</span>
        </a>
        <NuxtImg src="icons/orderForm/arrow.png" width="30px" height="12px" class="orderForm_stepperArrow"/>
      </li>
      <li class="orderForm_stepperListItem">
        <a href="#podsumowanie" class="orderForm_stepperLink">
          <IconStatus :color="sectionsDone.summary.color" class="orderForm_stepperCheck"/>
          <span class="orderForm_stepperTxt">Podsumowanie</span>
        </a>
      </li>
    </ul>
  </div>

  <div>
<!--    <nuxt-link-locale to="panel-new">Wersja druga</nuxt-link-locale>-->
  </div>

  <div>
    <div class="form_container form_container--orderForm">
      <div class="form_errorMessageAlert" id="errorMessageAlert" v-show="courierError?.message">
        <div class="form_errorMessageAlert--title">
          <NuxtImg src="icons/orderForm/checkError.png"/>
          <span>Uwaga!</span></div>
        <div class="form_errorMessageAlert--text">{{ courierError?.message }}</div>
        <ul v-for="(generated, key) in courierError?.data?.errors" v-if="typeof courierError?.data?.errors !== 'object'">
          <li class="form_errorMessageAlert--text" v-for="(message, key) in generated">Dla pola: {{ t('formFields.' +key)}} - {{message[0]}}</li>
        </ul>
        <span v-else class="form_errorMessageAlert--text" >{{ courierError?.data?.errors.auto_generated_0}}</span>
      </div>

      <div class="form_card" id="przesylka" v-on:mouseenter.stop="updateStatusForSection('packages', null)" v-on:mouseleave="updateStatusForSection('packages', true)">
        <div class="row">
          <div class="row row--alignStart row--baseline">
            <h2 class="form_title">Przesyłka</h2>
          </div>
        </div>
        <div class="row">
          <div v-if="packageTemplatesSelectOptions.length > 0" style="display: flex; justify-content: center; width: 300px">
            <InputFilterSelect
                :options="packageTemplatesSelectOptions"
                label="Wybierz szablon"
                v-model="selectedPackageForm"
                :base-value="selectedPackageForm"
            />
          </div>
        </div>
        <div class="form_firstSection">
          <div class="orderForm_col1">
            <div class="row">
              <h3 class="form_subtitle">Rodzaj przesyłki</h3>
            </div>

            <div class="row row--gap16 row--alignStart">
              <input type="radio" :id="'radio-package-1'+0" name="typPaczki" value="" class="form_radioInput"/>
              <label :for="'radio-package-1'+0"
                     class="form_parcelTypeRadioLabel"
                     @click.prevent="selectPackageDeliveryType('package')"
                     :style="isSelectedDeliveryType('package') ? 'border: 2px solid #4285F4;' : ''"
              >
                <NuxtImg src="icons/paczkaKalkulator.png" width="27px" height="26px"/>
                <span>Paczka</span>
              </label>

              <input type="radio" :id="'radio-envelope-2'+0" name="typPaczki" value="" class="form_radioInput"/>
              <label :for="'radio-envelope-2'+0"
                     class="form_parcelTypeRadioLabel"
                     @click.prevent="selectPackageDeliveryType('envelope')"
                     :style="isSelectedDeliveryType('envelope') ? 'border: 2px solid #4285F4;' : ''"
              >
                <NuxtImg src="icons/kopertaKalkulator.png" width="31px" height="19px" style="margin-bottom: 6px"/>
                <span>Koperta</span>
              </label>

              <input type="radio" :id="'radio-pallet-3'+0" name="typPaczki" value="" class="form_radioInput"/>
              <label :for="'radio-pallet-3'+0"
                     class="form_parcelTypeRadioLabel"
                     @click.prevent="selectPackageDeliveryType( 'pallet')"
                     :style="isSelectedDeliveryType('pallet') ? 'border: 2px solid #4285F4;' : ''"
              >
                <NuxtImg src="icons/paletaKalkulator.png" width="42px" height="23px"/>
                <span>Paleta</span>
              </label>

              <input type="radio" :id="'radio-nonstandard-4'+0" name="typPaczki" value="" class="form_radioInput"/>
              <label :for="'radio-nonstandard-4'+0"
                     class="form_parcelTypeRadioLabel"
                     @click.prevent="selectPackageDeliveryType( 'not_standard')"
                     :style="isSelectedDeliveryType('not_standard') ? 'border: 2px solid #4285F4;' : ''"
              >
                <NuxtImg src="icons/niestandardKalkulator.png" width="26px" height="26px"/>
                <span>Niestandardowa</span>
              </label>
            </div>
            <span v-if="v$.packages.CourierSearch.type.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
          </div>

          <div style="display: flex; flex-direction: column; width: 100%;">
            <div class="row">
              <div>
                <div class="row">
                  <h3 class="form_subtitle">Parametry paczki</h3>
                </div>

                <div class="row row--alignStart row--gap16">
                  <div class="form_inputContainer142 form_inputContainer142--wideMobile">
                    <label for="" class="form_label">Długość<i>*</i></label>

                    <div class="form_inputWithUnit" :class="v$.packages.CourierSearch.side_x.$error ? 'form_inputWithUnit--error' : ''">
                      <input type="text" v-model="form.packages.CourierSearch.side_x" class="form_inputTxt"
                        @change="updateCourierSearchField($event.target.value, 'side_x')"
                        v-no-letters
                      />
                      <span class="form_unitInfo">cm</span>
                    </div>
                    <span v-if="v$.packages.CourierSearch.side_x.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
                  </div>

                  <div class="form_inputContainer142 form_inputContainer142--wideMobile">
                    <label for="" class="form_label">Szerokość<i>*</i></label>
                    <div class="form_inputWithUnit" :class="v$.packages.CourierSearch.side_y.$error ? 'form_inputWithUnit--error' : ''">
                      <input type="text" v-model="form.packages.CourierSearch.side_y" class="form_inputTxt"
                             @change="updateCourierSearchField($event.target.value, 'side_y')"
                             v-no-letters
                      />
                      <span class="form_unitInfo">cm</span>
                    </div>
                    <span v-if="v$.packages.CourierSearch.side_y.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
                  </div>

                  <div class="form_inputContainer142 form_inputContainer142--wideMobile">
                    <label for="" class="form_label">Wysokość<i>*</i></label>
                    <div class="form_inputWithUnit" :class="v$.packages.CourierSearch.side_z.$error ? 'form_inputWithUnit--error' : ''">
                      <input type="text" v-model="form.packages.CourierSearch.side_z" class="form_inputTxt"
                             @change="updateCourierSearchField($event.target.value, 'side_z')"
                             v-no-letters
                      />
                      <span class="form_unitInfo">cm</span>
                    </div>
                    <span v-if="v$.packages.CourierSearch.side_z.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
                  </div>

                  <div class="form_inputContainer142 form_inputContainer142--wideMobile">
                    <label for="" class="form_label">Waga<i>*</i></label>
                    <div class="form_inputWithUnit" :class="v$.packages.CourierSearch.weight.$error ? 'form_inputWithUnit--error' : ''">
                      <input
                         type="text"
                         v-model="form.packages.CourierSearch.weight" class="form_inputTxt"
                         @change="updateCourierSearchField($event.target.value, 'weight');"
                         v-no-letters
                      />
                      <span class="form_unitInfo">kg</span>
                    </div>
                    <span v-if="v$.packages.CourierSearch.weight.maxValue.$invalid" class="signin_errorMsg signin_errorMsg--show">Maksymalna waga to {{weightMaxValue}}kg</span>
                    <span v-if="v$.packages.CourierSearch.weight.$error && !v$.packages.CourierSearch.weight.maxValue.$invalid" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
                  </div>
                </div>

                <div class="row row--alignStart row--gap16">
                  <div class="form_inputContainer300" v-show="getSortablesByPackageType.length > 0">
                    <label for="" class="form_subtitle form_subtitle--block">Kształt i rodzaj opakowania<i>*</i>
                      <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px"
                               @click="showInfoModalType = 'package_type'; showInfoModal = true"/>
                    </label>

                    <InputFilterSelect
                        :container-class="v$.packages.CourierSearch.sortable.$error ? 'form_inputContainer300 form_inputContainer300--error' : 'form_inputContainer300'"
                        v-if="getSortablesByPackageType.length > 1"
                        :options="getSortablesByPackageTypeOptions"
                        v-model="v$.packages.CourierSearch.sortable.$model"
                       @change="updateSortable($event)"
                        :value="form.packages.CourierSearch.sortable"
                        :base-value="form?.packages?.CourierSearch?.sortable"
                    />
                    <span v-else>{{ getSortablesByPackageType[0] ? getSortablesByPackageType[0].name : '' }}</span>
                    <span v-if="v$.packages.CourierSearch.sortable.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
                  </div>

                  <div class="form_inputContainer300">
                    <label for="" class="form_subtitle">Zawartość przesyłki<i>*</i></label>
                    <div class="form_inputWithUnit form_inputWithUnit--wrap"
                      :class="v$.packages.CourierSearch.package_content.$error ? 'form_inputWithUnit--error' : ''"
                    >
                      <input type="text" id="package_content" name="package_content"
                             :value="form.packages.CourierSearch.package_content"
                             @change="form.packages.CourierSearch.package_content = $event.target.value"
                             class="form_inputTxt form_inputTxt--withoutUnit"/>
                    </div>
                    <span v-if="v$.packages.CourierSearch.package_content.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
                  </div>
                </div>
              </div>

              <div class="row row--alignStart row--baseline row--gap16">
                <div class="form_inputContainer300 form_inputContainer300--gap16">
                  <InputCountrySelector :disabled="true"
                                        @country-change="(event) => updateCourierSearchField(event, 'postal_sender_country')"/>

                  <div class="form_inputContainer200 form_inputContainer200--postal">
                    <label for="" class="form_label">Kod pocztowy nadawcy<i>*</i></label>
                    <input type="text" id="" name="" :value="form.sender.vat_postal"
                           @change="form.sender.vat_postal = $event.target.value"
                           class="form_inputTxt form_inputTxt--withoutUnit"/>
                    <span v-if="v$.sender.vat_postal.required.$invalid" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
                    <span v-if="v$.sender.vat_postal.postalRegex.$invalid" class="signin_errorMsg signin_errorMsg--show">Poprawny format dla kodu pocztowego to XX-XXX</span>
                  </div>
                </div>

                <div class="form_inputContainer300 form_inputContainer300--gap16">
                  <InputCountrySelector
                      @country-change="(event) => {updateCourierSearchField(event.shortName, 'country_code'); form.recipient.country = event.shortName}"/>

                  <div class="form_inputContainer200 form_inputContainer200--postal">
                    <label for="" class="form_label">Kod pocztowy odbiorcy<i>*</i></label>
                    <input type="text" id="" name="" :value="form.recipient.taker_postal"
                           @change="form.recipient.taker_postal = $event.target.value; updateCourierSearchField($event.target.value, 'postal_delivery'); updateMapUrl"
                           class="form_inputTxt form_inputTxt--withoutUnit"/>
                    <span v-if="v$.recipient.taker_postal.required.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
                    <span v-if="v$.recipient.taker_postal.postalRegex.$invalid" class="signin_errorMsg signin_errorMsg--show">Poprawny format dla kodu pocztowego to XX-XXX</span>
                  </div>
                </div>
              </div>

              <div class="row row--alignStart row--gap16">
                <div class="form_inputContainer300">
                  <div class="row">
                    <h3 class="form_subtitle">Sposób nadania<i>*</i>
                      <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px"/>
                    </h3>
                  </div>

                  <div class="row row--gap16 row--orderForm">
                    <input type="radio" id="radio50" name="typeOfSending" class="form_radioInput"
                           @change="updatePickup(false)" :checked="form.sender.no_pickup === false"/>
                    <label for="radio50" class="form_radioLabelTile form_radioLabelTile--wideMobile">odbiór przez kuriera</label>

                    <input type="radio" id="radio51" name="typeOfSending" class="form_radioInput" @change="updatePickup(true)"
                           v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')"
                           :checked="form.sender.no_pickup === true"/>
                    <label for="radio51" class="form_radioLabelTile form_radioLabelTile--wideMobile"
                           v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')"
                    >dostarczę przesyłkę do punktu</label>
                    <span
                        v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')"
                        v-if="v$.sender.no_pickup.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
                  </div>
                </div>

                <div class="form_inputContainer300">
                  <div class="row">
                    <h3 class="form_subtitle">Sposób doręczenia<i>*</i></h3>
                  </div>

                  <div class="row row--gap16 row--orderForm">
                    <input type="radio" id="radio40" name="typeDelivery" value="" class="form_radioInput"
                           @change="form.recipient.delivery_type = 'to_door'"
                           :checked="form.recipient.delivery_type === 'to_door'"/>
                    <label for="radio40" class="form_radioLabelTile form_radioLabelTile--wideMobile">kurier</label>

                    <input type="radio" id="radio41" name="typeDelivery" value="" class="form_radioInput"
                           v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')"
                           @change="form.recipient.delivery_type = 'to_point'; showMap = true"
                           :checked="form.recipient.delivery_type === 'to_point'"/>
                    <label for="radio41" class="form_radioLabelTile form_radioLabelTile--wideMobile"
                           v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')"
                    >punkt odbioru</label>
                    <span
                        v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')"
                        v-if="v$.recipient.delivery_type.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="row row--orderForm" v-for="(formPackage, index) in form.packages.SearchParcel" :key="indexOld">

              <div>
                <div class="row">
                  <h3 class="form_subtitle">Parametry paczki</h3>
                </div>

                <div class="row row--alignStart row--gap16">
                  <div class="form_inputContainer142 form_inputContainer142--wideMobile">
                    <label for="" class="form_label">Długość</label>
                    <div class="form_inputWithUnit ">
                      <input type="text" v-model="formPackage.side_x" class="form_inputTxt"
                             @change="updatePackageField(indexOld, 'side_x', $event.target.value)" v-no-letters/>
                      <span class="form_unitInfo">cm</span>
                    </div>
                  </div>

                  <div class="form_inputContainer142 form_inputContainer142--wideMobile">
                    <label for="" class="form_label">Szerokość</label>
                    <div class="form_inputWithUnit">
                      <input type="text" v-model="formPackage.side_y" class="form_inputTxt"
                             @change="updatePackageField(indexOld, 'side_y', $event.target.value)" v-no-letters/>
                      <span class="form_unitInfo">cm</span>
                    </div>
                  </div>

                  <div class="form_inputContainer142 form_inputContainer142--wideMobile">
                    <label for="" class="form_label">Wysokość</label>
                    <div class="form_inputWithUnit">
                      <input type="text" v-model="formPackage.side_z" class="form_inputTxt"
                             @change="updatePackageField(indexOld, 'side_z', $event.target.value)" v-no-letters/>
                      <span class="form_unitInfo">cm</span>
                    </div>
                  </div>

                  <div class="form_inputContainer142 form_inputContainer142--wideMobile">
                    <label for="" class="form_label">Waga</label>
                    <div class="form_inputWithUnit">
                      <input type="text" v-model="formPackage.weight" class="form_inputTxt"
                             @change="updatePackageField(indexOld, 'weight', $event.target.value)" v-no-letters/>
                      <span class="form_unitInfo">kg</span>
                    </div>
                  </div>
                </div>

                <div class="row row--alignStart row--gap16" v-show="getSortablesByPackageType.length > 0">
                  <div class="form_inputContainer300">
                    <label for="" class="form_subtitle form_subtitle--block">Kształt i rodzaj opakowania<i>*</i>
                      <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px"
                               @click="showInfoModalType = 'package_type'; showInfoModal = true"/>
                    </label>

                    <InputFilterSelect
                        v-if="getSortablesByPackageType.length > 1"
                        :base-value="formPackage.sortable"
                        :options="getSortablesByPackageTypeOptions"
                        @change="updatePackageField(indexOld, 'sortable', $event)"
                    />
                    <span v-else>{{ getSortablesByPackageType[0] ? getSortablesByPackageType[0].name : '' }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row row--orderForm">
          <button class="form_buttonSecondary" @click.prevent="addEmptyPackage()">Dodaj kolejną paczkę</button>
          <button class="form_buttonDanger" @click.prevent="deleteLastPackage()"
                  v-show="form.packages.SearchParcel.length > 0">Usuń paczkę z zamówienia
          </button>
        </div>
      </div>

      <div class="form_card" id="nadanie" v-on:mouseenter.stop="updateStatusForSection('sender', null)"
           v-on:mouseleave="updateStatusForSection('sender', true)">
        <div class="row">
          <h2 class="form_title">Nadanie</h2>
        </div>

        <div class="row row--orderForm">
          <div class="row row--alignStart row--baseline">
            <h3 class="form_subtitle">Dane nadawcy
              <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px"
                       @click="showInfoModalType = 'sender_details'; showInfoModal = true"/>
            </h3>
            <span class="form_infoTxt form_infoTxt--marginLeft"><button style="text-decoration: underline;"
                @click.prevent="openShowAddressBookModal('sender')">Pobierz z książki adresowej</button></span>
          </div>

          <div class="row row--alignStart row--baseline row--gap16">
            <div class="form_inputContainer300">
              <label for="" class="form_label">Imię i nazwisko<i>*</i></label>
              <input type="text" id="" name="" :value="form.sender.name"
                     @change="form.sender.name = $event.target.value" class="form_inputTxt form_inputTxt--withoutUnit"/>
              <span v-if="v$.sender.name.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
            </div>

            <div class="form_inputContainer300">
              <label for="" class="form_label">Nazwa firmy</label>
              <input type="text" id="" name="" :value="form.sender.vat_company"
                     @change="form.sender.vat_company = $event.target.value"
                     class="form_inputTxt form_inputTxt--withoutUnit"/>
              <span v-if="v$.sender.vat_company.$error"
                    class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
            </div>
          </div>

          <div class="row row--alignStart row--baseline row--gap16">
            <div class="form_inputContainer300">
              <label for="" class="form_label">Ulica<i>*</i></label>
              <input type="text" id="" name="" :value="form.sender.vat_street"
                     @change="form.sender.vat_street = $event.target.value"
                     class="form_inputTxt form_inputTxt--withoutUnit"/>
              <span v-if="v$.sender.vat_street.$error"
                    class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
            </div>

            <div class="form_inputContainer142 form_inputContainer142--wideMobile">
              <label for="" class="form_label">Numer budynku<i>*</i></label>
              <input type="text" id="" name="" :value="form.sender.vat_house_no"
                     @change="form.sender.vat_house_no = $event.target.value"
                     class="form_inputTxt form_inputTxt--withoutUnit" />
              <span v-if="v$.sender.vat_house_no.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
            </div>

            <div class="form_inputContainer142 form_inputContainer142--wideMobile">
              <label for="" class="form_label">Numer mieszkania</label>
              <input type="text" id="" name="" :value="form.sender.vat_locum_no"
                     @change="form.sender.vat_locum_no = $event.target.value"
                     class="form_inputTxt form_inputTxt--withoutUnit" />
              <span v-if="v$.sender.vat_locum_no.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
            </div>
          </div>

          <div class="row row--alignStart row--baseline row--gap16">
            <InputCountrySelector :disabled="true"
                                  @country-change="(event) => updateCourierSearchField(event, 'postal_sender_country')"/>

            <div class="form_inputContainer200 form_inputContainer200--postal">
              <label for="" class="form_label">Kod pocztowy<i>*</i></label>
              <input type="text" id="" name="" :value="form.sender.vat_postal"
                     v-maska="'##-###'"
                     @change="form.sender.vat_postal = $event.target.value"
                     class="form_inputTxt form_inputTxt--withoutUnit"/>
              <span v-if="v$.sender.vat_postal.required.$invalid" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
              <span v-if="v$.sender.vat_postal.postalRegex.$invalid" class="signin_errorMsg signin_errorMsg--show">Poprawny format dla kodu pocztowego to XX-XXX</span>
            </div>

            <div class="form_inputContainer300">
              <label for="" class="form_label">Miasto<i>*</i></label>
              <input type="text" id="" name="" :value="form.sender.vat_city"
                     @change="form.sender.vat_city = $event.target.value"
                     class="form_inputTxt form_inputTxt--withoutUnit"/>
              <span v-if="v$.sender.vat_city.$error"
                    class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
            </div>
          </div>

          <div class="row row--alignStart row--baseline row--gap16">
            <div class="form_inputContainer300">
              <label for="" class="form_label">Adres e-mail<i>*</i></label>
              <input type="text" id="" name="" :value="form.sender.email"
                     @change="form.sender.email = $event.target.value"
                     class="form_inputTxt form_inputTxt--withoutUnit"/>
              <span v-if="v$.sender.email.$error"
                    class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
            </div>

            <div class="form_inputContainer300">
              <label for="" class="form_label">Numer telefonu<i>*</i></label>
              <input type="text" id="" name="" :value="form.sender.phone"
                     @change="form.sender.phone = $event.target.value"
                     class="form_inputTxt form_inputTxt--withoutUnit" v-no-letters/>
              <span v-if="v$.sender.phone.$error"
                    class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="orderForm_col1">
            <div class="row">
              <h3 class="form_subtitle">Sposób nadania<i>*</i>
                <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px"/>
              </h3>
            </div>

            <div class="row row--gap16 row--orderForm">
              <input type="radio" id="radio50" name="typeOfSending" class="form_radioInput"
                     @change="updatePickup(false)" :checked="form.sender.no_pickup === false"/>
              <label for="radio50" class="form_radioLabelTile form_radioLabelTile--wideMobile">odbiór przez kuriera</label>

              <input type="radio" id="radio51" name="typeOfSending" class="form_radioInput" @change="updatePickup(true)"
                     v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')"
                     :checked="form.sender.no_pickup === true"/>
              <label for="radio51" class="form_radioLabelTile form_radioLabelTile--wideMobile"
                     v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')"
              >dostarczę przesyłkę do punktu</label>
              <span
                  v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')"
                  v-if="v$.sender.no_pickup.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
            </div>
          </div>
          <div class="form_deliveryContainer" v-if="form.sender.no_pickup == false">
            <h3 class="form_subtitle">Data przyjazdu kuriera:</h3>
            <div class="row row--gap16 row--orderForm">
              <InputFilterDatepicker
                  label="Data odbioru"
                  :disable-year-select="false"
                  :min-date="minOrderDate"
                  :max-date="maxOrderDate"
                  :disabled-week-days="[0, 6]"
                  :max-time="{}"
                  @change="onDateChange($event)"
                  :value="form?.pickup?.pickup_date"
              />
              <div class="form_inputContainer200">
                <label class="form_label">Godzina odbioru od:</label>
                <VueDatePicker
                    :min-time="form?.pickup?.pickup_date === minOrderDate ? startTime : minTime"
                    :max-time="calculateMaxReadyTime(maxTime, minDiff)"
                    :date-format="'HH:ii'"
                    cancelText="Anuluj"
                    selectText="Wybierz"
                    :start-time="form?.pickup?.pickup_date === minOrderDate ? startTime : minTime"
                    @update:model-value="updatePickupReadyTime($event, minDiff)"
                    v-model="form.pickup.pickup_ready_time" time-picker/>
              </div>
              <div class="form_inputContainer200">
                <label class="form_label">Godzina odbioru do:</label>
                <VueDatePicker
                    :min-time="calculateMinCloseTime(minOrderDate, startTime, minTime, minDiff)"
                    :max-time="maxTime"
                    :date-format="'HH:ii'"
                    cancelText="Anuluj"
                    selectText="Wybierz"
                    :start-time="maxTime"
                    @update:model-value="form.pickup.pickup_close_time = $event"
                    v-model="form.pickup.pickup_close_time" time-picker/>
              </div>
            </div>
            <span class="form_label">Termin przyjazdu kuriera zależy od ich dostępności w danym rejonie.</span>
          </div>
        </div>
      </div>

      <div class="form_card" id="doreczenie" v-on:mouseenter.stop="updateStatusForSection('recipient', null)"
           v-on:mouseleave="updateStatusForSection('recipient', true)">
        <div class="row">
          <h2 class="form_title">Doręczenie</h2>
        </div>

        <div class="row row--orderForm">
          <div class="row row--alignStart row--baseline">
            <h3 class="form_subtitle">Dane odbiorcy
              <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px"
                       @click="showInfoModalType = 'recipient_details'; showInfoModal = true"/>
            </h3>
            <span class="form_infoTxt form_infoTxt--marginLeft">
              <button style="text-decoration: underline;"
               @click.prevent="openShowAddressBookModal('recipient')">Pobierz z książki adresowej</button>
            </span>
          </div>

          <div class="row row--alignStart row--baseline row--gap16">
            <div class="form_inputContainer300">
              <label for="" class="form_label">Imię i nazwisko<i>*</i></label>
              <input type="text" id="" name="" :value="form.recipient.taker_name"
                     @change="form.recipient.taker_name = $event.target.value"
                     class="form_inputTxt form_inputTxt--withoutUnit"/>
              <span v-if="v$.recipient.taker_name.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
            </div>

            <div class="form_inputContainer300">
              <label for="" class="form_label">Nazwa firmy</label>
              <input type="text" id="" name="" :value="form.recipient.taker_vat_company"
                     @change="form.recipient.taker_vat_company = $event.target.value"
                     class="form_inputTxt form_inputTxt--withoutUnit"/>
            </div>
          </div>

          <div class="row row--alignStart row--baseline row--gap16">
            <div class="form_inputContainer300">
              <label for="" class="form_label">Ulica<i>*</i></label>
              <input type="text" id="" name="" :value="form.recipient.taker_street"
                     @change="form.recipient.taker_street = $event.target.value"
                     class="form_inputTxt form_inputTxt--withoutUnit"/>
              <span v-if="v$.recipient.taker_street.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
            </div>

            <div class="form_inputContainer142 form_inputContainer142--wideMobile">
              <label for="" class="form_label">Numer budynku<i>*</i></label>
              <input type="text" id="" name="" :value="form.recipient.taker_house_no"
                     @change="form.recipient.taker_house_no = $event.target.value"
                     class="form_inputTxt form_inputTxt--withoutUnit" />
              <span v-if="v$.recipient.taker_house_no.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
            </div>

            <div class="form_inputContainer142 form_inputContainer142--wideMobile">
              <label for="" class="form_label">Numer mieszkania</label>
              <input type="text" id="" name="" :value="form.recipient.taker_locum_no"
                     @change="form.recipient.taker_locum_no = $event.target.value"
                     class="form_inputTxt form_inputTxt--withoutUnit" />
            </div>
          </div>

          <div class="row row--alignStart row--baseline row--gap16">
            <InputCountrySelector :byShortName="form.recipient.country"
                @country-change="(event) => {updateCourierSearchField(event.shortName, 'country_code'); form.recipient.country = event.shortName}"/>

            <div class="form_inputContainer200 form_inputContainer200--postal">
              <label for="" class="form_label">Kod pocztowy<i>*</i></label>
              <input type="text" id="" name="" :value="form.recipient.taker_postal"
                     @change="form.recipient.taker_postal = $event.target.value; updateCourierSearchField($event.target.value, 'postal_delivery'); updateMapUrl"
                     class="form_inputTxt form_inputTxt--withoutUnit"/>
              <span v-if="v$.recipient.taker_postal.required.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
              <span v-if="v$.recipient.taker_postal.postalRegex.$invalid" class="signin_errorMsg signin_errorMsg--show">Poprawny format dla kodu pocztowego to XX-XXX</span>
            </div>

            <div class="form_inputContainer300">
              <label for="" class="form_label">Miasto<i>*</i></label>
              <input type="text" id="" name="" :value="form.recipient.taker_city"
                     @change="form.recipient.taker_city = $event.target.value"
                     class="form_inputTxt form_inputTxt--withoutUnit"/>
              <span v-if="v$.recipient.taker_city.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
            </div>
          </div>

          <div class="row row--alignStart row--baseline row--gap16">
            <div class="form_inputContainer300">
              <label for="" class="form_label">Adres e-mail<i>*</i></label>
              <input type="text" id="" name="" :value="form.recipient.taker_email"
                     @change="form.recipient.taker_email = $event.target.value"
                     class="form_inputTxt form_inputTxt--withoutUnit"/>
              <span v-if="v$.recipient.taker_email.$error && v$.recipient.taker_email.required.$invalid"
                    class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
              <span v-if="v$.recipient.taker_email.email.$invalid" class="signin_errorMsg signin_errorMsg--show">Pole jest niepoprawnym adresem E-mail</span>
            </div>

            <div class="form_inputContainer300">
              <label for="" class="form_label">Numer telefonu<i>*</i></label>
              <input type="text" id="" name="" :value="form.recipient.taker_phone"
                     @change="form.recipient.taker_phone = $event.target.value"
                     class="form_inputTxt form_inputTxt--withoutUnit" v-no-letters/>
              <span v-if="v$.recipient.taker_phone.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
            </div>
          </div>

          <div class="row row--alignStart row--baseline row--gap16">
            <div class="form_inputContainer300" v-if="countriesRequiredState.includes(form.packages.CourierSearch.country_code)">
              <label for="" class="form_label">Stan/Prowincja<i>*</i></label>
              <input type="text" id="" name="" :value="form.recipient.state"
                     @change="form.recipient.state = $event.target.value"
                     class="form_inputTxt form_inputTxt--withoutUnit"/>
              <span v-if="v$.recipient.state.$error"
                    class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="orderForm_col1">
            <div class="row">
              <h3 class="form_subtitle">Sposób doręczenia<i>*</i></h3>
            </div>

            <div class="row row--gap16 row--orderForm">
              <input type="radio" id="radio40" name="typeDelivery" value="" class="form_radioInput"
                     @change="form.recipient.delivery_type = 'to_door'"
                     :checked="form.recipient.delivery_type === 'to_door'"/>
              <label for="radio40" class="form_radioLabelTile form_radioLabelTile--wideMobile">kurier</label>

              <input type="radio" id="radio41" name="typeDelivery" value="" class="form_radioInput"
                     v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')"
                     @change="form.recipient.delivery_type = 'to_point'; showMap = true"
                     :checked="form.recipient.delivery_type === 'to_point'"/>
              <label for="radio41" class="form_radioLabelTile form_radioLabelTile--wideMobile"
                     v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')"
              >punkt odbioru</label>
              <span
                  v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')"
                  v-if="v$.recipient.delivery_type.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="form_deliveryContainer" v-if="form.recipient.delivery_type === 'to_point'">
            <h3 class="form_subtitle">Wybrany punkt:</h3>
            <div style="margin-bottom: 16px">
              <span class="form_deliveryTxt">Nazwa punktu: {{ previewPoint?.pointApiName ?? '-' }}</span>
              <span class="form_deliveryTxt">Miasto: {{ previewPoint?.city ?? '-' }}</span>
              <span class="form_deliveryTxt">Kod punktu: {{ selectedPoint ?? '-' }}</span>
            </div>
            <button class="form_buttonSecondary form_buttonSecondary--marginBottom16" v-show="selectedPoint && !showMap"
                    @click.prevent="showMap = true; form.taker_point = null; selectedPoint = null">Wybierz inny punkt
            </button>

            <div class="form_iframe" v-show="showMap">
              <div class="form_inputContainer300">
                <label for="" class="form_label">Wyszukaj kod punktu</label>
                <input type="text" id="" name="" :value="form.taker_point"
                       @change="form.taker_point = $event.target.value"
                       class="form_inputTxt form_inputTxt--withoutUnit"/>
                <span v-if="v$.recipient.taker_city.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
              </div>
              <iframe :src="mapUrl" style="width: 100%; height: 400px" class="form_iframe"/>
            </div>
          </div>
        </div>
      </div>

      <div class="form_card" id="uslugi" v-on:mouseenter.stop="updateStatusForSection('services', null)"
           v-on:mouseleave.stop="updateStatusForSection('services', null)">
        <div class="row">
          <h2 class="form_title">Usługi</h2>
        </div>

        <div class="row row--orderForm">
          <div class="form_inputContainer300">
            <label for="" class="form_label">Ubezpieczenie
              <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px"
                       @click.prevent="showInfoModalType = 'insurance'; showInfoModal = true"/>
            </label>
            <div class="form_inputWithUnit">
              <input type="text" id="" name="cover" class="form_inputTxt" :value="form.services.cover"
                     inputmode="numeric"
                     v-maska="'0.99'"
                     data-maska-tokens="0:\d:multiple|9:\d:optional"
                     @change="updateCourierSearchField($event.target.value == '' ? 0 : $event.target.value, 'cover'); form.services.cover = $event.target.value == '' ? 0 : $event.target.value" v-no-letters/>
              <span class="form_unitInfo">zł</span>
            </div>
          </div>

          <div class="form_inputContainer300">
            <label for="" class="form_label">Pobranie
              <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px"
                       @click.prevent="showInfoModalType = 'uptake'; showInfoModal = true"/>
            </label>
            <div class="form_inputWithUnit">
              <input type="text" id="" name="uptake" class="form_inputTxt" :value="form.services.uptake"
                     inputmode="numeric"
                     v-maska="'0.99'"
                     data-maska-tokens="0:\d:multiple|9:\d:optional"
                     @change="updateCourierSearchField($event.target.value == '' ? 0 : $event.target.value, 'uptake'); form.services.uptake = $event.target.value == '' ? 0 : $event.target.value" v-no-letters/>
              <span class="form_unitInfo">zł</span>
            </div>
          </div>

          <div class="row row--checkboxContainer"
               v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')">
            <input type="checkbox" id="usluga1" name="usluga1"
                   @change="updateCourierSearchField($event.target.checked, 'inpost_weekend'); form.services.inpost_weekend = $event.target.checked"
                   :checked="form.services.inpost_weekend"/>
            <label for="usluga1" class="form_checkboxLabel">Paczka w weekend (InPost)</label>
          </div>

          <div class="row row--gap16" v-show="isSelectedDeliveryType('pallet') && form.courier?.Courier?.private_delivery_fee === true">
            <div class="row row--checkboxContainer">
              <input
                  type="radio"
                  id ="usluga2_private"
                  value="true"
                  name="delivery_private"
                  @change="form.services.delivery_private = true"
                  :checked="form.services.delivery_private === true"
              />
              <label for="usluga2_private" class="form_checkboxLabel">Adres prywatny</label>
            </div>

            <div class="row row--checkboxContainer">
              <input
                  type="radio"
                  id="usluga2_business"
                  value="false"
                  name="delivery_private"
                  @change="form.services.delivery_private = false; form.services.taker_vat_number = null"
                  :checked="form.services.delivery_private === false"
              />
              <label for="usluga2_business" class="form_checkboxLabel">Adres firmowy
                <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px"
                         @click="showInfoModalType = 'delivery_private'; showInfoModal = true"/>
              </label>
            </div>

            <div class="row form_inputContainer300" v-show="form.services.delivery_private === false">
              <label for="" class="form_label">Numer NIP<i>*</i></label>
              <input type="text" id="" name="" :value="form.services.taker_vat_number"
                     @change="form.services.taker_vat_number = $event.target.value"
                     class="form_inputTxt form_inputTxt--withoutUnit"/>
              <span v-if="v$.services.taker_vat_number.$error && v$.services.taker_vat_number.requiredIf.$invalid" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
              <span v-show="v$.services.taker_vat_number.$errors?.find(error => error.$validator == 'customNipValidator')" class="calc_errorMsg calc_errorMsg--show">{{ v$.services.taker_vat_number.customNipValidator.$message }}</span>
            </div>
          </div>

          <div class="row row--checkboxContainer" v-show="isSelectedDeliveryType('pallet')">
            <input type="checkbox" id="usluga3" name="usluga3"
                   @change="updateCourierSearchField($event.target.checked, 'return_pallet'); form.services.return_pallet = $event.target.checked"
                   :checked="form.services.return_pallet"/>
            <label for="usluga3" class="form_checkboxLabel">Zwrot palet</label>
          </div>

          <div class="row row--checkboxContainer" v-show="isSelectedDeliveryType('not_standard')">
            <input type="checkbox" id="usluga4" name="usluga4"
                   @change="updateCourierSearchField($event.target.checked, 'bringing'); form.services.bringing = $event.target.checked"/>
            <label for="usluga4" class="form_checkboxLabel">Wniesienie</label>
          </div>

          <div class="row row--checkboxContainer" v-show="isSelectedDeliveryType('not_standard')">
            <input type="checkbox" id="usluga5" name="usluga5"
                   @change="updateCourierSearchField($event.target.checked, 'bringing_and_unpack'); form.services.bringing_and_unpack = $event.target.checked"/>
            <label for="usluga5" class="form_checkboxLabel">Wniesienie i rozpakowanie</label>
          </div>
        </div>

        <!--        na razie nie usuwać z kodu zakomentowanego fragmentu, poczekajmy na decyzję Marcinów-->
        <!--        <div class="row">-->
        <!--          <span class="calc_showMore">Pokaż wszystkie usługi dodatkowe <NuxtImg src="icons/greyArrowDown.png"/></span>-->
        <!--        </div>-->
      </div>

      <div class="form_card" id="kurier" ref="valuationVisible"
           v-on:mouseleave="updateStatusForSection('courier', null)"
           v-on:mouseenter.stop="updateStatusForSection('courier', null)">
        <div class="row">
          <h2 class="form_title">Kurier <span class="form_subtitleSmall">Podano ceny netto (bez VAT) z wliczoną opłatą paliwową/drogową<NuxtImg
              src="icons/tooltipIcon.png" width="11px" height="11px"
              style="margin-left: 5px; width: 11px; height: 11px;"
              @click.prevent="showInfoModalType = 'courier'; showInfoModal = true"/></span></h2>
        </div>

        <div class="row row--noWarp">
          <div class="row row--gap16 orderForm_couriersRow"
               v-if="valuationResults?.data?.results && valuationResults.data.results.length > 0">
            <div v-for="(result, index) in valuationResultsWhole">
              <input type="radio" :id="'radio-'+indexOld" name="kurier" value="" class="calc_courierRadio"/>
              <label :for="'radio-'+indexOld" class="calc_pricingRadioLabel" @click="selectCourierPrice(result)"
                     :style="form?.courier?.Courier?.id === result.Courier.id ? 'border: 2px solid #4285F4;' : 'border: 2px solid #BDD4F2;'"
              >
                <div class="calc_courierImgWrapper">
                  <NuxtImg :src="result.Courier.logo" width="50" height="" class="calc_courierImg"/>
                </div>
                <span class="calc_courierName">{{ result.Courier.name }}</span>
                <span class="calc_courierPrice" :style="form?.courier?.Courier?.id === result.Courier.id ? 'background-color: #4285F4; color: #ffffff' : 'background-color: #BDD4F2; color: #262B44;'">{{ result.Price.netto }} zł</span>
              </label>
            </div>
          </div>
          <div class="row row--gap16 orderForm_couriersRow" v-else>
            <span v-if="valuationResults?.message">{{ valuationResults?.message }}</span>
            <span class="form_subtitle"
                  v-else>Wypełnij wszystkie wymagane pola, aby zobaczyć dostępne oferty kuriera.</span>
          </div>
<!--          <label class="switch">-->
<!--            <input type="checkbox" :checked="showStickValuation" @change.prevent="showStickValuation = $event.target.checked">-->
<!--            <span class="slider round"></span>-->
<!--          </label>-->
        </div>

<!--        <div class="row">-->
<!--          <span class="form_showMore"-->
<!--                v-show="valuationResults?.data?.results && valuationResults.data.results.length > 0"-->
<!--                @click.prevent="valuationShowMore = !valuationShowMore">-->
<!--            Pokaż {{ valuationShowMore ? 'mniej' : 'więcej' }} kurierów-->
<!--            <NuxtImg src="icons/greyArrowDown.png" :style=" valuationShowMore ? 'rotate: 180deg' : ''"/>-->
<!--          </span>-->
<!--        </div>-->
      </div>

      <div class="orderForm_card" id="podsumowanie" ref="summaryVisible"
           v-on:mouseenter.stop="updateStatusForSection('summary', null)">
        <div class="row">
          <h2 class="calc_title">Podsumowanie</h2>
        </div>

        <div class="orderForm_summaryCard">
          <div class="orderForm_summaryHeader">
            <h3 class="orderForm_summaryTitle">
              <IconStatus :color="sectionsDone.packages.color" class="orderForm_summaryCheck"/>
              <!--              <NuxtImg :src="sectionsDone.packages ? 'icons/orderForm/checkGreen.png' : 'icons/orderForm/checkGrey.png'" width="23px" height="23px" class="orderForm_summaryCheck"/>-->
              Przesyłka
            </h3>
          </div>
          <div class="orderForm_summaryContent">
            <span class="orderForm_summaryTxt">Rodzaj przesyłki:
              {{ form.packages.CourierSearch.type == 'package' ? 'Paczka' : '' }}
              {{ form.packages.CourierSearch.type == 'envelope' ? 'Koperta' : '' }}
              {{ form.packages.CourierSearch.type == 'pallet' ? 'Paleta' : '' }}
            </span>
            <span
                class="orderForm_summaryTxt">Wymiary: {{ form.packages.CourierSearch.side_x ?? '0' }}x{{ form.packages.CourierSearch.side_y ?? '0' }}x{{
                form.packages.CourierSearch.side_z ?? '0'
              }}cm</span>
            <span v-for="(item, index) in form.packages.SearchParcel"
                  class="orderForm_summaryTxt">Wymiary: {{ item.side_x ?? '0' }}x{{ item.side_y ?? '0' }}x{{
                item.side_z ?? '0'
              }}cm</span>
          </div>
        </div>

        <div class="orderForm_summaryCard">
          <div class="orderForm_summaryHeader">
            <h3 class="orderForm_summaryTitle">
              <IconStatus :color="sectionsDone.sender.color" class="orderForm_summaryCheck"/>
              Nadanie
            </h3>
          </div>
          <div class="orderForm_summaryContent">
            <span class="orderForm_summaryTxt" v-show="form.sender.name">Imię i nazwisko: {{ form.sender.name }}</span>
            <span class="orderForm_summaryTxt" v-show="form.sender.vat_company">Nazwa firmy: {{
                form.sender.vat_company
              }}</span>
            <span class="orderForm_summaryTxt" v-show="form.sender.vat_postal">Kod pocztowy: {{
                form.sender.vat_postal
              }}</span>
            <span class="orderForm_summaryTxt" v-show="form.sender.vat_city">Miasto: {{ form.sender.vat_city }}</span>
            <span class="orderForm_summaryTxt" v-show="form.sender.vat_street">Ulica: {{
                form.sender.vat_street
              }}</span>
            <span class="orderForm_summaryTxt"
                  v-show="form.sender.vat_house_no">Numer budynku: {{ form.sender.vat_house_no }}</span>
            <span class="orderForm_summaryTxt"
                  v-show="form.sender.vat_locum_no">Numer mieszkania: {{ form.sender.vat_locum_no }}</span>
          </div>
        </div>

        <div class="orderForm_summaryCard">
          <div class="orderForm_summaryHeader">
            <h3 class="orderForm_summaryTitle">
              <IconStatus :color="sectionsDone.recipient.color" class="orderForm_summaryCheck"/>
              Doręczenie
            </h3>
          </div>
          <div class="orderForm_summaryContent">
            <span class="orderForm_summaryTxt"
                  v-show="form.recipient.taker_name">Imię i nazwisko: {{ form.recipient.taker_name }}</span>
            <span class="orderForm_summaryTxt"
                  v-show="form.recipient.taker_vat_company">Nazwa firmy: {{ form.recipient.taker_vat_company }}</span>
            <span class="orderForm_summaryTxt" v-show="form.recipient.country">Kraj: {{ form.recipient.country }}</span>
            <span class="orderForm_summaryTxt"
                  v-show="form.recipient.taker_postal">Kod pocztowy: {{ form.recipient.taker_postal }}</span>
            <span class="orderForm_summaryTxt" v-show="form.recipient.taker_city">Miasto: {{
                form.recipient.taker_city
              }}</span>
            <span class="orderForm_summaryTxt"
                  v-show="form.recipient.taker_street">Ulica: {{ form.recipient.taker_street }}</span>
            <span class="orderForm_summaryTxt"
                  v-show="form.recipient.taker_house_no">Numer budynku: {{ form.recipient.taker_house_no }}</span>
            <span class="orderForm_summaryTxt"
                  v-show="form.recipient.taker_locum_no">Numer mieszkania: {{ form.recipient.taker_locum_no }}</span>
          </div>
        </div>

        <div class="orderForm_summaryCard">
          <div class="orderForm_summaryHeader">
            <h3 class="orderForm_summaryTitle">
              <IconStatus :color="sectionsDone.services.color" class="orderForm_summaryCheck"/>
              Usługi
            </h3>
          </div>
          <div class="orderForm_summaryContent">
            <span
                class="orderForm_summaryTxt">Ubezpieczenie: {{ form.services.cover ? form.services.cover + ' zł' : '0,00 zł' }}</span>
            <span
                class="orderForm_summaryTxt">Pobranie: {{ form.services.uptake ? form.services.uptake + ' zł' : '0,00 zł' }}</span>
            <span class="orderForm_summaryTxt" v-show="isSelectedDeliveryType('package') || isSelectedDeliveryType('envelope')">Paczka w weekend: {{form.services.inpost_weekend ? 'Tak' : 'Nie'}}</span>
            <span class="orderForm_summaryTxt" v-show="isSelectedDeliveryType('pallet')">Adres prywatny: {{ form.services.delivery_private ? 'Tak' : 'Nie' }}</span>
            <span class="orderForm_summaryTxt" v-show="isSelectedDeliveryType('pallet')">Zwrot palet: {{ form.services.return_pallet ? 'Tak' : 'Nie' }}</span>
            <span class="orderForm_summaryTxt" v-show="isSelectedDeliveryType('not_standard')">Wniesienie: {{ form.services.bringing ? 'Tak' : 'Nie' }}</span>
            <span class="orderForm_summaryTxt" v-show="isSelectedDeliveryType('not_standard')">Wniesienie i rozpakowanie: {{ form.services.bringing_and_unpack ? 'Tak' : 'Nie' }}</span>
          </div>
        </div>

        <div class="orderForm_summaryCard">
          <div class="orderForm_summaryHeader">
            <h3 class="orderForm_summaryTitle">
              <IconStatus :color="sectionsDone.courier.color" class="orderForm_summaryCheck"/>
              Kurier
            </h3>
          </div>
          <div class="orderForm_summaryContent">
            <span class="orderForm_summaryTxt" v-if="form?.courier?.Courier?.name">Nazwa: {{
                form.courier.Courier.name
              }}</span>
            <span class="orderForm_summaryTxt" v-if="form?.courier?.Price?.netto">Kwota netto: {{ form.courier.Price.netto }} zł</span>
            <span class="orderForm_summaryTxt" v-if="form?.courier?.Price?.value">Kwota brutto: {{ form.courier.Price.value }} zł</span>
            <span class="orderForm_summaryTxt" v-if="form?.courier?.Price?.cover">Kwota ubezpieczenia: {{ form.courier.Price.cover }} zł</span>
            <span class="orderForm_summaryTxt" v-if="form?.courier?.Price?.cod">Kwota COD: {{ form.courier.Price.cod }} zł</span>
            <span class="orderForm_summaryTxt" v-if="!form?.courier?.Courier?.name && !form?.courier?.Price?.value">Brak wybranego kuriera</span>
            <span class="orderForm_summaryTxt orderForm_summaryTxt--bold orderForm_summaryTxt--large" style="margin-top: 10px;"
                  v-if="form?.courier?.Courier?.desc" v-html="form.courier.Courier.desc">
            </span>
          </div>
        </div>

        <!--        <div class="orderForm_promoCodeWrapper">-->
        <!--          <div class="form_inputContainer200">-->
        <!--            <label for="" class="form_subtitle">Kod rabatowy</label>-->
        <!--            <input type="text" id="" name="" class="form_inputTxt form_inputTxt&#45;&#45;withoutUnit" @change="form.promoCode = $event.target.value" :value="form.promoCode"/>-->
        <!--          </div>-->

        <!--          <button class="form_buttonSecondary form_buttonSecondary&#45;&#45;marginBottom16" @click.stop="">Użyj kodu</button>-->
        <!--        </div>-->

        <div class="row">
          <div class="orderForm_priceContainer">
            <span class="orderForm_priceHeader" style="margin-bottom: 10px;">Kwota netto: <span class="orderForm_price">{{ form.courier?.Price?.netto ?? '0,00' }} zł</span></span>
            <span class="orderForm_priceHeader orderForm_priceHeader--small">Razem do zapłaty: <span class="orderForm_price">{{ form.courier?.Price?.value ?? '0,00' }} zł</span></span>
            <span class="orderForm_priceTxt">(Kwota z VAT)</span>
          </div>

          <div class="orderForm_summaryButtonsContainer orderForm_summaryButtonsContainer--orderForm">
            <button :disabled="valuationIsLoading" class="orderForm_buttonGhost orderForm_buttonGhost--narrow" v-if="!isEdit" @click.prevent="addToCartOrder();">
              Dodaj do koszyka
            </button>
            <button :disabled="valuationIsLoading" class="orderForm_buttonGhost orderForm_buttonGhost--narrow" v-if="isEdit" @click.prevent="saveCartElement();">Zapisz</button>
            <button :disabled="valuationIsLoading" class="orderForm_buttonPrimary orderForm_buttonPrimary--narrow" @click.prevent="tryBuy()">{{ !valuationIsLoading ? 'Zapłać teraz' : 'Poczekaj na wycenę' }}</button>
          </div>
        </div>
      </div>
    </div>

    <Transition>
      <div class="orderForm_card orderForm_card--fixedOffer orderForm_card--hideMobile"
           v-show="showStickValuation & !summaryIsVisible & !isBottomOfPage"
           v-if="valuationResults?.data?.results && valuationResults.data.results.length > 0">
        <div class="row row--noWarp">
          <div class="row row--gap16 row--alignStart calc_couriersRow">
            <div class="form_couriersWrapper">
              <div v-for="(result, index) in valuationResultsToShow">

                <input type="radio" :id="'radio-'+indexOld+'fixedOffer'" name="kurier" value="" class="calc_courierRadio"/>
                <label :for="'radio-'+indexOld+'fixedOffer'" class="calc_pricingRadioLabel" @click="selectCourierPrice(result)"
                       :style="form?.courier?.Courier?.id === result.Courier.id ? 'border: 2px solid #4285F4;' : 'border: 2px solid #BDD4F2;'"
                >
                  <div class="calc_courierImgWrapper">
                    <NuxtImg :src="result.Courier.logo" width="50" height="" class="calc_courierImg"/>
                  </div>
                  <span class="calc_courierName">{{ result.Courier.name }}</span>
                  <span class="calc_courierPrice" :style="form?.courier?.Courier?.id === result.Courier.id ? 'background-color: #4285F4; color: #ffffff' : 'background-color: #BDD4F2; color: #262B44;'">{{ result.Price.netto }} zł</span>
                </label>
              </div>
              <a href="#kurier" class="orderForm_stickyBarTxt">Pokaż wszystkich kurierów</a>
              <FormSpinerLoaderWithText :with-text="false" :loading="valuationIsLoading"/>
            </div>
          </div>
          <div class="orderForm_stickyBarSwitchContainer">
            <label for="visibilitySwitch" class="orderForm_stickyBarTxt">Ukryj belkę</label>
            <label class="switch">
              <input id="visibilitySwitch" type="checkbox" :checked="showStickValuation" @change.prevent="showStickValuation = $event.target.checked">
              <span class="slider round"></span>
            </label>
          </div>
        </div>
      </div>
    </Transition>

    <Transition>
      <div class="orderForm_stickyBarSwitchContainerSmall"
           v-show="!showStickValuation & !summaryIsVisible & !isBottomOfPage"
           v-if="valuationResults?.data?.results && valuationResults.data.results.length > 0">
        <div class="orderForm_stickyBarSwitchContainer">
          <label for="visibilitySwitch2" class="orderForm_stickyBarTxt">Pokaż belkę</label>
          <label class="switch">
            <input id="visibilitySwitch2" type="checkbox" :checked="showStickValuation" @change.prevent="showStickValuation = $event.target.checked">
            <span class="slider round"></span>
          </label>
        </div>
      </div>
    </Transition>
  </div>

  <ModalAddressBookSelector :is-show="showAddressBookModal" :address-book-type="showAddressBookModalType"
                            @close="closeShowAddressBookModal"/>

  <Teleport to="body">
    <Modal :show="showInfoModal" @close="showInfoModal = false">
      <template #header>
        <h1 class="modal_title">{{ contentTypes[showInfoModalType].title }}</h1>
      </template>
      <template #body>
        <p class="modal_txt" v-html="contentTypes[showInfoModalType].content"></p>
      </template>
    </Modal>
  </Teleport>

  <Teleport to="body">
    <Modal :show="showCardOrderModal" @close="showCardOrderModal = false">
      <template #header>
        <h1 class="modal_title">Dodaj do koszyka</h1>
      </template>
      <template #body>
        <p class="modal_txt">
          Twoje zamówienie zostało dodane do koszyka, czy chcesz zamówić kolejną przesyłkę?
        </p>

        <div class="orderForm_summaryModalButtonsContainer">
          <nuxt-link-locale to="panel-order-shopping-cart" class="orderForm_buttonGhost" @click.prevent="">Przejdź do
            koszyka
          </nuxt-link-locale>
          <button class="orderForm_buttonPrimary" @click.prevent="addNextOrder()">Nadaj kolejną przesyłkę</button>
        </div>
      </template>
    </Modal>
  </Teleport>

  <ModalPaymentOptions
      @change="form.CartOrder.payment = $event"
      :action="createOrderForm"
      :show-modal="showCardOrderPaymentModal"
      :selected-payment="form.CartOrder.payment"
      back-text="Wróć do zamówienia"
      @hide="showCardOrderPaymentModal = false"
      :loading="createOrderLoading"
  />

  <Teleport to="body">
    <Modal :show="formValidationErrorsModal" @close="formValidationErrorsModal = false">
      <template #header>
        <h1 class="modal_title modal_title--big">Formularz wymaga uwagi</h1>
      </template>
      <template #body>
        <p class="modal_txt">
          W formularzu masz nieuzupełnione dane, które są potrzebne do złożenia zamówienia lub dodania do koszyka.
          Sprawdź, które pola wymagają Twojej uwagi.
        </p>
      </template>
    </Modal>
  </Teleport>
</template>

<script setup lang="ts">
import useUserStore from "~/stores/useUserStore";
import usePageStore from "~/stores/usePageStore";
import useOrderFormStore from "~/stores/panel/orderFormStore";
import usePreOrderStore from "~/stores/panel/usePreOrderStore";
import {useElementVisibility, useWindowScroll} from '@vueuse/core'
import {useVuelidate} from "@vuelidate/core";
import {email, required, requiredIf, maxValue, helpers} from '@vuelidate/validators'
import VueDatePicker from "@vuepic/vue-datepicker";
import useQuickValuationStore from "~/stores/useQuickValuationStore";
import usePackageTemplateStore from "~/stores/panel/usePackageTemplateStore";
import { vMaska } from "maska/vue"

const {userExternalData, paymentOptions} = storeToRefs(useUserStore());
const {t} = useI18n();
const { updatePreOrder, getPreOrder, deletePreOrder } = usePreOrderStore();
const {
  initializeForm,
  addEmptyPackage,
  selectPackageDeliveryType,
  isSelectedDeliveryType,
  fullFillForFirstValuation,
  updatePackageField,
  deleteLastPackage,
  fetchValuationResults,
  sectionIsComplete,
  updateMapUrl,
  getSectionStatusByStatus,
  updateStatusForSection,
  selectCourierPrice,
  saveToCart,
  createOrder,
  initializeFormForOrder,
  updateTakerPoint,
  initializeSectionsDone,
  fullFullFromQuickQuote,
  fetchSortables,
  updatePickup,
  updateSortable,
  updateCourierSearchField,
  fullFillSenderData,
  parseFormForValuation,
  fetchPickupDateOptions,
  onDateChange,
  updatePickupReadyTime,
  calculateMinCloseTime,
  calculateMaxReadyTime,
} = useOrderFormStore();

initializeForm();

const {
  form, valuationResults, getSortablesByPackageType, sectionsDone, mapUrl, createOrderLoading,
  courierError, valuationIsLoading, isEdit, isEditingId, createOrderData, continue_url, isEditSales, pickupDateOptions
} = storeToRefs(useOrderFormStore());
const {CartOrder, element, session} = storeToRefs(usePreOrderStore());
const selectedPoint = ref(null);
const previewPoint = ref(null);
const showMap = ref(false);
const showCardOrderModal = ref(false);
const showCardOrderPaymentModal = ref(false);
const formValidationErrorsModal = ref(false);
const showInfoModal = ref(false);
const showInfoModalType = ref('');
const showStickValuation = ref(true);
const getSortablesByPackageTypeOptions = computed(() => {
  return getSortablesByPackageType.value.map((item) => {
    return {
      code: item.id,
      name: item.name
    }
  });
});
const contentTypes = {
  insurance: {
    title: 'Ubezpieczenie',
    content: 'Możesz ubezpieczyć swoją paczkę na wypadek zagubienia lub uszkodzenia. Koszt ubezpieczenia zależy od wartości paczki. Sprawdź nasz cennik, aby dowiedzieć się więcej.'
  },
  uptake: {
    title: 'Pobranie',
    content: 'Pamiętaj o podaniu kwoty w walucie docelowej danego kraju. Np. W przypadku przesyłki do Niemiec, kwotę podajemy w Euro'
  },
  courier: {
    title: 'Kurier',
    content: 'Podane kwoty nie zawierają podatku VAT. Koszt wysyłki jest obliczany na podstawie danych wolumetrycznych paczki i wybranej metody wysyłki. Sprawdź nasz cennik, aby dowiedzieć się więcej'
  },
  sender_details: {
    title: 'Dane nadawcy',
    content: 'Wprowadź swoje dane lub pobierz je z książki adresowej.'
  },
  recipient_details: {
    title: 'Dane odbiorcy',
    content: 'Wprowadź dane odbiorcy lub pobierz je z książki adresowej.'
  },
  package_type: {
    title: 'Kształt i rodzaj opakowania',
    content: '<b>Standardowa</b> - Przesyłka standardowa to przesyłka kartonowa o niezniekształconym kształcie prostopadłoscianu, zabezpieczona taśmą lub opona zapakowana zgodnie z wytycznymi przewoźników. <br/><b>Niestandardowa</b> - ' +
        'Przesyłka niestandardowa to np.:<br/> Paczka o kształcie owalnym, kulistym, cylindrycznym (np. tuba), <br/>Paczka o nieregularnych kształtach, zniekształcona o nierównych krawędziach, z wystającymi elementami <br/>Paczka, która zawierają substancje płynne (beczki, kanistry, wiadra itp.)'
  },
  delivery_private: {
    title: 'Adres firmowy',
    content: 'Dla wybranego przewoźnika podaj NIP firmy odbiorcy lub wybierz opcję Adres prywatny'
  }
}
const showAddressBookModal = ref(false);
const showAddressBookModalType = ref('');
const isBottomOfPage = ref(false)
const checkBottomOfPage = () => {
  isBottomOfPage.value = window.innerHeight + (window.scrollY + 100) >= document.body.offsetHeight
};
const {y} = useWindowScroll()
watch(y, () => {
  checkBottomOfPage();
});

const isAvailablePayment = (payment) => {
  return Object.keys(paymentOptions.value).includes(payment);
}

const closeShowAddressBookModal = () => {
  showAddressBookModalType.value = '';
  showAddressBookModal.value = false;
}
const openShowAddressBookModal = (type) => {
  showAddressBookModalType.value = type;
  showAddressBookModal.value = true;
}

const { fetchPackageTemplate, updateFormValues, fetchSelectOptions } = usePackageTemplateStore();
const { packageTemplatesSelectOptions, templateId } = storeToRefs(usePackageTemplateStore());
const selectedPackageForm = ref(null)
const fullFillFormFromPackage = async () => {
  if (!selectedPackageForm.value) return;

  let result = await fetchPackageTemplate(selectedPackageForm.value)
  updateFormValues(form.value, result.PackageTemplate);
}

watch(() => selectedPackageForm.value, (newValue) => {
  if (newValue) {
    fullFillFormFromPackage();
  }
})

const addWeekdays = (date, days) => {
  let result = new Date(date);
  let count = 0;

  while (count < days) {
    result.setDate(result.getDate() + 1);
    if (result.getDay() !== 0 && result.getDay() !== 6) {
      count++;
    }
  }

  return result;
}

const minOrderDate = computed(() => {
  if (pickupDateOptions.value?.min_date) {
    return pickupDateOptions.value.min_date;
  }

  const date = new Date();

  // Sformatuj datę do formatu YYYY-MM-DD
  let year = date.getFullYear();
  let month = (date.getMonth() + 1).toString().padStart(2, '0');
  let day = date.getDate().toString().padStart(2, '0');

  return `${year}-${month}-${day}`;
});

const maxOrderDate = computed(() => {
  let date;
  if (pickupDateOptions.value?.min_date) {
    date = pickupDateOptions.value.min_date;
  } else {
    date = new Date();
  }

  const newDate = addWeekdays(date, 3);

  // Sformatuj datę do formatu YYYY-MM-DD
  let year = newDate.getFullYear();
  let month = (newDate.getMonth() + 1).toString().padStart(2, '0');
  let day = newDate.getDate().toString().padStart(2, '0');

  return `${year}-${month}-${day}`;
});

const startTime = computed(() => {
  return pickupDateOptions.value?.start_time || { hours : 8, minutes : 0 };
});

const minTime = computed(() => {
  return pickupDateOptions.value?.min_time || { hours : 8, minutes : 0 };
});

const maxTime = computed(() => {
  return pickupDateOptions.value?.max_time || { hours : 17, minutes : 0 };
});

const minDiff = computed(() => {
  return pickupDateOptions.value?.min_diff || 120;
});

const {params} = storeToRefs(useQuickValuationStore());

const isMounting = ref(true);
onMounted(async () => {
  courierError.value.message = ''
  await fetchSortables();
  fullFillSenderData(userExternalData.value.Broker);

  if (isEdit.value) {
    parseFormForValuation();
    selectedPoint.value = form.value.taker_point;
    previewPoint.value = form.value.selectedMapPoint;
    updateMapUrl();
  } else {
    await fullFillForFirstValuation()
  }

  await fetchValuationResults();
  fetchSelectOptions();
  fullFullFromQuickQuote(params.value);
  initializeSectionsDone();
  isMounting.value = false;
  await fetchPickupDateOptions();

  window.addEventListener('message', (event) => {
    if (event.data?.type === 'POINT_INFO_CHANGE') {
      previewPoint.value = event.data.value;
    }

    if (event.data?.type === 'SELECT_CHANGE') {
      selectedPoint.value = event.data.value.name;
      updateTakerPoint(selectedPoint.value);
      form.value.taker_point = selectedPoint.value;
      form.value.selectedMapPoint = previewPoint.value;
      showMap.value = false;
    }
  })

  //Templates
  if (templateId.value) {
    selectedPackageForm.value = templateId.value;
  }
});

onBeforeUnmount(() => {
  isEditingId.value = null;
  isEdit.value = false;
});

const valuationResultsToShow = ref([]);
const valuationResultsWhole = ref([]);
const valuationShowMore = ref(false);

const apiTypeMap = {
  inpost: ['paczkomaty', 'paczkomaty_eco', 'paczkomaty_to_door'],
}

let debounceTimeout = null;

const debounce = (func, delay) => {
  return (...args) => {
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => func(...args), delay);
  };
};

const debouncedHandler = debounce(async (newVal) => {
  updateMapUrl();
  fetchValuationResults();
}, 2000);

watch(() => previewPoint.value?.apiType, (newValue) => {
  valuationResultsToShow.value = valuationResultsToShow.value.sort((a) => {
    if (previewPoint.value?.apiType === 'inpost' && apiTypeMap.inpost.includes(a.Courier.courier_code)) {
      return -1;
    }

    if (a.Courier.courier_code === previewPoint.value?.apiType) {
      return -1;
    }

    return 1;
  })
});

watch(() => selectedPoint.value, () => {
  const getValuationByType = valuationResultsToShow.value.filter((item) => {
    if (previewPoint.value?.apiType === 'inpost') {
      if (typeof form?.value?.courier !== undefined && typeof item?.Courier?.courier_code !== undefined) {
        return form.value.courier?.Courier?.courier_code === item.Courier.courier_code;
      }
      return apiTypeMap.inpost.includes(item.Courier.courier_code);
    }

    return item.Courier.courier_code === previewPoint.value?.apiType;
  });

  if (getValuationByType.length === 1 && selectedPoint.value) {
    selectCourierPrice(getValuationByType[0]);
  }
});

watch(() => valuationResults.value?.data?.results, () => {
  let selectedCourier = valuationResults.value.data.results.find((item) => item.Courier.id == form.value.courier?.Courier?.id);

  if (selectedCourier) {
    form.value.courier = selectedCourier
  }
})

watch(valuationResults, () => {
  if (valuationResults.value?.data?.results && valuationResults.value.data.results.length > 0) {
    valuationResultsToShow.value = valuationResults.value?.data.results.slice(0, 5);
    valuationResultsWhole.value = valuationResults.value?.data.results;
  }
}, {deep: true});

watch(valuationShowMore, () => {
  if (valuationShowMore.value == true) {
    valuationResultsToShow.value = valuationResults.value?.data.results
  } else {
    valuationResultsToShow.value = valuationResults.value?.data.results.slice(0, 5);
  }
}, {deep: true});

watch(() => form.value?.sender, async () => {
  sectionIsComplete('sender', null);
  validateSections('sender');

  if (sectionsDone.value.sender.status == 'done') {
    debouncedHandler();
  }

  initializeFormForOrder();
}, {deep: true});

watch(() => form.value?.taker_point, async () => {
  updateMapUrl();
}, {deep: true});

watch(() => form.value.recipient.delivery_type, async () => {
  if (form.value.recipient.delivery_type == 'to_door') {
    form.value.taker_point = '';
  }

  fetchValuationResults();
}, {deep: true});

watch(() => form.value?.recipient, async () => {
  sectionIsComplete('recipient', false);
  validateSections('recipient');

  if (sectionsDone.value.recipient.status == 'done') {
    debouncedHandler();
  }

  initializeFormForOrder();
}, {deep: true});

watch(() => form.value?.services, async () => {
  sectionIsComplete('services', false);
  validateSections('services');

  if (sectionsDone.value.services.status == 'done') {
    debouncedHandler();
  }

  initializeFormForOrder();
}, {deep: true});

watch(() => form.value?.packages, async () => {
  sectionIsComplete('packages', false);
  validateSections('packages');

  if (sectionsDone.value.packages.status == 'done') {
    debouncedHandler();
  }

}, {deep: true});

watch(() => form.value.services.delivery_private,
    async (newValue) => {
      if (newValue === true) {
        const errors = v$.value?.services?.taker_vat_number?.$errors;
        if (errors && errors.length) {
          v$.value.services.taker_vat_number.$reset();
        }

        form.value.services.taker_vat_number = null;
      }
    }, {deep: true});

// watch(() => form.value.packages.CourierSearch.package_content, async () => {
//   sectionIsComplete('packages');
// }, {deep: true});

// watch(() => form.value.packages.CourierSearch.type, async () => {
//   debouncedHandler();
// }, {deep: true});

// watch(() => {
//   form.value.packages.CourierSearch.side_y;
//     form.value.packages.CourierSearch.side_x;
//     form.value.packages.CourierSearch.side_z;
//     form.value.packages.CourierSearch.weight;
// }, async () => {
//   debouncedHandler();
// }, {deep: true, immediate: true});

// watch(() => form.value.packages.CourierSearch.country_code, async () => {
//   debouncedHandler();
// }, {deep: true});
//
// watch(() => form.value.packages.SearchParcel, async () => {
//   debouncedHandler();
// }, {deep: true});

const addToCartOrder = async () => {
  if (valuationIsLoading.value) return;
  v$.value.$touch();

  if (allFieldsValid.value) {
    await saveToCart();
    showCardOrderModal.value = true;
    v$.value.$reset();
    initializeSectionsDone();
  } else {
    formValidationErrorsModal.value = true;
    validateSections();
  }
}

const addNextOrder = () => {
  showCardOrderModal.value = false;
  // initializeForm();

  const packageSection = document.getElementById('przesylka');
  if (packageSection) {
    packageSection.scrollIntoView({behavior: 'smooth', block: "end"});
  }
}

const saveCartElement = async () => {
  if (valuationIsLoading.value) return;
  v$.value.$touch();

  if (allFieldsValid.value) {
    await initializeFormForOrder();
    await updatePreOrder({
      pre_order_id: isEditingId.value,
      order_json: {CartOrder: createOrderData.value, fullData: form.value },
      search_id: form.value.search_id,
      courier_id: form.value.courier.Courier.id
    });

    const router = useRouter();
    const nuxt = useNuxtApp();
    router.push(nuxt.$localePath({name: 'panel-order-shopping-cart'}));
  } else {
    formValidationErrorsModal.value = true;
    validateSections();
  }
}

const {setPageValues} = usePageStore();
const {successMessage, successMessageShow, isRequiredMessage} = storeToRefs(usePageStore());

const createOrderForm = async () => {
  if (createOrderLoading.value || valuationIsLoading.value) return;
  const router = useRouter();
  const nuxt = useNuxtApp();

  if (form.value?.CartOrder?.payment === 'paynow') {
    continue_url.value = window.location.origin + nuxt.$localePath({name: 'panel-order-id', params: { id: ':id'}});
  }

  const result = await createOrder();

  successMessageShow.value = false;
  successMessage.value = {
    message: '',
    title: ''
  };
  isRequiredMessage.value = false;
  showCardOrderPaymentModal.value = false;
  createOrderLoading.value = false;

  if (result.success) {
    successMessageShow.value = true;
    successMessage.value = {
      message: 'Zamówienie zostało złożone pomyślnie',
      title: 'Zamówienie złożone'
    };
    isRequiredMessage.value = true;

    if (result.data.paymentUrl) {
      window.location.href = result.data.paymentUrl;
      return;
    }

    if (isEdit.value) {
      await deletePreOrder(isEditingId.value);
    }

    if (result.data.content.cartOrderId) {
      router.push(nuxt.$localePath({name: 'panel-order-id', params: {id: result.data.content.cartOrderId}}));
      return;
    } else if (!result.data.content.cartOrderId) {
      router.push(nuxt.$localePath({name: 'panel-order-shopping-cart'}));
      return;
    }
  } else {
    if (result.message) {
      const errorSection = document.getElementById('errorMessageAlert');
      if (errorSection) {
        errorSection.scrollIntoView({behavior: 'smooth', block: "end"});
      }
    }
  }
}

const valuationVisible = ref(null)
const valuationIsVisible = useElementVisibility(valuationVisible)
const summaryVisible = ref(null)
const summaryIsVisible = useElementVisibility(summaryVisible)

let state = reactive(form)

const weightMaxValue = computed(() => {
  switch (form.value.packages.CourierSearch.type) {
    case 'package':
      return 70.0;
    case 'envelope':
      return 70.0;
    case 'pallet':
      return 1000.0;
    case 'not_standard':
      return 1000.0;
    default:
      return 70.0;
  }
})

const countriesRequiredState = ['US', 'CA']

const postalRegex = (value) => {
  if (form.value.packages.CourierSearch.country_code !== 'PL') {
    return true;
  }

  if (value.length === 0) {
    return true;
  }

  const regex = /^[0-9]{2}-[0-9]{3}$/
  return regex.test(value);
}

const customNipValidator = helpers.withMessage(
    "Nieprawidłowy numer NIP",
    (value) => {
      if (!value || value.trim() === '') return true;
      if (typeof value !== "string") return false;

      const nip = value.replace(/-/g, "");

      if (nip.length !== 10 || !/^\d{10}$/.test(nip)) {
        return false;
      }

      const weights = [6, 5, 7, 2, 3, 4, 5, 6, 7];

      const checksum =
          nip
              .split("")
              .slice(0, 9)
              .reduce((acc, digit, index) => acc + parseInt(digit, 10) * weights[indexOld], 0) % 11;

      return checksum === parseInt(nip[9], 10);
    }
);

const rules = computed(() => {
  return {
    sender: {
      name: {required},
      vat_street: {required},
      vat_house_no: {required},
      vat_locum_no: {},
      vat_postal: {required, postalRegex},
      vat_city: {required},
      email: {required, email},
      phone: {required},
      vat_company: {},
      no_pickup: {required},
    },
    recipient: {
      taker_name: {required},
      taker_street: {required},
      taker_house_no: {required},
      taker_postal: {required, postalRegex},
      taker_city: {required},
      taker_email: {required, email},
      taker_phone: {required},
      delivery_type: {required},
      state: {requiredIf: requiredIf(() => countriesRequiredState.includes(form.value.packages.CourierSearch.country_code) )},
      marketplace_sale_id: {}
    },
    packages: {
      CourierSearch: {
        type: {required},
        weight: {required, maxValue: maxValue(weightMaxValue)},
        side_x: {required},
        side_y: {required},
        side_z: {required},
        sortable: {requiredIf: requiredIf(() => form.value.packages.CourierSearch.type === 'package' || form.value.packages.CourierSearch.type === 'envelope')},
        package_content: {required},
      }
    },
    courier: {
      Courier: {
        courier_code: {required}
      }
    },
    services: {
      cover: {},
      uptake: {},
      inpost_weekend: {},
      delivery_private: {},
      taker_vat_number: {
        requiredIf: requiredIf(() =>
              form.value.services.delivery_private === false &&
              form.value.courier?.Courier?.private_delivery_fee === true
        ),
        customNipValidator: customNipValidator,
      },
    }
  }
})

const v$ = useVuelidate(rules, state);
const allFieldsValid = computed(() => {
  return !v$.value.$error;
})

const validateSections = (section = null) => {
  if (isMounting.value) return;

  v$.value.$touch();

  if (v$.value.courier.$error && (section === 'courier' || section === null)) {
    sectionsDone.value.courier = getSectionStatusByStatus('error');
  }

  if (v$.value.recipient.$silentErrors.length > 0 && (section === 'recipient' || section === null)) {
    sectionsDone.value.recipient = getSectionStatusByStatus('error');
  }

  if (v$.value.packages.$silentErrors.length > 0 && (section === 'packages' || section === null)) {
    sectionsDone.value.packages = getSectionStatusByStatus('error');
  } else if (v$.value.packages.$silentErrors.length === 0 && section === 'packages') {
    updateStatusForSection('packages', null)
  }

  if (v$.value.services.$silentErrors.length > 0 && (section === 'services' || section === null)) {
    sectionsDone.value.services = getSectionStatusByStatus('error');
  } else if (v$.value.services.$silentErrors.length === 0 && section === 'services') {
    updateStatusForSection('services', null)
  }

  if (v$.value.sender.$silentErrors.length > 0 && (section === 'sender' || section === null)) {
    sectionsDone.value.sender = getSectionStatusByStatus('error');
  } else if (v$.value.sender.$silentErrors.length === 0 && section === 'sender') {
    updateStatusForSection('sender', null)
  }
}

const tryBuy = () => {
  if (valuationIsLoading.value) return;

  v$.value.$touch();



  if (allFieldsValid.value) {
    showCardOrderPaymentModal.value = true;
  } else {
    formValidationErrorsModal.value = true;
    validateSections();
  }
}

setPageValues(
    t('page.panelPage.title'),
    false
);
useHead({
  title: t('page.panelPage.title'),
  layout: 'panel',
});
definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>

<style scoped>

</style>