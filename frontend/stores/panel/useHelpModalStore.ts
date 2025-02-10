import {defineStore} from "pinia";

const useHelpModalStore = defineStore('helpModal', {
  state: () => ({
    showHelpModal: false,
    selectedHelpModalKey: null,
    content: {
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
        content:
          '    <div style="margin-bottom: 20px">' +
          '        <h2>Standardowa przesyłka</h2>' +
          '        <p style="margin-top: 15px;">Przesyłka standardowa to paczka zapakowana w <b>sztywny, prostopadłościenny karton</b>, zaklejony taśmą w sposób zapewniający stabilność i brak odkształceń. Może to być również <b>opona</b>, jeśli została zapakowana zgodnie z wymaganiami przewoźnika. Tego rodzaju przesyłki są łatwe do sortowania w automatycznych sortowniach kurierskich.</p>' +
          '    </div>' +
          '    <div>' +
          '        <h2>Niestandardowa przesyłka</h2>' +
          '        <p style="margin-top: 15px;">Przesyłką niestandardową jest paczka, która ze względu na swój kształt, sposób pakowania lub zawartość <b>nie spełnia kryteriów przesyłki standardowej</b>. Zaliczają się do niej m.in.:</p>' +
          '        <ul style="padding-left: 2px; margin-left: 0; list-style-position: inside;">' +
          '            <li><b>Paczki o nietypowych kształtach</b> – owalne, kuliste, cylindryczne (np. tuby), zniekształcone kartony, paczki z wystającymi elementami.</li>' +
          '            <li><b>Paczki nieregularne</b> – z nierównymi krawędziami, trudno ustawne w stosie.</li>' +
          '            <li><b>Paczki zawierające płyny</b> – np. beczki, kanistry, wiadra.</li>' +
          '            <li><b>Paczki owinięte folią stretch, workiem lub innym materiałem</b>, który utrudnia ich przesuwanie na taśmach sortujących.</li>' +
          '        </ul>' +
          '        <p>Przesyłki niestandardowe wymagają ręcznego sortowania i mogą podlegać dodatkowym opłatom.</p>' +
          '    </div>'
      },
      delivery_private: {
        title: 'Adres firmowy',
        content: 'Dla wybranego przewoźnika podaj NIP firmy odbiorcy lub wybierz opcję Adres prywatny'
      }
    }
  }),
});

export default useHelpModalStore;